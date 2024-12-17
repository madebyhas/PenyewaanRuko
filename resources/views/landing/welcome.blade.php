<!DOCTYPE html>
@extends('landing.partials.head')
@section('css')

<!--  Section Container-->
@section('container')
<!--  Body Wrapper -->
<div class="site-mobile-menu site-navbar-target">
    <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close">
            <span class="icofont-close js-menu-toggle"></span>
        </div>
    </div>
    <div class="site-mobile-menu-body"></div>
</div>
<div class="hero dark-background">
    {{-- <img src="{{ asset('landing/images/aksarradepan.png') }}" alt="" data-aos="fade-in"> --}}
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <div class="intro-wrap">
                    <h1 class="mb-5"><span class="d-block">Kudus Foods and Beverage Center Complete Breakfast-Lunch-Dinner</h1>
                    <div class="row">
                        <div class="col-12">
                            <div class="row align-items-center">
                                <div class="col-sm-12 col-lg-2">
                                    @if(Auth::guard('penyewa')->check())
                                    @else
                                    <div class="d-flex text-center">
                                        <a class="btn btn-primary mx-2" href="{{ route('login') }}">
                                            Login
                                        </a>
                                        <a class="btn btn-white bg-white" href="{{ route('register') }}">
                                            Register
                                        </a>
                                    </div>
                                    @endauth
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-lg-5 feature-img-bg">
                <img src="{{ asset('landing/images/aksarradepan.png') }}" alt="Image" class="img-fluid active">
            </div> --}}
            <div class="col-lg-5">
                <div class="slides">
                    <img src="{{ asset('landing/images/aksarradepan.png') }}" alt="Image" class="img-fluid active">
                </div>
            </div>
        </div>
    </div>
</div>



@if(Auth::guard('penyewa')->check())
<div class="untree_co-section">
    <div class="container">
        {{-- Menampilkan pesan sukses --}}
        @if (session('success'))
        <div class="alert alert-primary">
            {{ session('success') }}
        </div>
        @endif

        {{-- Menampilkan pesan error jika ada --}}
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="row justify-content-center text-center">
            <div class="col-lg-6">
                <h2 class="section-title text-center mb-3">Rekomendasi Ruko</i> </h2>
            </div>
        </div>
        <div class="row">
            @if($rukos->isEmpty())
            <tr>
                <td colspan="8" style="text-align: center;">
                    <div class="alert alert-warning" role="alert">
                        Tidak ada ruko tersedia, Mohon kembali beberapa waktu ke depan.
                    </div>
                </td>
            </tr>
            @else
            @foreach($rukos as $ruko)
            <div class="col-6 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
                <div class="media-1">
                    <a class="d-block mb-3">
                        <img src="{{ asset('landing/images/store.jpg') }}" alt="Image" class="img-fluid">
                    </a>
                    <div class="d-flex align-items-center">
                        <div>
                            <h4>
                                <a href="#">{{ $ruko->jenis_ruko }} <span
                                        class="badge small-badge bg-success text-white"
                                        style="font-size: 15px;">Available</span></a>
                            </h4>
                            <div class="price mx-auto">
                                <span>No: {{ $ruko->no_ruko }}</span><br>
                                <span>Luas: {{ $ruko->luas_ruko }} M2</span><br>
                                <span>Rp. {{ number_format($ruko->harga, 0, '.', ',') }}/Bulan</span>
                            </div>
                        </div>
                    </div>
                    <form action="{{ route('ruko.addToCart') }}" method="POST">
                        @csrf
                        <input type="hidden" name="ruko_id" value="{{ $ruko->id_ruko }}">
                        <button type="submit" class=" btn btn-primary btn-block text-center">+ Add to cart</button>
                    </form>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</div>
@else
@endauth



<div class="untree_co-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <h2 class="section-title text-center mb-3">Layanan Kami</h2>
            </div>
        </div>
        <div class="row align-items-stretch">
            <div class="col-lg-4 order-lg-1">
                <div class="h-100">
                    <div class="frame h-100">
                        <div class="feature-img-bg h-100" style="background-image: url('landing/images/4.png');">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-sm-6 col-lg-4 feature-1-wrap d-md-flex flex-md-column order-lg-1">

                <div class="feature-1 d-md-flex">
                    <div class="align-self-center">
                        <span class="flaticon-house display-4 text-primary"></span>
                        <h3>Tempat Nyaman</h3>
                        <p class="mb-0">Ruang yang nyaman untuk bersantai bersama keluarga, teman, maupun kolega.</p>
                    </div>
                </div>

                <div class="feature-1">
                    <div class="align-self-center">
                        <span class="flaticon-restaurant display-4 text-primary"></span>
                        <h3>Restoran & Kafe</h3>
                        <p class="mb-0">Rasakan beragam kuliner lezat di tempat kami.</p>
                    </div>
                </div>

            </div>

            <div class="col-6 col-sm-6 col-lg-4 feature-1-wrap d-md-flex flex-md-column order-lg-3">

                <div class="feature-1 d-md-flex">
                    <div class="align-self-center">
                        <span class="flaticon-mail display-4 text-primary"></span>
                        <h3>Mudah Terhubung</h3>
                        <p class="mb-0">Kami siap membantu Anda dalam menghubungi kami untuk reservasi ataupun acara.
                        </p>
                    </div>
                </div>

                <div class="feature-1 d-md-flex">
                    <div class="align-self-center">
                        <span class="flaticon-phone-call display-4 text-primary"></span>
                        <h3>Dukungan 24/7</h3>
                        <p class="mb-0">Tim kami siap membantu Anda kapan saja.</p>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

<div id="overlayer"></div>
<div class="loader">
    <div class="spinner-border" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<script>
    // $(document).ready(function() {
//     let selectedRukoIds = []; // Array untuk menyimpan ID Ruko yang dipilih

//     // Saat tombol "Add Ruko" diklik
//     $('.btn-primary').on('click', function() {
//         const rukoId = $(this).data('ruko-id'); // Ambil ID Ruko dari data-*

//         if (!selectedRukoIds.includes(rukoId)) {
//             selectedRukoIds.push(rukoId); // Tambahkan ID Ruko ke array
//         }

//         // Update input tersembunyi dengan ID Ruko yang dipilih
//         $('#ruko_ids').val(selectedRukoIds.join(',')); // Simpan sebagai string
//         $('#selected_ruko_id').val(selectedRukoIds.join(', ')); // Tampilkan di input yang terlihat
//     });
// });
</script>

</html>