<?php

namespace App\Imports;

use App\Models\Rak;
use App\Models\Barang;
use App\Models\Satuan;
use App\Models\Vendor;
use App\Models\Kategori;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BarangImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // Ambil atau buat data vendor, satuan, kategori, dan rak
            $vendor = Vendor::firstOrCreate(['nama' => $row['vendor']]);
            $satuan = Satuan::firstOrCreate(['nama' => $row['satuan']]);
            $kategori = Kategori::firstOrCreate(['nama' => $row['kategori']]);
            $rak = Rak::firstOrCreate(['nama' => $row['rak']]);

            // Proses gambar jika ada
            $imagePath = null;
            if (isset($row['image']) && $row['image']) {
                $imageName = time() . '_' . $row['image'];
                $imagePath = 'uploads/' . $imageName;

                // Simpan gambar ke storage
                Storage::disk('public')->put($imagePath, file_get_contents($row['image']));
            }

            // Simpan data barang ke database
            Barang::create([
                'nama' => $row['nama'],
                'kode' => $row['kode'],
                'vendor_id' => $vendor->id,
                'kategori_id' => $kategori->id,
                'gramasi' => $row['gramasi'],
                'stok' => $row['stok'],
                'satuan_id' => $satuan->id,
                'rak_id' => $rak->id,
                'ket' => $row['keterangan'],
                'image' => $imagePath,
            ]);
        }
    }
}
