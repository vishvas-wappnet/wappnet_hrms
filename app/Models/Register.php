<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
    use HasFactory;



protected $fillable = [
    'name',
    'email',
    'username',
    'password',
    'c_password'
  ];



public function setPasswordAttribute($value)
{
   $this->attributes['password'] = bcrypt($value);
}
}


