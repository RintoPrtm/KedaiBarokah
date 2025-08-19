<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Warung extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_warung',
        'alamat_warung',
        'deskripsi_warung',
        'foto_warung',
        'flayer',
    ];

    protected $table = 'warung';
    protected $primaryKey = 'id_warung';
    public $timestamps = false;

}
