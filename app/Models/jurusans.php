<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jurusans extends Model
{
    use HasFactory;

    protected $table = 'Jurusans';

    protected $fillable = [	
        'kode_jurusan',	
        'nama_jurusan',	
        'deskripsi_jurusan'		
    ];

    public $timestamps = false;
}

