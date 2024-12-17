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

        <h1 class="text-center" style="font-size: 2rem;">Riwayat Pembayaran</h1>
        <hr class="mb-4">
        <div class="d-flex justify-content-center">
            {{-- Cek apakah ada tagihan --}}
            @if($tagihans->isEmpty())
            <p>Tidak ada riwayat pembayaran untuk penyewa ini.</p>
            @else
            <table class="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Penyewa</th>
                        <th>Tanggal Pembayaran</th>
                        <th>Status</th>
                        <th>Jumlah Pembayaran</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tagihans as $tagihan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $tagihan->sewaruko->penyewa->nama_penyewa }}</td>
                        <td>{{ $tagihan->created_at->format('d-M-Y') }}</td>
                        <td>
                            @if ($tagihan->status === '0')
                            <span class="badge bg-danger rounded">PENDING</span>
                            @elseif ($tagihan->status === 'selesei')
                            <span class="badge bg-success rounded">SELESEI</span>
                            @else
                            <span class="badge bg-warning rounded">BATAL</span>
                            @endif
                        </td>
                        <td>Rp {{ number_format($tagihan->total, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>

</script>
@endsection