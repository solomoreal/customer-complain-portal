<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Customer extends Model implements HasMedia
{
    use HasFactory, HasApiTokens, Notifiable, SoftDeletes, InteractsWithMedia;
    protected $guarded = ['id'];
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
              ->width(100)
              ->height(100)
              ->sharpen(10)
              ->performOnCollections('photo');
    }

    public function branch(){
        return $this->belongsTo(Branch::class);
    }

    public function complains(){
        return $this->HasMany(Complain::class,'customer_id');
    }

    public function fullName(){
        return $this->first_name.' '.$this->last_name;
    }

    public function fullAddress(){
        return $this->address.' '.$this->city.' '.$this->state;
    }
}
