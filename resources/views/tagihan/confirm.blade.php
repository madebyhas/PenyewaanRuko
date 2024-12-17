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
                    <h4><B>DATA TAGIHAN</B></h4>
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
                    <h4><b>Edit Data Tagihan</b></h4>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Detail Tagihan</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="form-group col-auto mt-3">
                                        <label for="nama_penyewa">Nama Penyewa</label>
                                        <fieldset disabled>
                                            <input type="text" class="form-control @error('nama_penyewa') {{ "
                                                is-invalid" }} @enderror" id="nama_penyewa" name="nama_penyewa"
                                                value="{{ $tagihan->sewaruko->penyewa->nama_penyewa }}" disabled>
                                        </fieldset>
                                    </div>
                                    <div class="form-group col-auto mt-3">
                                        <label for="total">Total Tagihan</label>
                                        <fieldset disabled>
                                            <input type="text" class="form-control @error('total') {{ " is-invalid" }}
                                                @enderror" id="total" name="total"
                                                value="Rp. {{ number_format($tagihan->total, 0, ',','.') }}" disabled>
                                        </fieldset>
                                    </div>
                                    <div class="form-group col-auto mt-3">
                                        <label for="metode">Metode</label>
                                        <fieldset disabled>
                                            <input type="text" class="form-control @error('metode') {{ " is-invalid" }}
                                                @enderror" id="metode" name="metode" value="{{ $tagihan->metode }}"
                                                disabled>
                                        </fieldset>
                                    </div>
                                    {{-- <div class="form-group col-auto mt-3">
                                        <label for="ruko">Ruko</label>
                                        <fieldset disabled>
                                            <input type="text" class="form-control @error('ruko') {{ " is-invalid" }}
                                                @enderror" id="ruko" name="ruko"
                                                value="{{$tagihan->sewaruko->ruko->jenis_ruko }}" disabled>
                                        </fieldset>
                                    </div> --}}
                                    <div class="form-group mt-3">
                                        <label for="ruko">Ruko</label>
                                        <input type="text" class="form-control" id="ruko" name="ruko"
                                            value="{{ $tagihan->sewaruko->ruko->pluck('jenis_ruko')->implode(', ') }}"
                                            disabled>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label class="mt-3" for="ruko">Bukti</label>
                                        <br>
                                        <img class="img-fluid mt-3" src="{{ Storage::url($tagihan->bukti) }}" alt="Bukti Transfer">
                                        

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- general form elements -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Konfirmasi Pembayaran</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <div class="card-body">
                                <form method="post" action="{{route("tagihan.update",$tagihan->id_tagihan)}}" enctype="multipart/form-data">
                                    @csrf
                                    @method('patch')
                                    
                                    <input type="hidden" name="id_tagihan" value="{{ $tagihan->id_tagihan }}">
                                    <div class="mb-3">
                                        <label for="status">Status</label>
                                        <select id="status" name="status" class="form-control @error('status') is-invalid @enderror" required>
                                                @if($tagihan->status == '0')
                                                    <option selected value="0">Pending</option>
                                                    <option value="selesei">Selesei</option>
                                                    <option value="batal">Batal</option>
                                                @elseif($tagihan->status == "selesei")
                                                    <option value="0">Pending</option>
                                                    <option value="selesei">Selesei</option>
                                                    <option selected value="batal">Batal</option>
                                                @else
                                                    <option value="0">Pending</option>
                                                    <option selected value="selesei">Selesei</option>
                                                    <option value="batal">Batal</option>
                                                @endif
                                            </select>
                                        @error('status')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </form>
                                
                            </div>
                            
                            <!-- /.card-body -->

                        </div>

                    </div>
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