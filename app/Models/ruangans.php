<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ruangans extends Model
{
    use HasFactory;

    protected $table = 'ruangans';

    protected $fillable = [
        'jurusan_id',
        'kode_ruangan',
        'nama_ruangan',
        'deskripsi_ruangan',
    ];

    public function jurusan()
    {
        return $this->belongsTo(jurusans::class);
    }

    public $timestamps = false;
}
