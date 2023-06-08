<?php

namespace App\Models;

use App\Traits\Models\GenerateSlug;
use App\Traits\Models\UuidPrimaryKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Travel extends Model
{
    use HasFactory;
    use UuidPrimaryKey;
    use GenerateSlug;

    public $incrementing = false;
    protected $fillable  = [
        'is_public',
        'name',
        'description',
        'number_of_days',
    ];

    protected $casts = [
        'is_public'      => 'boolean',
        'number_of_days' => 'integer',
    ];

    protected $appends = ['number_of_nights'];

    public function tours(): HasMany
    {
        return $this->hasMany(Tour::class);
    }

    public function getNumberOfNightsAttribute()
    {
        return $this->number_of_days - 1;
    }
}
