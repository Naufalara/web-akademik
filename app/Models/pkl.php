<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pkl extends Model
{
    use HasFactory;
    protected $table = 'pkl';
    protected $primaryKey = 'no';
    protected $fillable = [
        'nim',
        'status_pkl',
        'tahun',
        'scan_berita',
        'nilai',
        'status',
    ];
    protected $guarded = [];
}
