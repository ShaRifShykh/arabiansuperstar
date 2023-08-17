<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParticipatingCountry extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        "name", "flag", "status"
    ];
}
