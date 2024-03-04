<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'tbl_transaksi';

    protected $fillable = [
        'no_transaksi',
        'id_pelanggan',
        'tgl_pesan',
        'tgl_acara',
        'waktu_acara',
        'catatan',
        'total_harga',
        'tgl_bayar',
        'status',
        'bukti_dp',
        'bukti_lunas',
        'norek_pelanggan',
        'bank_pelanggan',
        'atasnama_pelanggan',
        'total_refund',
        'bukti_refund',
    ];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
