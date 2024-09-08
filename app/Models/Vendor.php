<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $table = 'vendor';

    public function barang()
    {
        return $this->hasMany(Barang::class);
    }
}
