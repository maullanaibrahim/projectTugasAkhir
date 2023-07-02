<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];

    public function employee()
    {
        return $this->hasOne('App\Models\Employee');
    }
}
