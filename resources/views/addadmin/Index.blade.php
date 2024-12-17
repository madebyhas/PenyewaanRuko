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
                <div class="col-sm-6">
                    <h4><B>Admin</B></h4>
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
   
    <div class="container-fluid">
         <!--  Pesan validasi -->
         @if ($errors->any())
         <div class="alert alert-danger">
             <ul>
                 @foreach ($errors->all() as $error)
                 <li>{{ $error }}</li>
                 @endforeach
             </ul>
         </div>
         @endif
 
         @if (session('success'))
         <div class="alert alert-primary">
             {{ session('success') }}
         </div>
         @endif
         <!--  End Pesan Validasi -->

        <!--  Row 1 -->
        <div class="row">
            <div class="col-lg-12 d-flex align-items-strech">
                <div class="card w-100">
                    <div class="card-header d-flex justify-content-between align-items-center"
                        style="background-color: rgba(0, 0, 255, 0.5); color: white;">
                        <h4><b>Data Admin</b></h4>
                        {{-- <h4 href="{{ route('ruko.create') }}" class="btn btn-light"> --}}
                            <button data-toggle="modal" data-target="#modal-add" type="button" class="btn btn-light"> <i
                                    class="ti ti-text-plus"></i> Data Admin</button>
                        </h4>
                    </div>

                    <div class="card-body">
                        <table id="example" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Admin</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>No Telp</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($admin as $key => $value)
                                <tr>
                                    <td>{{ $key += 1 }}</td>
                                    <td>{{ $value->nama_admin }}</td>
                                    <td>{{ $value->username }}</td>
                                    <td>********</td>
                                    <td>{{ $value->telp }}</td>
                                    <td>
                                        <form action="{{ route('admin.edit', $value->id_admin) }}" method="GET" style="display:inline;">
                                            <button type="submit"
                                                class="btn btn-success btn-round btn-just-icon btn-sm">
                                                <i class="ti ti-edit text-xl"></i>
                                            </button>
                                        </form>

                                        <form action="{{ route('admin.destroy', $value->id_admin) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-round btn-just-icon btn-sm">
                                                <i class="ti ti-trash-x text-xl"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Admin</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>No Telp</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal-add" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
        <div class="modal-dialog d-flex justify-content-center">
            <div class="modal-content w-100">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Ruko</h5>
                </div>
                <div class="modal-body p-3">
                    <form id="fdata" action="{{route('tambah.admin')}}" method="POST">
                        @csrf
                        <!-- Nama Admin input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            <label class="form-label" for="nama_admin">Nama Admin</label>
                            <input type="text" id="nama_admin" name="nama_admin"
                                class="form-control @error('nama_admin') is-invalid @enderror"
                                value="{{ old('nama_admin') }}" />
                            @error('nama_admin')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <!-- End Nama Admin input -->
                        <!-- No Telp input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            <label class="form-label" for="telp">NO Telp/WA</label>
                            <input type="text" id="telp" name="telp"
                                class="form-control @error('telp') is-invalid @enderror" value="{{ old('telp') }}" />
                            @error('telp')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <!-- End no telp input -->

                        <!-- username input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            <label class="form-label" for="username">Username</label>
                            <input type="text" id="username" name="username"
                                class="form-control @error('username') is-invalid @enderror"
                                value="{{ old('username') }}" />
                            @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <!-- End username input -->

                        <!-- password input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            <label class="form-label" for="password">Password</label>
                            <input type="password" id="password" name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                value="{{ old('password') }}" />
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <!-- End password input -->
                        <!-- password_confirmation input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            <label class="form-label" for="password_confirmation">Konfirmasi Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                value="{{ old('password_confirmation') }}" />
                            @error('password_confirmation')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <!-- End password_confirmation input -->
                        <!-- Submit button -->
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Daftar</button>
                        </div>
                        <!-- End Submit button -->


                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->

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