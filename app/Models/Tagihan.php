<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    use HasFactory;

    protected $table = 'tagihans';

    protected $primaryKey = 'id_tagihan';

    protected $fillable = [
        'sewaruko_id',
        'total',
        'tgl_awal_tagihan',
        'tgl_akhir_tagihan',
        'bukti',
        'metode',
        'status',
    ];

    // Relasi dengan model Sewaruko
    public function sewaruko()
    {
        return $this->belongsTo(Sewaruko::class, 'sewaruko_id', 'id_sewaruko');
    }
}
