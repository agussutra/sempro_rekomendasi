<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    use HasFactory;

    protected $table = 'track';

    protected $fillable = [
        'artist',
        'judul',
        'id_inputer',
        'energy',
        'valence',
        'created_at',
        'updated_at',
    ];
}
