<!DOCTYPE html>
@extends('landing.partials.head')
@section('css')

@section('container')

<div class="register">
    <div class="container">
        <h1 class="text-center" style="font-size: 2rem;">Detail Penyewaan Ruko</h1> <!-- Adjust font size -->
        <hr class="mb-4">
        <div class="d-flex justify-content-center align-items-center">
            <div class="col">
                @if($sewarukos->isEmpty())
                    <p>Anda belum menyewa ruko.</p>
                @else
                    @foreach($sewarukos as $sewaruko)
                        <div class="card mb-4">
                            <div class="card-body p-4">
                                <div class="row align-items-center">
                                    <div class="col-md-2">
                                        <img src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/E-commerce/Products/1.webp" class="img-fluid" alt="Generic placeholder image">
                                    </div>
                                    <div class="col-md-2 d-flex justify-content-center">
                                        <div>
                                            <p class="small text-muted mb-4 pb-2">Jenis Ruko</p>
                                            <p class="lead fw-normal mb-0">{{ $sewaruko->ruko->jenis_ruko }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-2 d-flex justify-content-center">
                                        <div>
                                            <p class="small text-muted mb-4 pb-2">No Ruko</p>
                                            <p class="lead fw-normal mb-0">{{ $sewaruko->ruko->no_ruko }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-2 d-flex justify-content-center">
                                        <div>
                                            <p class="small text-muted mb-4 pb-2">Luas Ruko</p>
                                            <p class="lead fw-normal mb-0">{{ $sewaruko->ruko->luas_ruko }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-2 d-flex justify-content-center">
                                        <div>
                                            <p class="small text-muted mb-4 pb-2">Tanggal Sewa</p>
                                            <p class="lead fw-normal mb-0">{{ $sewaruko->tgl_sewa }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-2 d-flex justify-content-center">
                                        <div>
                                            <p class="small text-muted mb-4 pb-2">Total Harga</p>
                                            <p class="lead fw-normal mb-0">Rp. {{ number_format($sewaruko->ruko->harga, 0, ',', '.') }} <!-- Menggunakan koma sebagai pemisah desimal dan titik sebagai pemisah ribuan -->
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
        
                    <div class="card mb-5">
                        <div class="card-body p-4">
                            <div class="text-end">
                                <p class="mb-0 me-5 d-flex justify-content-end">
                                    <span class="lead fw-normal me-auto">Order total: <u> Rp. {{ number_format($totalHarga, 0, ',', '.') }} </u><!-- Menggunakan koma sebagai pemisah desimal dan titik sebagai pemisah ribuan -->
                                    </b></span>
                                    
                                </p>
                            </div>
                        </div>
                    </div>
        
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('dashboard') }}" class="btn btn-light btn-lg me-2">Kembali</a>
                        <button type="button" class="btn btn-primary btn-lg">Add to cart</button>
                    </div>
                @endif
            </div>
        </div>
        

        {{-- <div class="form-group col-12">
            <label for="sewaRuko">Daftar Sewa Ruko</label>
            @if($sewarukos->isEmpty())
            <p>Anda belum menyewa ruko.</p>
            @else
            @foreach($sewarukos as $sewaruko)
            <div class="form-group">
                <label>ID Sewa: {{ $sewaruko->id }}</label>
                <input type="text" class="form-control" value="{{ $sewaruko->id }}" disabled>

                <label>Ruko ID: {{ $sewaruko->ruko_id }}</label>
                <input type="text" class="form-control" value="{{ $sewaruko->ruko_id }}" disabled>

                <label>Tanggal Sewa: {{ $sewaruko->tgl_sewa }}</label>
                <input type="text" class="form-control" value="{{ $sewaruko->tgl_sewa }}" disabled>

                <label>Total Harga: {{ $sewaruko->ruko->harga }}</label>
                <input type="text" class="form-control" value="{{ $sewaruko->ruko->harga }}" disabled>

                <a href="{{ route('sewaruko.show', $sewaruko->id) }}" class="btn btn-primary mt-2" disabled>Detail</a>
            </div>
            @endforeach

            <h3>Total Harga: {{ $totalHarga }}</h3> <!-- Menampilkan total harga -->
            @endif
        </div> --}}

    </div>
</div>
</div>
</div>

@endsection

</html>