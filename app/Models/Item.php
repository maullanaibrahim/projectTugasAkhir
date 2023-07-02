<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $guarded = ['id','preview'];

    public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier');
    }
}
