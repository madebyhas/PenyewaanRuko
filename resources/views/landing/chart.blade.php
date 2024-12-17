<!DOCTYPE html>
@extends('landing.partials.head')
@section('css')

@section('container')
<div class="register">
    <div class="container">
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
        <h1 class="text-center" style="font-size: 2rem;">Detail Penyewaan Ruko</h1>
        <hr class="mb-4">
        <div class="d-flex justify-content-center align-items-center">
            <div class="col">

                @if(session('cart'))
                @foreach(session('cart') as $id_ruko => $details)
                <div class="row">
                    <div class="card mb-4" data-id="{{ $id_ruko }}">
                        <div class="card-body p-4">
                            <div class="row align-items-center">
                                <div class="col-md-2">
                                    <img src="{{ asset('landing/images/store.jpg') }}" class="img-fluid"
                                        alt="Generic placeholder image">
                                </div>
                                <div class="col-md-2 d-flex justify-content-center">
                                    <div>
                                        <p class="small text-muted mb-4 pb-2">Jenis Ruko</p>
                                        <p class="lead fw-normal mb-0">{{ $details['jenis_ruko'] }}</p>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex justify-content-center">
                                    <div>
                                        <p class="small text-muted mb-4 pb-2">No Ruko</p>
                                        <p class="lead fw-normal mb-0">{{ $details['no_ruko'] }}</p>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex justify-content-center">
                                    <div>
                                        <p class="small text-muted mb-4 pb-2">Luas Ruko</p>
                                        <p class="lead fw-normal mb-0">{{ $details['luas_ruko'] }}</p>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex justify-content-center">
                                    <div>
                                        <p class="small text-muted mb-4 pb-2">Harga</p>
                                        <p class="lead fw-normal mb-0">Rp. {{ number_format($details['harga'], 0, ',',
                                            '.') }}</p>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex justify-content-center">
                                    <div>
                                        <p class="small text-muted mb-4 pb-2">Hapus</p>
                                        <form action="{{ route('ruko.remove', $id_ruko) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="text-right mb-3">
                    {{-- <a href="{{ route('dashboard') }}" class="btn btn-warning">
                        <i class="fa fa-angle-left"></i> Continue Shopping
                    </a> --}}

                    {{-- <form action="{{ route('checkout') }}" method="POST" style="display: inline;">
                        @csrf
                        @if(session('cart'))
                        @foreach(session('cart') as $id_ruko => $details)
                        <input type="hidden" name="ruko_id[]" value="{{ $id_ruko }}">
                        @endforeach
                        @endif
                        <input type="hidden" name="penyewa_id" value="{{ auth()->user()->id_penyewa }}">
                        <button type="submit" class="btn btn-success">Checkout</button>
                    </form> --}}
                    <button data-toggle="modal" data-target="#modal-add" type="button" class="btn btn-primary"> <i
                            class="ti ti-text-plus"></i> Checkout</button>
                </div>

                @else
                <div class="text-center">
                    <h5 class="text-center mb-4">Keranjang Anda Kosong.</h5>
                    <a href="{{ route('dashboard') }}" class="btn btn-warning">
                        <i class="fa fa-angle-left"></i> Continue Shopping
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-add" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
    <div class="modal-dialog d-flex justify-content-center">
        <div class="modal-content w-100">
            <div class="modal-header">
                <h5 class="modal-title">Sewa Ruko</h5>
            </div>
            <div class="modal-body p-3">
                <form action="{{ route('checkout') }}" method="POST" style="display: inline;">
                    @csrf
                    @if(session('cart'))
                    @foreach(session('cart') as $id_ruko => $details)
                    {{-- sesi ID Ruko --}}
                    <input type="hidden" name="ruko_id[]" value="{{ $id_ruko }}">
                    @endforeach
                    @endif
                    {{-- ID Penyewa --}}
                    <input type="hidden" name="penyewa_id" value="{{ auth()->user()->id_penyewa }}">
                    <div data-mdb-input-init class="form-outline mb-5">
                        <label class="form-label" for="durasi">Durasi Sewa</label>
                        <select id="durasi" name="durasi" class="form-control @error('durasi') is-invalid @enderror" required autofocus>
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
                    <div class="text-end mb-3">
                        <button type="submit" data-mdb-button-init data-mdb-ripple-init
                            class="btn btn-primary btn-block">Save</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->

@endsection

@section('scripts')

@endsection