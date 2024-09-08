<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MasterController extends Controller
{
    public function rak()
    {
        $rak = DB::table('rak')->get();

        return view('master.data_rak.index', compact('rak'));
    }

    public function rak_store(Request $request)
    {
        DB::table('rak')->insert([
            'nama' => $request->nama
        ]);
        return redirect('/master/rak')->with('success', 'Data inserted successfully.');
    }

    public function rak_destroy($id)
    {
        DB::table('rak')->where('id', $id)->delete();
        return redirect('/master/rak')->with('success', 'Data deleted successfully.');
    }

    public function kategori()
    {
        $kategori = DB::table('kategori')->get();

        return view('master.data_kategori.index', compact('kategori'));
    }

    public function kategori_store(Request $request)
    {
        DB::table('kategori')->insert([
            'nama' => $request->nama,
        ]);
        return redirect('/master/kategori')->with('success', 'Data inserted successfully.');
    }

    public function kategori_destroy($id)
    {
        DB::table('kategori')->where('id', $id)->delete();
        return redirect('/master/kategori')->with('success', 'Data deleted successfully.');
    }

    public function satuan()
    {
        $satuan = DB::table('satuan')->get();

        return view('master.data_satuan.index', compact('satuan'));
    }

    public function satuan_store(Request $request)
    {
        DB::table('satuan')->insert([
            'nama' => $request->nama,
            'ket' => $request->ket
        ]);
        return redirect('/master/satuan')->with('success', 'Data inserted successfully.');
    }

    public function satuan_destroy($id)
    {
        DB::table('satuan')->where('id', $id)->delete();
        return redirect('/master/satuan')->with('success', 'Data deleted successfully.');
    }

    public function vendor()
    {
        $vendor = DB::table('vendor')->get();

        return view('master.data_vendor.index', compact('vendor'));
    }

    public function vendor_store(Request $request)
    {
        DB::table('vendor')->insert([
            'nama' => $request->nama,
            'ket' => $request->ket
        ]);
        return redirect('/master/vendor')->with('success', 'Data inserted successfully.');
    }

    public function vendor_destroy($id)
    {
        DB::table('vendor')->where('id', $id)->delete();
        return redirect('/master/vendor')->with('success', 'Data deleted successfully.');
    }
}
