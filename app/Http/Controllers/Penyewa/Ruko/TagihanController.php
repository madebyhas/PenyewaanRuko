<?php

namespace App\Http\Controllers\Penyewa\Ruko;

use App\Models\Ruko;
use App\Models\Penyewa;
use App\Models\Tagihan;
use App\Models\Sewaruko;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TagihanController extends Controller
{
    public function index()
    {
        $tagihan = Tagihan::all();

        return view('tagihan.index', compact('tagihan'));
    }

    public function create()
    {
        $penyewaId = Auth::id();

        $sewarukos = Sewaruko::where('penyewa_id', $penyewaId, 'status', 'selesei')->get();

        $totalHarga = $sewarukos->sum(function ($sewaruko) {
            return Ruko::where('id_ruko', $sewaruko->ruko_id)->value('harga');
        }); // Assuming you have the relationship set up in your SewaRuko model

        return view('landing.checkout', compact('sewarukos', 'totalHarga'));
    }

    public function show($id_tagihan)
    {

        $tagihan = Tagihan::where('id_tagihan', $id_tagihan)->first();

        return view('tagihan.confirm', ['tagihan' => $tagihan]);

    }

    public function riwayat()
    {
        // Ambil id penyewa yang sedang login
        $penyewaId = Auth::id();
    
        // Ambil semua tagihan yang memiliki sewaruko_id sesuai dengan penyewa yang sedang login
        $tagihans = Tagihan::whereHas('sewaruko', function ($query) use ($penyewaId) {
            $query->where('penyewa_id', $penyewaId);
        })->get();
    
        // Pastikan ada tagihan yang ditemukan
        if ($tagihans->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada riwayat pembayaran untuk penyewa ini.');
        }
    
        // Jika ada tagihan, kirim data ke view
        return view('landing.riwayat', [
            'tagihans' => $tagihans // Kirim koleksi tagihan ke view
        ]);
    }
    


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_tagihan)
    {
        // Validasi input
        $request->validate([
            'status' => 'required|string|in:selesei,batal', // Pastikan status sesuai
        ]);

        // Cari tagihan berdasarkan id_tagihan
        $tagihan = Tagihan::find($id_tagihan);

        // Cek apakah tagihan ditemukan
        if (!$tagihan) {
            return redirect()->route('tagihan.index')->with('error', 'Tagihan tidak ditemukan.');
        }

        // Update status tagihan
        $tagihan->update(['status' => $request->status]);

        // Update status ruko menjadi "tidak tersedia"
        Ruko::where('id_ruko', $tagihan->sewaruko->ruko_id) // Pastikan ini adalah kolom yang sesuai
            ->update(['status' => 'tidak tersedia']);

        return redirect()->route('tagihan.index')->with('success', 'DATA TAGIHAN TELAH DIPERBARUI!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_tagihan)
    {
        $tagihan = Tagihan::find($id_tagihan);

        if (!$tagihan) {
            return redirect()->back()->with('error', 'Tagihan TIDAK DAPAT DIHAPUS!');
        }

        $tagihan->delete();

        return redirect()->back()->with('success', 'Tagihan TELAH DIHAPUS !');
    }

    public function setDurasi($durasi)
    {
        return $durasi / 100;
    }
    public function setTotal($sewaruko, $durasi)
    {
        $harga = $sewaruko->ruko->harga; // Akan memanggil accessor

        return $harga * $durasi;
    }

    public function tagihan()
    {
        $penyewaId = Auth::id();

        // Ambil sewaruko yang dimiliki penyewa dan status ruko "0"
        $sewarukos = Sewaruko::where('penyewa_id', $penyewaId)
            ->whereHas('ruko', function ($query) {
                $query->where('status', "0"); // Pastikan kolom status ada di tabel ruko
            })
            ->get();

        $totalHarga = 0; // set nul terlebih dahulu

        foreach ($sewarukos as $sewaruko) {
            $durasi = $this->setDurasi($sewaruko->durasi) * 10; // kali 10
            $sewaruko->total = $this->setTotal($sewaruko, $durasi); // hitung total dan tambahkan ke model
            $totalHarga += $sewaruko->total; // hitung total harga        
        }

        // Ambil tagihan yang ada untuk penyewa ini
        //$tagihan = Tagihan::where('sewaruko_id', $sewarukos->pluck($penyewaId))->first();
        $tagihan=  Tagihan::join('sewarukos','sewarukos.penyewa_id','=','tagihans.id_tagihan')
        ->join('rukos','rukos.id_ruko','=','sewarukos.ruko_id')
        ->where(['penyewa_id' => $penyewaId])->get();

       
        return view('landing.checkout', compact('sewarukos', 'tagihan', 'totalHarga'));
    }

    public function upload(Request $request)
    {

        $request->validate([
            'total' => 'required|numeric',
            'bukti' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'metode' => 'required|string',
        ]);

        $data = $request->all();

        // Menyimpan file bukti transfer jika ada
        if ($request->hasFile('bukti')) {
            $data['bukti'] = $request->file('bukti')->storeAs(
                'bukti_transfer',
                uniqid() . '.' . $request->file('bukti')->getClientOriginalExtension(),
                'public'
            );
        } else {
            $data['bukti'] = '';
        }

        // Mengisi tgl_awal_tagihan dan tgl_akhir_tagihan
        $currentDate = now(); // Mengambil tanggal dan waktu saat ini
        $tglAwalTagihan = $currentDate->copy()->startOfMonth(); // Tanggal awal tagihan (tanggal 1 bulan ini)
        $tglAkhirTagihan = $currentDate->copy()->day(15); // Tanggal akhir tagihan (tanggal 15 bulan ini)


        // Create a new tagihan
        Tagihan::create([
            'sewaruko_id' => $this->getSewarukoId(),
            'total' => $request->input('total'),
            'tgl_awal_tagihan' => $tglAwalTagihan,
            'tgl_akhir_tagihan' => $tglAkhirTagihan,
            'bukti' => $data['bukti'],
            'metode' => $request->input('metode'),
            'status' => '0', // Set default status to 0
        ]);

        return redirect()->route('riwayat.tagihan')->with('success', 'Tagihan created successfully!');
    }

    private function getSewarukoId()
    {

        $penyewaId = Auth::id();
        $sewaruko = Sewaruko::where('penyewa_id', $penyewaId)->first(); // Modify as needed

        return $sewaruko->id_sewaruko; // Assuming this is the primary key for sewaruko
    }

}
