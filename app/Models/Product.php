<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image_path',
        'umkms_id',
        'hidden' // Allow Laravel to handle this column
    ];

    public function seller()
    {
        return $this->belongsTo(User::class, 'umkms_id');
    }
}
