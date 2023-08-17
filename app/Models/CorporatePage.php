<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CorporatePage extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'key', 'banner', 'heading', 'sub_heading', 'content'
    ];
}
