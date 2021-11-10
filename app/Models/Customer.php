<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Model
{
    use HasFactory, HasApiTokens, Notifiable;
    public function branch(){
        return $this->belongsTo(Branch::class);
    }

    public function complains(){
        return $this->HasMany(Complain::class,'customer_id');
    }

    public function fullName(){
        return $this->first_name.' '.$this->last_name;
    }
}
