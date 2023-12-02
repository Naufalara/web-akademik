<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class skripsi extends Model
{
    use HasFactory;
    protected $table = 'skripsi';
    protected $primaryKey = 'no';
    protected $fillable = [
        'nim',
        'status_skripsi',
        'tgl_sidang',
        'scan_berita',
        'nilai',
        'status',
    ];
    protected $guarded = [];
}
