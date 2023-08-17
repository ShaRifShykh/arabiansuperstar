<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = [
        "to", "by"
    ];

    public function likeBY() {
        return $this->belongsTo(User::class, "by", "id");
    }
}
