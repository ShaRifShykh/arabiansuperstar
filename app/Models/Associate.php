<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Associate extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'bg_image', 'heading', 'description'
    ];
}
