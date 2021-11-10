<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class Manager extends Model
{
    use HasFactory, HasApiTokens, Notifiable, SoftDeletes;

    protected $guarded = ['id'];

    public function branch(){
        return $this->belongsTo(Branch::class);
    }

    public function fullName(){
        return $this->first_name.' '.$this->last_name;
    }
}
