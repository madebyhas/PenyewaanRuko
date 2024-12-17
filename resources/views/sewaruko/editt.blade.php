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
                    <h4><B>RUKO</B></h4>
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
                    <h4><b>Edit Data Sewaruko</b></h4>
                </div>
                <div class="card-body">
                    <form method="post" action="{{route("sewaruko.update",$sewaruko->id_sewaruko)}}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="mb-3">
                            <label for="penyewa_id">Nama Penyewa</label>
                            <select id="penyewa_id" name="penyewa_id"
                                class="form-control @error('penyewa_id') is-invalid @enderror" required autofocus>
                                <option value="" disabled {{ empty($sewaruko->penyewa->nama_penyewa) ? 'selected' : ''
                                    }}>Pilih Nama Penyewa</option>
                                @foreach($penyewa as $penyewas)
                                <option value="{{ $penyewas->id_penyewa }}" {{ old('penyewa_id', $sewaruko->penyewa_id)
                                    == $penyewas->id_penyewa ? 'selected' : '' }}>
                                    {{ $penyewas->nama_penyewa }}
                                </option>
                                @endforeach
                            </select>

                            @error('penyewa_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>
                        <div class="mb-3">
                            <label for="ruko_id">Jenis Ruko</label>
                            <select id="ruko_id" name="ruko_id"
                                class="form-control @error('ruko_id') is-invalid @enderror" required autofocus>
                                <option value="" disabled {{ empty($sewaruko->ruko->jenis_ruko) ? 'selected' : ''
                                    }}>Pilih jenis Ruko</option>
                                @foreach($ruko as $rukos)
                                <option value="{{ $rukos->id_ruko }}" {{ old('ruko_id', $sewaruko->ruko_id) ==
                                    $rukos->id_ruko ? 'selected' : '' }}>
                                    {{ $rukos->jenis_ruko }}
                                </option>
                                @endforeach
                            </select>

                            @error('ruko_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="durasi">Durasi</label>
                            <select id="durasi" name="durasi" class="form-control @error('durasi') is-invalid @enderror"
                                required autofocus>
                                <option value="" disabled {{ is_null($sewaruko->durasi) ? 'selected' : '' }}>Pilih
                                    Durasi Sewa</option>
                                <option value="0.3" {{ old('durasi', $sewaruko->durasi) == 0.3 ? 'selected' : '' }}>3
                                    Bulan</option>
                                <option value="0.6" {{ old('durasi', $sewaruko->durasi) == 0.6 ? 'selected' : '' }}>6
                                    Bulan</option>
                                <option value="1.2" {{ old('durasi', $sewaruko->durasi) == 1.2 ? 'selected' : '' }}>1
                                    Tahun</option>
                            </select>

                            @error('durasi')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tgl_sewa" class="form-label">Tanggal Sewa</label>
                            <input type="date" id="tgl_sewa" name="tgl_sewa"
                                class="form-control @error('tgl_sewa') is-invalid @enderror" required
                                value="{{ old('tgl_sewa', $sewaruko->tgl_sewa ? date('Y-m-d', strtotime($sewaruko->tgl_sewa)) : '') }}">

                            @error('tgl_sewa')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Save</button>
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