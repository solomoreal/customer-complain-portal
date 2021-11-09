<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Model
{
    use HasFactory, HasApiTokens;
    public function branch(){
        return $this->belongsTo(Branch::class);
    }

    public function complains(){
        return $this->HasMany(Complain::class,'customer_id');
    }
}
