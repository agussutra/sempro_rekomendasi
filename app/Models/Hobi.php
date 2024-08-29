<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hobi extends Model
{
    use HasFactory;

    protected $table = 'hobies';

    protected $fillable = [
        'nama',
        'created_at',
        'updated_at',
    ];
}
