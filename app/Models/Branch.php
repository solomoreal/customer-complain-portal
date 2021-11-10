<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;


class Branch extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function customers(){
        return $this->hasMany(Customer::class);
    }

    public function manager(){
        return $this->hasOne(Manager::class);
    }

    public function complaints(){
        return $this->hasMany(Complain::class);
    }

    public function fullAddress(){
        return $this->address.' '.$this->city.' '.$this->state;
    }
}
