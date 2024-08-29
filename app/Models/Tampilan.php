<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tampilan extends Model
{
    use HasFactory;
    protected $table = 'data_latih';
    protected $fillable = ['nama', 'umur', 'hobi', 'gender', 'lagu'];

}
