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

        <h1 class="text-center" style="font-size: 2rem;">Check Out</h1>
        <hr class="mb-4">
        <div class="d-flex justify-content-center">
            <table style="width: 100%;">
                <tr>
                    <!-- Kolom Kiri -->
                    <td style="width: 40%; vertical-align: top;">

                        @if($sewarukos->isEmpty())
                        <div class="alert alert-warning">You have no rented rukos.</div>
                        @else
                        <div class="products">
                            <table style="width: 90%; margin: 0 auto;">
                                <h3 class="title text-center">Detail Tagihan Anda!</h3>
                                <hr style="width: 90%;">
                                @foreach($sewarukos as $sewaruko)
                                @if($sewaruko->ruko->status == 0) {{-- Memeriksa status ruko --}}
                                <tr>
                                    <td style="text-align: left;">
                                        <p class="item-name"><b> Nama Ruko : </b> <br> {{ $sewaruko->ruko->jenis_ruko }}
                                        </p>
                                        <p class="item-description"><b> No Ruko : </b> {{ $sewaruko->ruko->no_ruko }}
                                            <br>
                                            <b> Luas Ruko: </b> {{ $sewaruko->ruko->luas_ruko }}
                                        </p>
                                    </td>
                                    <td style="text-align: right;">
                                        <span class="price">Rp. {{ number_format($sewaruko->ruko->harga, 0, ',', '.')
                                            }}</span>
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                            </table>
                            <hr style="width: 90%;">
                            <div class="total" style="text-align: right; width: 90%; margin: 0 auto;">
                                <b>Total: <span class="price">Rp. {{ number_format($totalHarga, 0, ',', '.')
                                        }}</span></b>
                            </div>
                            <div style="text-align: right; width: 90%; margin: 0 auto; margin-top: 10px;">
                                <small><i>Catatan: Tanggal terakhir pembayaran adalah {{
                                        \Carbon\Carbon::now()->addDays(7)->format('d-m-Y') }}</i></small>
                            </div>
                        </div>
                        <hr style="width: 90%;">
                        @endif
                    </td>

                    <!-- Kolom Kanan -->
                    <td style="width: 50%; vertical-align: top;">
                        <div class="card-details">
                            @if($tagihan->isEmpty())
                                <h3 class="title text-center">Metode Pembayaran</h3>
                                <hr style="width: 90%;">
                                <form action="{{ route('tagihan.upload') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" id="total" name="total" value="{{ $totalHarga }}">
                    
                                    <div class="form-group">
                                        <label for="metode">Metode Pembayaran</label>
                                        <select name="metode" id="metode" class="form-control" required>
                                            <option value="0">Pilih Metode</option>
                                            <option value="Tunai">Tunai</option>
                                            <option value="BCA">BCA</option>
                                          
                                        </select>
                                    </div>

                                    <div id="bca-info" class="account-info" style="display: none;">
                                        <hr>
                                        <h5>Rekening BCA</h5>
                                        <p>No. Rekening: 123-456-789</p>
                                        <p>Atas Nama: PT. ABCD</p>
                                        <p>Cabang: Jakarta</p>
                                        <hr>
                                    </div>
                    
                                    <div class="form-group mx-2">
                                        <label for="bukti">Bukti Transfer</label>
                                        <input type="file" id="bukti" name="bukti" class="form-control" required>
                                    </div>
                    
                                    <div style="text-align: right; width: 90%; margin: 0 auto;">
                                        <button type="submit" class="btn btn-primary">Bayar</button>
                                    </div>
                                </form>
                            @else
                                @foreach($tagihan as $tagihans)
                                    <hr style="width: 90%;">
                                    <p><b>Total Tagihan:</b> Rp. {{ number_format($tagihans->total, 0, ',', '.') }}</p>
                                    <p><b>Status:</b> {{ $tagihans->status == 0 ? 'Belum Dibayar' : 'Dibayar' }}</p>
                    
                                    <div class="uploaded-proof mt-3">
                                        <h4>Bukti Transfer yang Diupload:</h4>
                                        <a href="{{ asset('storage/' . $tagihans->bukti) }}" target="_blank">Lihat Bukti Transfer</a>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </td>
                    
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>

</script>
@endsection