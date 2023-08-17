<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCreditCard extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id", "card_number", "cardholder_name", "month", "year", "cvv_number"
    ];
}
