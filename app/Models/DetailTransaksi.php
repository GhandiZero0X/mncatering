<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;

    protected $table = 'tbl_detail_transaksi';

    protected $fillable = [
        'id_snack',
        'no_transaksi',
        'qty',
    ];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
