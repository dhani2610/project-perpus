<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $fillable = [
        'isbn',
        'kategori',
        'rak',
        'judul',
        'penerbit',
        'tahunbuku',
        'stokbuku',
        'sampul',
    ];

    public function totalBuku()
    {
        // dd($this->id);
        $data = Peminjaman::where('id_buku',$this->b_id)->where('tanggal_pengembalian',null)->where('approval_peminjaman','Approve')->get();
        $total =  $data->sum('jumlah_pinjaman');
        return $total;
        
    }
}
