<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'type',
        'breed',
        'photo',
        'description',
    ];

    // Relasi balik ke User (Pemilik)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}