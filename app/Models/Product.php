<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // ------- *insert a field in db using api -------
    //this following code is to like a permission for u to fill the db using api:
    protected $fillable = [
        'name',
        'slug',
        'description',
        'price'
    ];
}
