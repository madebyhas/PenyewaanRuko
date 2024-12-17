<?php

namespace App\Http\Controllers\Penyewa\Ruko;

use App\Models\Ruko;
use App\Models\Penyewa;
use App\Models\Tagihan;
use App\Models\Sewaruko;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class SewaRukoController extends Controller
{
    public function index()
    {
        // Ambil data penyewa
        $penyewa = Penyewa::all(); 
        
        // Ambil data ruko
        $ruko = Ruko::all();

        // Tampilkan daftar sewa ruko untuk penyewa yang sedang login
        $sewarukos = Sewaruko::all();

        $totalHarga = $sewarukos->sum(function ($sewaruko) {
            return Ruko::where('id_ruko', $sewaruko->ruko_id)->value('harga');
        });

        return view('sewaruko.index', compact('penyewa', 'sewarukos', 'totalHarga', 'ruko'));
    }
   
    public function store(Request $request)
    {
        $penyewaId = $request->input('penyewa_id'); // Ambil penyewa_id dari request
        $durasi = $request->input('durasi');  // Ambil penyewa_id dari request
        $tglSewa = now(); // Ambil tanggal sekarang untuk sewa       
        $rukoId = $request->input('ruko_id');  // Ambil ruko_id sebagai string
    
        // Pastikan ruko_id tidak kosong
        if (!empty($rukoId)) {
            // Buat SewaRuko baru
            SewaRuko::create([
                'penyewa_id' => $penyewaId,
                'ruko_id' => $rukoId,
                'durasi' => $durasi,
                'tgl_sewa' => $tglSewa,
            ]);
        }
    
        return redirect()->route('sewaruko.index')->with('success', 'DATA SEWA RUKO BERHASIL DISIMPAN!');
    }
    public function edit($id_sewaruko)
    {
        // Ambil data penyewa
        $penyewa = Penyewa::all(); 
        
        // Ambil data ruko
        $ruko = Ruko::all();
        
        // Ambil data sewaruko
        $sewaruko = SewaRuko::where('id_sewaruko', $id_sewaruko)->first();

        return view('sewaruko.editt', compact('penyewa', 'sewaruko', 'ruko'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_sewaruko)
{
    // Validasi inputan dari form
    $validatedData = $request->validate([
        'penyewa_id' => 'required|exists:penyewas,id_penyewa',  // Validasi agar penyewa_id ada di tabel penyewa
        'ruko_id' => 'required|exists:rukos,id_ruko',  // Validasi agar ruko_id ada di tabel ruko
        'durasi' => 'required',  // Validasi agar durasi adalah angka
        'tgl_sewa' => 'required',  // Validasi agar tgl_sewa adalah tanggal yang valid
    ]);

    // Mencari data SewaRuko berdasarkan ID
    $sewaruko = SewaRuko::find($id_sewaruko);

    // Update data sewaruko
    $sewaruko->update([
        'penyewa_id' => $request->penyewa_id,  // Update dengan data penyewa_id yang dipilih
        'ruko_id' => $request->ruko_id,  // Update dengan data ruko_id yang dipilih
        'durasi' => $request->durasi,  // Update dengan durasi yang dipilih
        'tgl_sewa' => $request->tgl_sewa,  // Update dengan tanggal sewa
    ]);

    // Redirect dengan pesan sukses
    return redirect()->route('sewaruko.index')->with('success', 'DATA SEWARUKO TELAH DIPERBARUI!');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_sewaruko)
    {
        $sewaruko = SewaRuko::find($id_sewaruko);

        if (!$sewaruko) {
            return redirect()->back()->with('error', 'SEWARUKO TIDAK DAPAT DIHAPUS!');
        }

        $sewaruko->delete();

        return redirect()->back()->with('success', 'SEWARUKO TELAH DIHAPUS !');
    }

   
    public function checkout(Request $request)
    {
        $penyewaId = $request->input('penyewa_id'); 
        $durasi = $request->input('durasi'); 
        $tglSewa = now(); 

       
        if ($request->has('ruko_id')) {
            foreach ($request->input('ruko_id') as $ruko_id) {
               
                SewaRuko::create([
                    'penyewa_id' => $penyewaId,
                    'ruko_id' => $ruko_id,
                    'durasi' => $durasi,
                    'tgl_sewa' => $tglSewa,
                ]);
            }
        }
        return redirect()->route('checkout.tagihan')->with('success', 'Tagihan created successfully!');
    }

    public function chart()
    {
       
        $penyewaId = Auth::id(); // Mendapatkan ID penyewa yang sedang login

        // Tampilkan daftar sewa ruko untuk penyewa yang sedang login
        $sewarukos = Sewaruko::where('penyewa_id', $penyewaId)->get();

        $totalHarga = $sewarukos->sum(function ($sewaruko) {
            return Ruko::where('id_ruko', $sewaruko->ruko_id)->value('harga');
        });

        return view('landing.chart', compact('sewarukos', 'totalHarga'));
    }
}
