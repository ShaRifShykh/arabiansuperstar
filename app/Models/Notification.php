<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id", "comment_id", "like_id", "rating_id", "vote_by_id", "message", "has_read"
    ];

    public function user()
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }

    public function comment()
    {
        return $this->belongsTo(Comment::class, "comment_id", "id")->with("commentBY");
    }

    public function like()
    {
        return $this->belongsTo(Like::class, "like_id", "id")->with("likeBY");
    }

    public function rating()
    {
        return $this->belongsTo(Rating::class, "rating_id", "id")->with("ratingBY");
    }

    public function voteBy()
    {
        return $this->belongsTo(VoteBy::class, "vote_by_id", "id")->with("voteBY");
    }
}
