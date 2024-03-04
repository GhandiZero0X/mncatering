<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aplikasi extends Model
{
    use HasFactory;

    protected $table = 'tbl_aplikasi';

    protected $fillable = [
        'nama_apps',
        'nohp_apps',
        'email_apps',
        'alamat_apps',
        'logo',
        'banner',
        'atas_nama',
        'bank',
        'no_rek'
    ];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
