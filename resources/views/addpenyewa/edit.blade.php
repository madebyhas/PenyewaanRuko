<!DOCTYPE html>
@extends('admin.partials.head')
@section('css')

<!--  Section Container-->
@section('container')
<div class="body-wrapper">
    <!--  Header Start -->
    <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
            <ul class="navbar-nav">
                <div class="col-sm-12">
                    <h4><B>Edit Penyewa</B></h4>
                </div>
            </ul>
            <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                    <li class="nav-item dropdown">
                        <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="bg-white rounded-circle"><i class="ti ti-user"> {{
                                    Auth::guard('admin')->user()->username }}!</i>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up">
                            <form method="POST" action="{{ route('admin.logout') }}" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-outline-primary d-block w-75 px-2 mx-auto"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!--  Header End -->
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center"
                    style="background-color: rgba(0, 0, 255, 0.5); color: white;">
                    <h4><b>Edit Data Penyewa</b></h4>
                </div>
                <div class="card-body">
                    <form method="post" action="{{route("penyewa.update",$penyewa->id_penyewa)}}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="mb-3">
                            <label for="nama_penyewa">Nama Penyewa</label>
                            <input type="text" name="nama_penyewa" id="nama_penyewa"
                                class="form-control @error('nama_penyewa'){{'is-invalid'}}@enderror"
                                value="{{$penyewa->nama_penyewa}}">
                            @error('nama_penyewa')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username"
                                class="form-control @error('username'){{'is-invalid'}}@enderror"
                                value="{{$penyewa->username}}">
                            @error('username')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nama_usaha">Nama Usaha</label>
                            <input type="text" name="nama_usaha" id="nama_usaha"
                                class="form-control @error('nama_usaha'){{'is-invalid'}}@enderror"
                                value="{{$penyewa->nama_usaha}}">
                            @error('nama_usaha')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <select id="jenis_kelamin" name="jenis_kelamin"
                                class="form-control @error('jenis_kelamin') is-invalid @enderror" required autofocus>
                                <option value="" disabled {{ empty($penyewa->jenis_kelamin) ? 'selected' : '' }}>Pilih
                                    Jenis Kelamin</option>
                                <option value="laki-laki" {{ old('jenis_kelamin', $penyewa->jenis_kelamin) ==
                                    'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="perempuan" {{ old('jenis_kelamin', $penyewa->jenis_kelamin) ==
                                    'perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="telp">No Telp/WA</label>
                            <input type="text" name="telp" id="telp"
                                class="form-control @error('telp'){{'is-invalid'}}@enderror" value="{{$penyewa->telp}}">
                            @error('telp')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" id="alamat"
                                class="form-control @error('alamat') is-invalid @enderror"
                                required>{{ old('alamat', $penyewa->alamat) }}</textarea>
                            @error('alamat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username"
                                class="form-control @error('username'){{'is-invalid'}}@enderror"
                                value="{{$penyewa->username}}">
                            @error('username')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password"
                                class="form-control @error('password'){{'is-invalid'}}@enderror"
                                value="{{$penyewa->password}}">
                            @error('password')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="form-control @error('password_confirmation'){{'is-invalid'}}@enderror"
                                value="{{$penyewa->password_confirmation}}">
                            @error('password_confirmation')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">SAVE</button>
                            <a href="{{ route('tampil.penyewa') }}" class="btn btn-danger">CANCEL</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://datatables.net/legacy/v1/media/js/jquery.dataTables.js"></script>
<script src="https://datatables.net/legacy/v1/media/js/dataTables.bootstrap5.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<script>
    $('#example').DataTable();
</script>

@endsection

</html>