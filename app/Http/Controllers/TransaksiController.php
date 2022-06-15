<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Obat;
use Carbon\Carbon;
use DB;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $obats = Obat::all();
        $transaksi_list = Transaksi::join('obats', 'transaksis.kode_inv', '=' ,'obats.kode_inv')->paginate(5)->withQueryString();
        return view('pages.transaksi', compact('transaksi_list','obats'));
    }

    public function hapus(Request $request)
    {
        try {
            $trs = Transaksi::find($request->id_transaksi);
            
            $trs->delete();

            return redirect()->to('/transaksi')->with('message', json_encode(['pesan' => 'Data Berhasil dihapus']));;
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->to('/transaksi')->with('error', 'Data gagal dihapus');;
        }
    }

    
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $obat = DB::table('obats')->where('kode_inv', $request->kode_inv)->first();
            
            $today = date("Y-m-d H:i:s");
            if($request->tipe == 'pemasukan'){
                $hasil = (int)$obat->stok + (int)$request->jumlah;
            }else{
                $hasil = (int)$obat->stok - (int)$request->jumlah;

                if ($obat->tgl_expired < $today){
                    return redirect()->to('/transaksi')->with('error', 'Obat sudah kadaluarsa');;
                }

                if($hasil <= 0){
                    return redirect()->to('/transaksi')->with('error', 'Stok Tidak Cukup');;
                }
            }

            
            DB::table('obats')->where('kode_inv', $request->kode_inv)->update([
                'stok' => $hasil
            ]);

            DB::table('transaksis')->insert([
                'kode_inv' => $request->kode_inv,
                'tipe' => $request->tipe,
                'jumlah' => $request->jumlah,
                'tgl_transaksi' => Carbon::now(),
            ]);

            DB::commit();

            return redirect()->to('/transaksi')->with('message', json_encode(['pesan' => 'Data Berhasil Ditambah']));;
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->to('/transaksi')->with('error', 'Data gagal ditambah');;
        }
    }
}
