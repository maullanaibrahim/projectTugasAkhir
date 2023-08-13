<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function purchase_detail()
    {
        return $this->hasOne('App\Models\Purchase_detail');
    }

    public function purchase_approval()
    {
        return $this->hasOne('App\Models\Purchase_approval');
    }

    public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier');
    }
    
    public function ppbje()
    {
        return $this->belongsTo('App\Models\Ppbje');
    }
    
    public function cost()
    {
        return $this->belongsTo('App\Models\Cost');
    }
    
    public function receiving_purchase()
    {
        return $this->hasOne('App\Models\Receiving_purchase');
    }
}
