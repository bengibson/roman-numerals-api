<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conversion extends Model
{
    protected $table = 'conversions';

    protected $fillable = ['integer', 'conversion'];
}
