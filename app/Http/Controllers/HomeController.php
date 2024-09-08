<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $sumRak = DB::table('rak')->count();
        $sumVendor = DB::table('vendor')->count();
        $sumKategori = DB::table('kategori')->count();
        $sumSatuan = DB::table('satuan')->count();

        return view('dashboard', compact('sumRak', 'sumVendor', 'sumKategori', 'sumSatuan'));
    }
}
