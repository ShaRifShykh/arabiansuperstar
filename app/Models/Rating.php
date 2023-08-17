<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        "to", "by", "rating"
    ];

    public function ratingBY()
    {
        return $this->belongsTo(User::class, "by", "id");
    }
}
