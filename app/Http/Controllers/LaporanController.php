<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obat;
use App\Models\Transaksi;
use DB;

class LaporanController extends Controller
{
    
    public function index_pengeluaran(Request $request)
    {
        $datas = Obat::join('transaksis', 'transaksis.kode_inv', 'obats.kode_inv');
        $order = $request->order;
        $tipe = 'pengeluaran';

        if($request->search){
            $datas = $datas->where('obats.nama', 'LIKE', '%'.$request->search.'%');
        }

        if ($order) {
            $datas = $datas->orderBy('transaksis.tgl_transaksi', $order);
        }else{
            $datas = $datas->orderBy('transaksis.tgl_transaksi', "desc");
        }

        $datas = $datas->where('tipe', 'pengeluaran')->paginate(10)->withQueryString();

        return view('pages.laporan', compact('datas','tipe','order'));
    }

    public function index_pemasukan(Request $request)
    {
        $datas = Obat::join('transaksis', 'transaksis.kode_inv', 'obats.kode_inv');
        $order = $request->order;
        $tipe = 'pemasukan';

        if($request->search){
            $datas = $datas->where('obats.nama', 'LIKE', '%'.$request->search.'%');
        }

        if ($order) {
            $datas = $datas->orderBy('transaksis.tgl_transaksi', $order);
        }else{
            $datas = $datas->orderBy('transaksis.tgl_transaksi', "desc");
        }

        $datas = $datas->where('tipe', 'pemasukan')->paginate(10)->withQueryString();

        return view('pages.laporan', compact('datas','tipe','order'));
    }

    public function index(Request $request)
    {
        $totalPemasukan = Transaksi::where('tipe', 'pemasukan')->count();
        $totalPengeluaran = Transaksi::where('tipe', 'pengeluaran')->count();
        $revenue = DB::select(DB::raw("SELECT  SUM(t.jumlah*o.harga) as total FROM transaksis t JOIN obats o ON t.kode_inv = o.kode_inv WHERE t.tipe = 'pengeluaran'"));
        $revenue = $revenue[0]->total;

        //recent sales
        $recentSales = Obat::join('transaksis', 'transaksis.kode_inv', 'obats.kode_inv')->orderBy('transaksis.tgl_transaksi', "desc")->paginate(10);

        // topSelling
        $topSelling = DB::select(DB::raw("SELECT o.nama,o.harga,sum(t.jumlah) as jumlah  FROM transaksis t JOIN obats o ON t.kode_inv = o.kode_inv WHERE t.tipe = 'pengeluaran' group by o.kode_inv  order by sum(t.jumlah) desc"));

        return view('pages.dashboard', compact('totalPemasukan','totalPengeluaran','revenue','topSelling','recentSales'));

    }
}
