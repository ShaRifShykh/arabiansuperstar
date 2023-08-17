<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        "vote_plan_id", "user_id", "order_id", "payment_status", "total_amount"
    ];

    public function votePlan()
    {
        return $this->belongsTo(VotePlan::class, "vote_plan_id", "id");
    }

    public function user()
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }
}
