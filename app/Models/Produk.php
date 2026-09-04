<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';

    protected $fillable = [
        'user_id',
        'category',
        'foto',
        'nama',
        'harga_beli',
        'harga_jual',
        'stok',
        'satuan',
        'minimum_stok',
        'deskripsi',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relasi User
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Relasi Category
    |--------------------------------------------------------------------------
    */

    public function category()
    {
        // Menyebutkan 'category' sebagai foreign key karena nama kolomnya bukan 'category_id'
        return $this->belongsTo(Category::class, 'category');
    }

    /*
    |--------------------------------------------------------------------------
    | Accessor Profit
    |--------------------------------------------------------------------------
    */

    public function getProfitAttribute()
    {
        return $this->harga_jual - $this->harga_beli;
    }
}