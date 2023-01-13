<?php

namespace App\Models;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Doctor extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'doctors';

    // protected $guarded = [];
    // public function setPasswordAttribute($value)
    // {
    //     $this->attributes['password'] = Hash::make($value);
    // }

    // public function scopeIsActive($query)
    // {
    //     return $query->where('is_active',1);
    // }
}
