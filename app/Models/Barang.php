<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $table = 'barang';

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('stok', 'like', '%' . $search . '%')
                    ->orWhere('ket', 'like', '%' . $search . '%')
                    ->orWhere('nama', 'like', '%' . $search . '%')
                    ->orWhere('kode', 'like', '%' . $search . '%')
                    ->orWhere('gramasi', 'like', '%' . $search . '%')
                    ->orWhere('vendor_id', 'like', '%' . $search . '%')
                    ->orWhereHas('vendor', function ($query) use ($search) {
                        $query->where('nama', 'like', '%' . $search . '%');
                    })
                    ->orWhere('kategori_id', 'like', '%' . $search . '%')
                    ->orWhereHas('kategori', function ($query) use ($search) {
                        $query->where('nama', 'like', '%' . $search . '%');
                    })
                    ->orWhere('satuan_id', 'like', '%' . $search . '%')
                    ->orWhereHas('satuan', function ($query) use ($search) {
                        $query->where('nama', 'like', '%' . $search . '%');
                    })
                    ->orWhere('rak_id', 'like', '%' . $search . '%')
                    ->orWhereHas('rak', function ($query) use ($search) {
                        $query->where('nama', 'like', '%' . $search . '%');
                    });
            });
        });
    }

    public function rak()
    {
        return $this->belongsTo(Rak::class);
    }
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
    public function satuan()
    {
        return $this->belongsTo(Satuan::class);
    }
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
