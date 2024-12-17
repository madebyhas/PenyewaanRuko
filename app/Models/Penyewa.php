<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class Penyewa extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'penyewas';

    protected $primaryKey = 'id_penyewa';

    protected $fillable = [
        'id_penyewa',
        'nama_penyewa',
        'nama_usaha',
        'alamat',
        'jenis_kelamin',
        'telp',
        'username',
        'password',
        'level',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];
    
    public function rukos()
    {
        return $this->hasMany(Ruko::class); // Atur sesuai dengan relasi yang benar
    }
    public function sewaruko()
    {
        return $this->hasMany(Sewaruko::class);
    }

}
