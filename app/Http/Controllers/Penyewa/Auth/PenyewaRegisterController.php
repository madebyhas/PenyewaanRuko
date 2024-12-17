<?php

namespace App\Http\Controllers\Penyewa\Auth;

use App\Http\Controllers\Controller;
use App\Models\Penyewa;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;

class PenyewaRegisterController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('penyewa.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->all();

        $validate = Validator::make(
            $data,
            [
                'nama_penyewa' => ['required'],
                'nama_usaha' => ['required'],
                'alamat' => ['required'],
                'jenis_kelamin' => ['required'],
                'telp' => ['required'],
                'username' => ['required', 'string', 'username'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],

            ],
  [
            'nama_penyewa.required' => 'Nama anda wajib diisi!',
            'nama_usaha.required' => 'Nama usaha anda wajib diisi!',
            'alamat.required' => 'Alamat anda wajib diisi!',
            'jenis_kelamin.required' => 'Jenis Kelamin anda wajib diisi!',
            'telp.required' => 'No Telp/WA anda wajib diisi!',
            'username.required' => 'Username anda wajib diisi!',
            'password.required' => 'Password anda wajib diisi!',
            ]
        );

        $penyewa = Penyewa::create([
            'nama_penyewa' => $data['nama_penyewa'],
            'nama_usaha' => $data['nama_usaha'],
            'jenis_kelamin' => $data['jenis_kelamin'],
            'alamat' => $data['alamat'],
            'telp' => $data['telp'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
        ]);

        event(new Registered($penyewa));

        Auth::guard('penyewa')->login($penyewa);

        return redirect(route('dashboard', false));
    }

    public function edit($id_penyewa)
    {
        $penyewa = Penyewa::where('id_penyewa', $id_penyewa)->first();

        return view('addpenyewa.edit', ['penyewa' => $penyewa]);

    }
    public function update(Request $request, $id_penyewa)
    {
        $data = [
            'nama_penyewa' => $request->nama_penyewa,
            'nama_usaha' => $request->nama_usaha,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'telp' => $request->telp,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ];

        Penyewa::find($id_penyewa)->update($data);
            
        return redirect()->route('tampil.penyewa')->with('success', 'DATA RUKO TELAH DIPERBARUI !');
    }

    public function destroy($id_penyewa)
    {
        $penyewa = Penyewa::find($id_penyewa);

        if (!$penyewa) {
            return redirect()->back()->with('error', 'DATA PENYEWA TIDAK DAPAT DIHAPUS!');
        }

        $penyewa->delete();

        return redirect()->back()->with('success', 'DATA PENYEWA TELAH DIHAPUS !');
    }


    public function tampil(): View
    {
        $penyewa = Penyewa::all();

        return view('addpenyewa.index', compact('penyewa'));
    }
    public function tambah(Request $request): RedirectResponse
    {
        $data = $request->all();

        $validate = Validator::make(
            $data,
            [
                'nama_penyewa' => ['required'],
                'nama_usaha' => ['required'],
                'alamat' => ['required'],
                'jenis_kelamin' => ['required'],
                'telp' => ['required'],
                'username' => ['required', 'string', 'username'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],

            ],
  [
            'nama_penyewa.required' => 'Nama anda wajib diisi!',
            'nama_usaha.required' => 'Nama usaha anda wajib diisi!',
            'alamat.required' => 'Alamat anda wajib diisi!',
            'jenis_kelamin.required' => 'Jenis Kelamin anda wajib diisi!',
            'telp.required' => 'No Telp/WA anda wajib diisi!',
            'username.required' => 'Username anda wajib diisi!',
            'password.required' => 'Password anda wajib diisi!',
            ]
        );

        $penyewa = Penyewa::create([
            'nama_penyewa' => $data['nama_penyewa'],
            'nama_usaha' => $data['nama_usaha'],
            'jenis_kelamin' => $data['jenis_kelamin'],
            'alamat' => $data['alamat'],
            'telp' => $data['telp'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
        ]);

        return redirect()->back()->with('success', 'DATA PENYEWA TELAH DIPERBARUI !');
        // return redirect(RouteServiceProvider::HOME);
    }
}
