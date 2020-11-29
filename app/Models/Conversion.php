<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Conversion extends Model
{
    use HasFactory;

    private $rules = array(
        'integer' => 'required|numeric|min:1|max:3999'
    );

    private $errors;

    public function validate($data)
    {
        $v = Validator::make($data, $this->rules);

        if ($v->fails())
        {
            $this->errors = $v->errors();
            return false;
        }

        return true;
    }

    public function errors()
    {
        return $this->errors;
    }

    public function scopeRecentlyConvertedIntegers($query)
    {
        $date = \Carbon\Carbon::today()->subDays(7);
        return $query->where('updated_at', '>=', $date);
    }

    public function scopeTopTenConvertedIntegers($query)
    {
        return $query->orderBy('hits','DESC');
    }

    protected $fillable = ['*'];
}
