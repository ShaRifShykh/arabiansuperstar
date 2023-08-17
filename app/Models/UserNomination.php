<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserNomination extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id", "nominations_id"
    ];

    public function nomination() {
        return $this->belongsTo(Nomination::class, "nominations_id", "id");
    }
}
