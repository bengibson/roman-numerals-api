<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conversion extends Model
{
    protected $table = 'conversions';

    protected $fillable = ['integer', 'conversion'];

    public function scopeRecentlyConvertedIntegers($query)
    {
        $date = \Carbon\Carbon::today()->subDays(7);
        return $query->where('updated_at', '>=', $date)->orderBy('updated_at', 'desc');
    }

    public function scopeTopTenConvertedIntegers($query)
    {
        return $query->orderBy('hits','DESC')->orderBy('hits', 'desc')->limit(10);
    }
}
