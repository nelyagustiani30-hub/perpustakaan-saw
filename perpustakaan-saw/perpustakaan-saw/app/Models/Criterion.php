<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Criterion extends Model
{
    protected $table = 'criteria';

    protected $fillable = ['kode', 'nama', 'field', 'tipe', 'bobot'];
}