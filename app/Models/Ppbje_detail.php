<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ppbje_detail extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function ppbje()
    {
        return $this->belongsTo('App\Models\Ppbje');
    }
        
    public function purchase_detail()
    {
        return $this->hasOne('App\Models\Purchase_detail');
    }
        
    public function item()
    {
        return $this->belongsTo('App\Models\Item');
    }

    public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier');
    }
}
