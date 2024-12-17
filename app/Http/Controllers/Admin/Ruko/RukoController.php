<?php

namespace App\Http\Controllers\Admin\Ruko;

use App\Http\Controllers\Controller;
use App\Models\Ruko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RukoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ruko = Ruko::all();

        return view('ruko.index', compact('ruko'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $data = $request->all();
        
            $validate = Validator::make(
                $data,
                [
                    'jenis_ruko' => ['required'],
                    'luas_ruko' => ['required'],
                    'no_ruko' => ['required'],
                    'harga' => ['required'],
                ],
                [
                    'jenis_ruko.required' => 'Jenis ruko wajib diisi!',
                    'luas_ruko.required' => 'Luas ruko wajib diisi!',
                    'no_ruko.required' => 'No ruko wajib diisi!',
                    'harga.required' => 'Harga wajib diisi!',
                ]
            );

            if ($validate->fails()) {
                return redirect()->back()->withErrors($validate)->withInput();
            }

            Ruko::create([
                'jenis_ruko' => $data['jenis_ruko'],
                'luas_ruko' => $data['luas_ruko'],
                'no_ruko' => $data['no_ruko'],
                'harga' => $data['harga'],
                'status' => '0',
            ]);

        return redirect()->route('ruko.index')->with(['success' => 'DATA RUKO TELAH DISIMPAN!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(ruko $ruko)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_ruko)
    {
        $ruko = Ruko::where('id_ruko', $id_ruko)->first();

        return view('ruko.edit', ['ruko' => $ruko]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_ruko)
    {
        $data = [
            'jenis_ruko' => $request->jenis_ruko,
            'luas_ruko' => $request->luas_ruko,
            'no_ruko' => $request->no_ruko,
            'harga' => $request->harga,
        ];

        Ruko::find($id_ruko)->update($data);

        return redirect()->route('ruko.index')->with('success', 'DATA RUKO TELAH DIPERBARUI !');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_ruko)
    {
        $ruko = Ruko::find($id_ruko);

        if (!$ruko) {
            return redirect()->back()->with('error', 'RUKO TIDAK DAPAT DIHAPUS!');
        }

        $ruko->delete();

        return redirect()->back()->with('success', 'RUKO TELAH DIHAPUS !');
    }

    public function addToCartRuko(Request $request)
    {
        $ruko_id = $request->input('ruko_id'); // Ambil ruko_id dari input form
        $rukos = Ruko::findOrFail($ruko_id);

        $cart = session()->get('cart', []);

        if (isset($cart[$ruko_id])) {
            $cart[$ruko_id]['quantity']++;
        } else {
            $cart[$ruko_id] = [
                "jenis_ruko" => $rukos->jenis_ruko,
                "luas_ruko" => $rukos->luas_ruko,
                "no_ruko" => $rukos->no_ruko,
                "harga" => $rukos->harga,
                "quantity" => 1, // Tambahkan quantity
            ];
        }

        session()->put('cart', $cart);
        return redirect()->route('chart')->with('success', 'DATA RUKO TELAH DITAMBAH !');

        // return redirect()->back()->with('success', 'Berhasil menambah ruko pada keranjang! Silahkan proses pada menu Keranjang.');
    }

    public function removeFromCart($ruko_id)
    {
        $cart = session()->get('cart');

        // Cek apakah item ada di keranjang
        if (isset($cart[$ruko_id])) {
            unset($cart[$ruko_id]); // Hapus item dari keranjang
            session()->put('cart', $cart); // Perbarui session cart
        }

        return redirect()->back()->with('success', 'Berhasil menghapus ruko pada keranjang!');
    }


    // public function addToCartRuko($id_ruko)
    // {

    //     $rukos = Ruko::findOrFail($id_ruko);

    //     $cart = session()->get('cart', []);

    //     if(isset($cart[$id_ruko])) {
    //         $cart[$id_ruko]['quantity']++;
    //     } else {
    //         $cart[$id_ruko] = [
    //             "jenis_ruko" => $rukos->jenis_ruko,
    //             "luas_ruko" => $rukos->luas_ruko,
    //             "no_ruko" => $rukos->no_ruko,
    //             "harga" => $rukos->image
    //         ];

    //     }

    //     session()->put('cart', $cart);
    //     return redirect()->back()->with('success', 'Product added to cart successfully!');
    // }
//     public function addToCartRuko(Request $request)
// {
//     $ruko_id = $request->input('ruko_id'); // Ambil ruko_id dari input form
//     $rukos = Ruko::findOrFail($ruko_id);

    //     $cart = session()->get('cart', []);

    //     if (isset($cart[$ruko_id])) {
//         $cart[$ruko_id]['quantity']++;
//     } else {
//         $cart[$ruko_id] = [
//             "jenis_ruko" => $rukos->jenis_ruko,
//             "luas_ruko" => $rukos->luas_ruko,
//             "no_ruko" => $rukos->no_ruko,
//             "harga" => $rukos->harga, // Pastikan Anda menggunakan harga, bukan image
//         ];
//     }

    //     session()->put('cart', $cart);
//     return redirect()->back()->with('success', 'Product added to cart successfully!');
// }



}
