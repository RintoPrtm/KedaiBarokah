<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';
    protected $primaryKey = 'id_menu';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;
    protected $fillable = [
        'nama_menu',
        'harga',
        'promo',
        'deskripsi_menu',
        'foto_menu',
        'id_kategori',
        'stok'
    ];
    protected $casts = [
        'harga' => 'float',
        'promo' => 'float',
    ];

    public function getEffectivePriceAttribute()
    {
        return ($this->promo !== null && $this->promo > 0)
            ? $this->promo
            : $this->harga;
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    public function detail()
    {
        return $this->hasMany(Detail::class, 'id_menu', 'id_menu');
    }
}   
