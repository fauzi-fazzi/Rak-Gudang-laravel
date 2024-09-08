<?php

namespace App\Exports;

use App\Models\Barang;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BarangExport implements FromQuery, WithMapping, WithHeadings
{

    use Exportable;

    /**
     * @return \Illuminate\Support\Collection
     */
    public function query()
    {
        return Barang::query();
    }

    public function map($barang): array
    {
        static $no = 0;
        $no++;
        return [
            $no,
            $barang->kode,
            $barang->nama,
            $barang->stok,
            $barang->gramasi,
            $barang->vendor->nama,
            $barang->kategori->nama,
            $barang->satuan->nama,
            $barang->rak->nama,
            $barang->ket,
        ];
    }

    public function headings(): array
    {
        return [
            '#',
            'Kode',
            'Nama',
            'Stok',
            'Gramasi',
            'Vendor',
            'Kategori',
            'Satuan',
            'Rak',
            'Ket',
        ];
    }
}
