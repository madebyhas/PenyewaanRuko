<?php

namespace App\Http\Controllers\Admin\Laporan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tagihan;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index()
    {
        return view('Laporan.index');
    }

    public function getLaporan(Request $request)
    {
        $from = $request->from . ' ' . '00:00:00';

        $to = $request->to . ' ' . '23:59:59';

        $tagihan = Tagihan::whereBetween('created_at', [$from, $to])->get();
        $from = $request->from . ' ' . '00:00:00';

        $to = $request->to . ' ' . '23:59:59';

        $tagihan = Tagihan::whereBetween('created_at', [$from, $to])
            ->where('status', 'selesei')
            ->get();
        //$tagihan = tagihan::whereBetween('created_at', [$from, $to])->get();

        $status = Tagihan::where('status', 'selesei')->get();

        return view('Laporan.index', ['tagihan' => $tagihan, 'from' => $from, 'to' => $to]);
    }
    public function cetakLaporan($from, $to)
    {
        $tagihan = Tagihan::whereBetween('created_at', [$from, $to])->get();

        $pdf = Pdf::loadView('laporan.cetak', ['tagihan' => $tagihan]);
        return $pdf->download('Laporan.pdf');
    }
    // public function download() {
    //     $pdf = Pdf::loadView('pdf');
     
    //     return $pdf->download();
    // }

}
