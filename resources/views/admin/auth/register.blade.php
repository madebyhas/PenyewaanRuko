<!DOCTYPE html>
@extends('landing.partials.head')
@section('css')

@section('container')
<div class="register">
    <div class="container">
        <h1 class="text-center">R E G I S T R A S I - A D M I N</h1>
        <hr class="mb-3">
        <form method="POST" action="{{ route('admin.register') }}">
            @csrf
            <div class="form-row">
                <div class="form-group col-4">
                    <label for="nama_admin">Nama Admin</label>
                    <input type="text" id="nama_admin" name="nama_admin" class="form-control" value="{{ old('nama_admin') }}"
                    placeholder="Masukkan nama lengkap anda">
                </div>
                <div class="form-group col-4">
                    <label for="telp">No Telp</label>
                    <input type="text" id="telp" name="telp" class="form-control" placeholder="Masukkan No telp/WA" value="{{ old('telp') }}">
                    @error('telp')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="form-group col-4">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" class="form-control"
                        placeholder="Masukkan username" value="{{ old('username') }}" required>
                        @error('username')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                </div>

                <div class="form-group col-4">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control"
                        placeholder="Masukkan password" required>
                        @error('paswword')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                </div>

                <div class="form-group col-4">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                        placeholder="Konfirmasi password" required>
                        @error('password_confirmation')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Daftar</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

</html>