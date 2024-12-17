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
                    <h4><B>TAGIHAN</B></h4>
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
                        <h4><b>Data Tagihan</b></h4>
                        {{-- <h4 href="{{ route('sewaruko.create') }}" class="btn btn-light"> --}}
                            {{-- <button data-toggle="modal" data-target="#modal-add" type="button"
                                class="btn btn-light"> <i class="ti ti-text-plus"></i> Data Sewa Ruko</button> --}}
                        </h4>
                    </div>

                    <div class="card-body">
                        <table id="tagihan" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Penyewa</th>
                                    <th>Jenis Ruko</th>
                                    <th>Total</th>
                                    <th>Pembayaran Awal</th>
                                    <th>Pembayaran Terakhir</th>
                                    {{-- <th>Bukti</th> --}}
                                    <th>Status</th>
                                    <th class="text-center" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tagihan as $key => $value)
                                <tr>
                                    <td>{{ $key += 1 }}</td>
                                    <td>{{ $value->sewaruko->penyewa->nama_penyewa }}</td>
                                    <td>{{ $value->sewaruko->ruko->jenis_ruko }}</td>
                                    <td>Rp.{{ number_format($value->total, 0, ',','.') }}</td>
                                    <td>{{ date('d-M-Y', strtotime($value->tgl_awal_tagihan)) }}</td>
                                    <td>{{ date('d-M-Y', strtotime($value->tgl_akhir_tagihan)) }}</td>
                                    {{-- <td>
                                        <img src="/storage/pesanan/{{ $value->bukti }}" alt="Bukti Transfer" style="max-width: 100px; max-height: 100px;">
                                    </td> --}}

                                    <td>
                                        @if ($value->status === '0')
                                        <span class="badge bg-danger rounded">Pending</span>
                                        @elseif ($value->status === 'selesei')
                                        <span class="badge bg-success rounded">Selesei</span>
                                        @else
                                        <span class="badge bg-warning rounded">batal</span>
                                        @endif
                                    </td>
                                    <td> 
                                        <form action="{{ route('tagihan.show', $value->id_tagihan) }}" method="GET" style="display:inline;">
                                            <button type="submit" class="btn btn-info btn-round btn-just-icon btn-sm">
                                                <i class="ti ti-file-check"></i>
                                            </button>
                                        </form>

                            
                                        <form action="{{ route('tagihan.destroy', $value->id_tagihan) }}" method="POST" style="display:inline;">
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
                                    <th>jenis Ruko</th>
                                    <th>Total</th>
                                    <th>Pembayaran Awal</th>
                                    <th>Pembayaran Terakhir</th>
                                    {{-- <th>Bukti</th> --}}
                                    <th>Status</th>
                                    <th class="text-center">Action</th>
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
                    <form id="fdata" action="{{route('sewaruko.store')}}" method="POST">
                        @csrf
                        <!-- Jenis Ruko input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            <label class="form-label" for="jenis_ruko">Jenis Ruko</label>
                            <input type="text" id="jenis_ruko" name="jenis_ruko"
                                class="form-control @error('jenis_ruko') is-invalid @enderror"
                                value="{{ old('jenis_ruko') }}" />
                            @error('jenis_ruko')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Luas Ruko input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            <label class="form-label" for="luas_ruko">Luas Ruko</label>
                            <div class="input-group">
                                <input type="number" id="luas_ruko" name="luas_ruko"
                                    class="form-control @error('luas_ruko') is-invalid @enderror"
                                    value="{{ old('luas_ruko') }}" />
                                <span class="input-group-text">M2</span>
                            </div>
                            @error('luas_ruko')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>


                        <!-- No Ruko input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            <label class="form-label" for="no_ruko">No Ruko</label>
                            <input type="number" id="no_ruko" name="no_ruko"
                                class="form-control @error('no_ruko') is-invalid @enderror"
                                value="{{ old('no_ruko') }}" />
                            @error('no_ruko')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Harga input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            <label class="form-label" for="harga">Harga</label>
                            <input type="number" id="harga" name="harga"
                                class="form-control @error('harga') is-invalid @enderror" value="{{ old('harga') }}" />
                            @error('harga')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Submit button -->
                        <button type="submit" data-mdb-button-init data-mdb-ripple-init
                            class="btn btn-primary btn-block">Simpan</button>
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
    $(document).ready(function() {
        $('#tagihan').DataTable({
        });
    });
</script>

@endsection

</html>