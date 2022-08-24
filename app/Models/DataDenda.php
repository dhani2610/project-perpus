<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataDenda extends Model
{
    use HasFactory;
    // public $timestamps = false;
    protected $table = 'data_denda';
    protected $fillable = [
        'nama_anggota',
        'jumlah_denda'
    ];
}
