<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complain extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function branch(){
        return $this->belongsTo(Branch::class);
    }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }
}
