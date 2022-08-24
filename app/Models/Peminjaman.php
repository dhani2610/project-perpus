<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;
    protected $table = 'peminjaman';
    protected $fillable = [
        'kode_pinjam',
        'id_peminjam',
        'id_buku',
        'status',
        'denda',
        'tanggal_pinjam',
        'tanggal_kembali',
        'tanggal_pengembalian',
        'approval_peminjaman',
        'pesan',
        'jumlah_pinjaman',
    ];

    function user()
    {
        return $this->belongsTo(User::class);

    }
}
