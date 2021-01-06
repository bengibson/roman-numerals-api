<?php

namespace App\Repositories;

use App\Models\Conversion;

interface ConversionInterface
{
    public function updateOrCreate($integer);

    public function recentlyConvertedIntegers($query);

    public function topTenConvertedIntegers($query);
}
