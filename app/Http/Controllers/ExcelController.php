<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\BarangExport;
use App\Imports\BarangImport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    public function import(Request $request)
    {
        Excel::import(new BarangImport, $request->file('file'));
        // dd($request->file('file'));
        return redirect('rak')->with('success', 'Barang imported successfully!');
    }

    public function export()
    {
        return Excel::download(new BarangExport, 'barang-' . date('d-m-Y') . '.xlsx');
    }

    public function reset()
    {
        // Pastikan hanya admin atau pengguna yang berwenang yang bisa mengakses ini
        // $this->authorize('admin'); // Atau sesuaikan dengan kebutuhan Anda

        // Jalankan truncate pada tabel barang
        DB::table('barang')->truncate();

        // Redirect dengan pesan sukses
        return redirect('rak')->with('success', 'Tabel barang berhasil direset.');
    }
}
