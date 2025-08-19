<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens,HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id_users';
    public $timestamps = false;

    public function pesanan()
    {
        return $this->hasMany(Pesanan::class, 'id_users', 'id_users');
    }

    protected $fillable = [
        'username',
        'email',
        'password',
        'telp_user',
        'id_roles',
    ];

    protected $hidden = [
        'password'
    ];

}
