<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase_detail extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function purchase()
    {
        return $this->belongsTo('App\Models\Purchase');
    }

    public function ppbje_detail()
    {
        return $this->belongsTo('App\Models\Ppbje_detail');
    }
}
