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
                    <h4><B>LAPORAN</B></h4>
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
            <div class="col-lg-12 col-12">
                <div class="card">
                    <div class="card-header text-primary"><i class="ti ti-alert-octagon"></i>
                            Mohon Isi Sesuai Tanggal Tagihan Yang Ingin Dicetak!
                        </i>
                    </div>
                </div>
            </div>
        </div>

        <div class="row my-4">
            <div class="col-lg-4 col-12">
                <div class="card">
                    <div class="card-header text-white bg-primary">
                        Cari Berdasarkan Tanggal
                    </div>
                    <div class="card-body">
                        <form action="{{ route('laporan.getLaporan') }}" method="POST">
                            @csrf
                            <div class="form-group mt-4">
                                <input type="text" name="from" class="form-control" placeholder="Tanggal Awal"
                                    onfocusin="(this.type='date')" onfocusout="
                                (this.type='text')">
                            </div>
                            <div class="form-group mt-4">
                                <input type="text" name="to" class="form-control" placeholder="Tanggal Akhir"
                                    onfocusin="(this.type='date')" onfocusout="
                                (this.type='text')">
                            </div>
                            <button type="submit" class="btn btn-primary mt-3" style="width: 100%">Cari Laporan</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-12">
                <div class="card">
                    <div class="card-header text-white bg-primary">
                        Data Berdasarkan Tanggal
                        <div class="text-end">
                            @if($tagihan ?? '')
                            <a href="{{ route('laporan.cetakLaporan', ['from' => $from, 'to' => $to]) }}"
                                class="btn btn-danger"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Unduh PDF</a>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        @if($tagihan ?? '')
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Tanggal</th>
                                    <th>Isi tagihan</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tagihan as $key => $value)
                                <tr>
                                    <td>{{ $key += 1 }}</td>
                                    <td>{{ $value->sewaruko->penyewa->nama_penyewa }}</td>
                                    <td>{{ date('d-m-Y', strtotime($value->tgl_akhir_tagihan)) }}</td>
                                    <td>Rp.{{ number_format($value->total, 0, ',','.') }}</td>
                                    {{-- <td>
                                        <img src="{{ asset('storage/' . $value->bukti) }}" alt="Bukti Transfer"
                                            style="max-width: 100px; max-height: 100px;">
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
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <div class="text-center">
                            Tidak Ada Data
                        </div>
                        @endif
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
    $(document).ready(function() {
        $('#tagihan').DataTable({
        });
    });
</script>

@endsection

</html>