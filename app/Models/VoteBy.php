<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoteBy extends Model
{
    use HasFactory;

    protected $fillable = [
        "to", "by"
    ];

    public function voteBY()
    {
        return $this->belongsTo(User::class, "by", "id");
    }
}
