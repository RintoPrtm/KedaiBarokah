<?php

namespace App\Models;

use App\Models\User;
use App\Models\Detail;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'pesanan';
    protected $fillable = ['id_users', 'tanggal_pesanan', 'jam_pesanan', 'status'];
    protected $primaryKey = 'id_pesanan';
    public $timestamps = false;
    protected $dates = ['tanggal_pesanan', 'jam_pesanan'];



    public function detail()
    {
        return $this->hasMany(Detail::class, 'id_pesanan', 'id_pesanan');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'id_users', 'id_users');
    }

}
