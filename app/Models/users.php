<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class users extends Model
{
    use HasFactory;

    protected $table = 'users';

    protected $fillable = [	
        'username',	
        'password',	
        'nama_user',	
        'no_hp',	
        'ttd',	
        'role',	
        'create_at',	
        'update_at',		
    ];
}
