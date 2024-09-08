<?php

namespace App\Http\Controllers;

use App\Models\Rak;
use App\Models\Barang;
use App\Models\Satuan;
use App\Models\Vendor;
use Nette\Utils\Image;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($rak)
    {
        $rak = Rak::findOrFail($rak);
        $vendor = Vendor::all();
        $kategori = Kategori::all();
        $satuan = Satuan::all();
        return view('crud.create', compact('rak', 'vendor', 'kategori', 'satuan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'kode' => 'required',
            'kategori_id' => 'required|exists:kategori,id',
            'vendor_id' => 'required|exists:vendor,id',
            'stok' => 'nullable|numeric',
            'gramasi' => 'required',
            'satuan_id' => 'required|exists:satuan,id',
            'ket' => 'nullable',
            'image' => 'nullable|image|max:5120' // Adjust max size as needed
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $barang = new Barang;
        $barang->rak_id = $id;
        $barang->nama = $request->nama;
        $barang->kode = $request->kode;
        $barang->gramasi = $request->gramasi;
        $barang->kategori_id = $request->kategori_id;
        $barang->vendor_id = $request->vendor_id;
        $barang->stok = $request->stok;
        $barang->satuan_id = $request->satuan_id;
        $barang->ket = $request->ket;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(
                public_path('uploads'),
                $imageName
            );
            $barang->image = $imageName;
        }

        $barang->save();
        return redirect('rak/' . $id)->with('success', 'Data created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show(Barang $barang, $id)
    {
        // Get the item details
        $barang = Barang::find($id);
        // dd($item);
        // Return the detail view
        return view('crud.show', compact('barang'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit(Barang $barang, $rak, $barangId)
    {
        $rak = Rak::findOrFail($rak);
        $barang = Barang::findOrFail($barangId);
        $kategori = Kategori::all();
        $vendor = Vendor::all();
        $satuan = Satuan::all();

        // dd($rak, $barangId,  $barang);
        return view('crud.edit', compact('rak', 'barang', 'kategori', 'vendor', 'satuan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $rak, $barangId)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'kode' => 'required',
            'kategori_id' => 'required|exists:kategori,id',
            'vendor_id' => 'required|exists:vendor,id',
            'stok' => 'nullable|numeric',
            'gramasi' => 'required',
            'satuan_id' => 'required|exists:satuan,id',
            'ket' => 'nullable',
            'image' => 'nullable|image|max:5120' // Adjust max size as needed
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $barang = Barang::findOrFail($barangId);
        $barang->rak_id = $rak;
        $barang->nama = $request->nama;
        $barang->kode = $request->kode;
        $barang->gramasi = $request->gramasi;
        $barang->kategori_id = $request->kategori_id;
        $barang->vendor_id = $request->vendor_id;
        $barang->stok = $request->stok;
        $barang->satuan_id = $request->satuan_id;
        $barang->ket = $request->ket;
        if ($request->hasFile('image')) {
            if ($barang->image != '') {
                File::delete(public_path('uploads/' . $barang->image));
            }
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(
                public_path('uploads'),
                $imageName
            );
            $barang->image = $imageName;
        }

        $barang->save();
        // dd($barang);
        return redirect('rak/' . $rak)->with('success', 'Data updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Barang $rak, $barangId)
    {
        $barang = Barang::findOrFail($barangId);
        if ($barang->image != '') {
            File::delete(public_path('uploads/' . $barang->image));
        }
        $barang->delete();
        return redirect()->back()->with('success', 'Data deleted successfully.');
    }
}
