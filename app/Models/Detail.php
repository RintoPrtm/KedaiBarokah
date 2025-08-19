<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    protected $table = 'detail';
    protected $fillable = ['id_pesanan', 'id_menu', 'jumlah', 'status'];
    protected $primaryKey = 'id_detail';
    public $timestamps = false;

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'id_menu', 'id_menu');
    }

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'id_pesanan', 'id_pesanan');
    }
}
