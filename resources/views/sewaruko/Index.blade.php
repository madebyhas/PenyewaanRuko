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
                    <h4><B>SEWA RUKO</B></h4>
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
        <!--  Row 1 -->
        <div class="row">
            <div class="col-lg-12 d-flex align-items-strech">
                <div class="card w-100">
                    <div class="card-header d-flex justify-content-between align-items-center"
                        style="background-color: rgba(0, 0, 255, 0.5); color: white;">
                        <h4><b>Data Sewa Ruko</b></h4>
                        {{-- <h4 href="{{ route('sewaruko.create') }}" class="btn btn-light"> --}}
                            <button data-toggle="modal" data-target="#modal-add" type="button" class="btn btn-light"> <i
                                    class="ti ti-text-plus"></i> Data Sewa Ruko</button>
                        </h4>
                    </div>

                    <div class="card-body">
                        <table id="example" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Penyewa</th>
                                    <th>Nama Ruko</th>
                                    <th>Tanggal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sewarukos as $key => $value)
                                <tr>
                                    <td>{{ $key += 1 }}</td>
                                    <td>{{ $value->penyewa->nama_penyewa }}</td>
                                    <td>{{ $value->ruko->jenis_ruko }}</td>
                                    {{-- <td>{{ $value->tgl_sewa }}</td> --}}
                                    <td>{{ date('d-m-Y', strtotime($value->tgl_sewa)) }}</td>
                                    <td>
                                        <form action="{{ route('sewaruko.edit', $value->id_sewaruko) }}" method="GET"
                                            style="display:inline;">
                                            <button type="submit" class="btn btn-info btn-round btn-just-icon btn-sm">
                                                <i class="ti ti-edit text-xl"></i>
                                            </button>
                                        </form>

                                        <form action="{{ route('sewaruko.destroy', $value->id_sewaruko) }}"
                                            method="POST" style="display:inline;">
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
                                    <th>Nama Penyewa</th>
                                    <th>Nama Ruko</th>
                                    <th>Tanggal</th>
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
                    <h5 class="modal-title">Tambah Data Sewa Ruko</h5>
                </div>
                <div class="modal-body p-3">
                    <form id="fdata" action="{{route('sewaruko.store')}}" method="POST">
                        @csrf
                        <!-- Nama Penyewa input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            <label class="form-label" for="penyewa_id">Nama Penyewa</label>
                            <div class="input-group">
                                <select name="penyewa_id" id="penyewa_id"
                                    class="form-control @error('penyewa_id') is-invalid @enderror" required autofocus">
                                    <option value="" selected disabled hidden>-- Pilih Nama Penyewa --</option>
                                    @foreach($penyewa as $row)
                                    <option value="{{ $row->id_penyewa }}">{{ $row->nama_penyewa }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('penyewa_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <!-- End Nama Penyewa input -->

                        <!-- Nama Ruko input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            <label class="form-label" for="ruko_id">Nama Ruko</label>
                            <div class="input-group">
                                <select name="ruko_id" id="ruko_id"
                                    class="form-control @error('ruko_id') is-invalid @enderror" required autofocus">
                                    <option value="" selected disabled hidden>-- Pilih Nama Usaha --</option>
                                    @foreach($ruko as $row)
                                    <option value="{{ $row->id_ruko }}">{{ $row->jenis_ruko }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('ruko_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <!-- End Nama usaha input -->

                        <!-- Durasi Sewa input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            <label class="form-label" for="durasi">Durasi Sewa</label>
                            <select id="durasi" name="durasi" class="form-control @error('durasi') is-invalid @enderror"
                                required autofocus>
                                <option value="" disabled selected>Pilih Durasi Sewa</option>
                                <option value="0.3">3 Bulan</option>
                                <option value="0.6">6 Bulan</option>
                                <option value="1.2">1 Tahun</option>
                            </select>
                            @error('durasi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <!-- End Durasi Sewa input -->
                        


                        <!-- No Ruko input -->
                        <input type="hidden" name="tgl_sewa" value="{{ old('tgl_sewa') }}">
                        <!-- End No Ruko input -->


                        <!-- Submit button -->
                        <div class="text-end">
                            <button type="submit" data-mdb-button-init data-mdb-ripple-init
                                class="btn btn-primary btn-block">Simpan</button>
                        </div>
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