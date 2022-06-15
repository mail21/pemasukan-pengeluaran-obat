<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obat;

class ObatController extends Controller
{
    
    public function index(Request $request)
    {
        $obats = Obat::paginate(5)->withQueryString();;
        return view('pages.obat', compact('obats'));
    }

    public function edit(Request $request)
    {
        try {
            $obat = Obat::find($request->kode_inv);
            
            $obat->kode_inv = $request->kode_inv;
            $obat->nama = $request->nama;
            $obat->tgl_expired = $request->tgl_expired;
            $obat->stok = $request->stok;
            $obat->harga = $request->harga;
            $obat->save();

            return redirect()->to('/obat')->with('message', json_encode(['pesan' => 'Data Berhasil diedit']));;
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->to('/obat')->with('error', 'Data gagal diedit');;
        }
    }

    public function hapus(Request $request)
    {
        try {
            $obat = Obat::find($request->kode_inv);
            
            $obat->delete();

            return redirect()->to('/obat')->with('message', json_encode(['pesan' => 'Data Berhasil dihapus']));;
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->to('/obat')->with('error', 'Data gagal dihapus');;
        }
    }

    
    public function store(Request $request)
    {
        try {
            $obat = new Obat();
            
            $obat->kode_inv = $request->kode_inv;
            $obat->nama = $request->nama;
            $obat->tgl_expired = $request->tgl_expired;
            $obat->stok = $request->stok;
            $obat->harga = $request->harga;
            $obat->save();

            return redirect()->to('/obat')->with('message', json_encode(['pesan' => 'Data Berhasil Ditambah']));;
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->to('/obat')->with('error', 'Data gagal ditambah');;
        }
    }
}
