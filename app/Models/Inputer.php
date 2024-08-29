<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inputer extends Model
{
    use HasFactory;

    protected $table = 'inputer';

    protected $fillable = [
        'id_inputer',
        'umur',
        'gender',
        'created_at',
        'updated_at',
    ];
}
