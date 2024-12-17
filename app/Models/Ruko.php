<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruko extends Model
{
    use HasFactory;

    protected $table = 'rukos';
 
    protected $primaryKey = 'id_ruko';

    protected $fillable = [
        'jenis_ruko',
        'luas_ruko',
        'no_ruko',
        'harga',
        'status',
    ];

}
