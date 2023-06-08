<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class DecimalIntCast implements CastsAttributes
{
    private int $base = 100;

    public function get(Model $model, string $key, mixed $value, array $attributes): float
    {
        return round($value / $this->base, 2);
    }

    public function set(Model $model, string $key, mixed $value, array $attributes): int
    {
        return (int)round($value * $this->base);
    }
}
