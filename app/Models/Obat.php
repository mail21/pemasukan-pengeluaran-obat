<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $primaryKey = 'kode_inv';
    protected $fillable = [
        'kode_inv',
        'nama',
        'stok',
        'harga',
        'tgl_expired',
    ];
}
