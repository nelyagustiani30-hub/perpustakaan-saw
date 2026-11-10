<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = ['nim', 'nama', 'email', 'no_hp'];

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
}
