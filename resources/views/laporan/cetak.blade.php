<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <title>Laporan Tagihan Aksara Foods Court</title>

    <style>

        .ttd {
            text-align: right;
        }

        .container {
            max-width: auto;
            margin: auto;
        }

        .container table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            min-height: 200px;
        }
    </style>

</head>

<body>
    <div id="pesanan" class="container">
        <div class="row justify-content-center">
            <table width="100%">
                <tr>
                    <td width="50%">
                        <img src="{{ asset('furni/images/bjlogo.png') }}" style="width: 25%;" />
                    </td>
                    <td width="50%" class="text-center">
                        <h1>AKSARA FOODCOURT KUDUS</h1>
                        <h3>LAPORAN TAGIHAN</h3>
                        <h5>Periode {{ date('F-Y')}}</h5>
                        <p>
                            Jl. Jend. Ahmad Yani No.38, Krajan, Panjunan, Kec. Kota Kudus, Kabupaten Kudus, Jawa Tengah 59317.
                        </p>
                    </td>
                    </th>
                </tr>
            </table>
        </div>
        <hr>
        <div class="container">
            <table class="table">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama Penyewa</th>
                        <th>Nama Usaha</th>
                        <th>Total</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach($tagihan as $key => $value)
                    <tr>
                        <th>{{ $key += 1 }}</th>
                        <th>{{ $value->sewaruko->penyewa->nama_penyewa }}</th>
                        <th>{{ $value->sewaruko->penyewa->nama_usaha }}</th>
                        <th>Rp.{{ number_format($value->total, 0, ',','.') }}</th>

                        <th>{{ $value->status == '0' ? 'Pending' : ucwords($value->status) }}</th>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <br>
        <br>
        <br>
        <div class="ttd">
            <div class="kiri"></div>
            <div class="main">
                <div class="atas">
                    <p>Kudus, {{ date('d-m-Y')}}</p>
                    <p>Manager</p>
                </div>
                <div class="sign mb-5">
                    <br>
                </div>

                <div class="bawah">
                    <p class="mb-4"><b>M.Fathurahman</b></p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>

</body>

</html>