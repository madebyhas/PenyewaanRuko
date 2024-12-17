<!DOCTYPE html>
@extends('landing.partials.head')
@section('css')

@section('container')
<div class="register">
    <div class="container">
        <h1 class="text-center">R E G I S T R A S I</h1>
        <hr class="mb-3">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-row">
                <div class="form-group col-4">
                    <label for="nama_penyewa">Nama Penyewa</label>
                    <input type="text" id="nama_penyewa" name="nama_penyewa" class="form-control @error('nama_penyewa') {{ " is-invalid" }} @enderror" value="{{ old('nama_penyewa') }}"
                        placeholder="Masukkan nama lengkap anda" required autofocus>
                    @error('nama_penyewa')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                
                <div class="form-group col-4">
                    <label for="nama_usaha">Nama Usaha</label>
                    <input type="text" id="nama_usaha" name="nama_usaha" class="form-control @error('nama_usaha') {{ " is-invalid" }} @enderror" value="{{ old('nama_usaha') }}"
                    placeholder="Masukkan nama usaha anda" required autofocus>
                    @error('nama_usaha')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group col-4">
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <select id="jenis_kelamin" name="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror" required autofocus>
                        <option value="" disabled selected>Pilih Jenis Kelamin</option>
                        <option value="laki-laki" {{ old('jenis_kelamin') == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="perempuan" {{ old('jenis_kelamin') == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('jenis_kelamin')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                
                <div class="form-group col-8">
                    <label for="alamat">Alamat</label>
                    <div class="input-group mb-1">
                        <input type="text" class="form-control @error('alamat') {{ " is-invalid" }} @enderror"
                            id="alamat" name="alamat" aria-describedby="basic-addon4" placeholder="Masukkan alamat" value="{{ old('alamat') }}" required autofocus>
                        @error('alamat')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>

                </div>
                <div class="form-group col-4">
                    <label for="telp">No Telp</label>
                    <input type="text" id="telp" name="telp" class="form-control" placeholder="Masukkan No telp/WA" value="{{ old('telp') }}" required autofocus>
                    @error('telp')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="form-group col-4">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" class="form-control"
                        placeholder="Masukkan username" value="{{ old('username') }}" required autofocus>
                        @error('username')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                </div>

                <div class="form-group col-4">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control"
                        placeholder="Masukkan password" required autofocus>
                        @error('paswword')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                </div>

                <div class="form-group col-4">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                        placeholder="Konfirmasi password" required autofocus>
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