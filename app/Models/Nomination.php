<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nomination extends Model
{
    use HasFactory;

    protected $fillable = [
        "name", "gender", "block"
    ];

    public function userNominations() {
        return $this->hasMany(UserNomination::class, "nomination_id", "id");
    }
}
