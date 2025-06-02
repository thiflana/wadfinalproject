<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Umkm extends Model
{
    protected $fillable = [
    'name',
    'user_id', // Add this to allow mass assignment
];
}
