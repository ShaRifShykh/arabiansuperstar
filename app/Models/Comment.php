<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        "to", "by", "comment", "block"
    ];

    public function commentBY()
    {
        return $this->belongsTo(User::class, "by", "id");
    }

    public function commentTO()
    {
        return $this->belongsTo(User::class, "to", "id");
    }
}
