<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pkl extends Model
{
    use HasFactory;
    protected $table = 'pkl';

    protected $fillable = [
        'nim',
        'status',
        'nama',
        'tahun',
        'lokasi',
        'nilai',
    ];
}
