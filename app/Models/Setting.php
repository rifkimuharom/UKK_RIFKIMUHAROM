<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'nama_toko',
        'telepon',
        'alamat',
        'logo',
        'ukuran_kertas',
        'auto_print',
        'footer_struk',
        'ppn',
    ];
}