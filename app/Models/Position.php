<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];

    public function user()
    {
        return $this->hasOne('App\Models\User');
    }

    public function employee()
    {
        return $this->hasOne('App\Models\Employee');
    }
}
