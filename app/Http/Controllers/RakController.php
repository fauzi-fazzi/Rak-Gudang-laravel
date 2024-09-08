<?php

namespace App\Http\Controllers;

use App\Models\Rak;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RakController extends Controller
{
    public function index()
    {
        $dataRak = Rak::withCount('barang')->get();
        // dd($dataRak);
        return view('rak', compact('dataRak'));
    }

    public function show($id)
    {
        $rak = Rak::find($id);
        $dataBarang = $rak->barang()->latest()->filter(request(['search']))->paginate(10)->withQueryString();
        return view('barang', compact('dataBarang', 'rak'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $dataBarang = Barang::where('nama', 'like', '%' . $search . '%')
            ->orWhere('kode', 'like', '%' . $search . '%')
            ->orWhere('stok', 'like', '%' . $search . '%')
            ->orWhere('ket', 'like', '%' . $search . '%')
            ->orWhere('gramasi', 'like', '%' . $search . '%')
            ->orWhereHas('vendor', function ($query) use ($search) {
                $query->where('nama', 'like', '%' . $search . '%');
            })
            ->orWhereHas('kategori', function ($query) use ($search) {
                $query->where('nama', 'like', '%' . $search . '%');
            })
            ->orWhereHas('satuan', function ($query) use ($search) {
                $query->where('nama', 'like', '%' . $search . '%');
            })
            ->orWhereHas('rak', function ($query) use ($search) {
                $query->where('nama', 'like', '%' . $search . '%');
            })
            ->paginate(5);

        return view('crud.search', compact('dataBarang', 'search'));
    }
}
