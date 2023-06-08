<?php

namespace App\Traits\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait UuidPrimaryKey
{
    /**
     * Get the name of the UUID primary key column.
     *
     * @return string
     */
    public static function uuidPrimaryKeyName()
    {
        return 'id';
    }

    /**
     * Bootstrap the UUID primary key trait for the model.
     *
     * @return void
     */
    protected static function bootUuidPrimaryKey()
    {
        $key = self::uuidPrimaryKeyName();
        self::creating(function (Model $model) use ($key) {
            $model->$key = Str::uuid();
        });
    }
}
