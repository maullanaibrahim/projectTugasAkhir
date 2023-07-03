<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ppbje_approval extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function ppbje()
    {
        return $this->belongsTo('App\Models\Ppbje');
    }
}
