<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sewaruko extends Model
{
    use HasFactory;

    protected $table = 'sewarukos'; // Specify the table name if it differs from the model name

    protected $primaryKey = 'id_sewaruko'; // Specify the primary key

    protected $fillable = [
        'ruko_id',
        'penyewa_id',
        'durasi',
        'tgl_sewa',
    ];

    // Define relationships
    public function ruko()
    {
        return $this->belongsTo(Ruko::class, 'ruko_id');
    }

    public function penyewa()
    {
        return $this->belongsTo(Penyewa::class, 'penyewa_id');
    }

    public function getDurasiAttribute($durasi)
    {
        return $durasi * 100;
    }

    public function getHarga()
    {
        return $this->ruko->harga; // Asumsikan harga adalah kolom di model Ruko
    }

}
