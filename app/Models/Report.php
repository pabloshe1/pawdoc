<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'user_id',
        'pet_id',
        'symptoms',
        'diagnosis',
        'medicine',
        'status'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function pet() {
        return $this->belongsTo(Pet::class);
    }
}
