<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailHobi extends Model
{
    use HasFactory;

    protected $table = 'detail_hobi';

    protected $fillable = [
        'id_hobi',
        'id_inputer',
    ];
}
