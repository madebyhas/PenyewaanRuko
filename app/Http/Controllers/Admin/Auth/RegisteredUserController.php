<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
// use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('admin.auth.register');
    }

    public function tampil(): View
    {
        $admin = Admin::all();

        return view('addadmin.index', compact('admin'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nama_admin' => ['required', 'string', 'max:255'],
            'telp' => ['required'],
            'username' => ['required', 'string', 'max:255'],
            // 'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Admin::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $admin = Admin::create([
            'nama_admin' => $request->nama_admin,
            'telp' => $request->telp,
            'username' => $request->username,
            // 'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($admin));

        Auth::guard('admin')->login($admin);

        return redirect(route('admin.dashboard', false));
        // return redirect(RouteServiceProvider::HOME);
    }

    public function edit($id_admin)
    {
        $admin = Admin::where('id_admin', $id_admin)->first();

        return view('Addadmin.edit', ['admin' => $admin]);

    }
    public function update(Request $request, $id_admin)
    {
        $admin = Admin::find($id_admin);

        // Check data berubah
        $dataChanged = false;

        if ($admin->nama_admin !== $request->nama_admin) {
            $admin->nama_admin = $request->nama_admin;
            $dataChanged = true;
        }
        if ($admin->telp !== $request->telp) {
            $admin->telp = $request->telp;
            $dataChanged = true;
        }
        if ($admin->username !== $request->username) {
            $admin->username = $request->username;
            $dataChanged = true;
        }
        if ($request->filled('password')) { // Check jika password sesuai
            $admin->password = Hash::make($request->password);
            $dataChanged = true;
        }

        // update jika ada yang diubah
        if ($dataChanged) {
            $admin->save();
            return redirect()->route('tampil.admin')->with('success', 'DATA ADMIN TELAH DIPERBARUI !');
        }

        return redirect()->route('tampil.admin')->with('success', 'DATA ADMIN tidak ada yang diperbarui !');
    }
    public function destroy($id_admin)
    {
        $admin = Admin::find($id_admin);

        if (!$admin) {
            return redirect()->back()->with('error', 'DATA ADMIN TIDAK DAPAT DIHAPUS!');
        }

        $admin->delete();

        return redirect()->back()->with('success', 'DATA ADMIN TELAH DIHAPUS !');
    }



    public function tambah(Request $request): RedirectResponse
    {
        $request->validate([
            'nama_admin' => ['required', 'string', 'max:255'],
            'telp' => ['required'],
            'username' => ['required', 'string', 'max:255'],
            // 'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Admin::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $admin = Admin::create([
            'nama_admin' => $request->nama_admin,
            'telp' => $request->telp,
            'username' => $request->username,
            // 'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('success', 'DATA ADMIN TELAH DISIMPAN !');
        // return redirect(RouteServiceProvider::HOME);
    }
}
