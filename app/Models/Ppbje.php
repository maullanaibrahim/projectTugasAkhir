<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ppbje extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function ppbje_detail()
    {
        return $this->hasOne('App\Models\Ppbje_detail');
    }

    public function ppbje_approval()
    {
        return $this->hasOne('App\Models\Ppbje_approval');
    }

    public function purchase()
    {
        return $this->hasOne('App\Models\Purchase');
    }

    public function cost()
    {
        return $this->belongsTo('App\Models\Cost');
    }

    public function employee()
    {
        return $this->belongsTo('App\Models\Employee');
    }
}
