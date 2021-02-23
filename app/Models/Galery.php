<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galery extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'image_url'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
