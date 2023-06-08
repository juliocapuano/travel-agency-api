<?php

namespace App\Traits\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait GenerateSlug
{
    /**
     * Get the name of the slug column.
     */
    public static function slugFieldName(): string
    {
        return 'slug';
    }

    /**
     * Get the name of the title column.
     */
    public static function titleFieldName(): string
    {
        return 'name';
    }

    /**
     * Bootstrap the UUID primary key trait for the model.
     *
     * @return void
     */
    protected static function bootGenerateSlug()
    {
        $slug_field  = self::slugFieldName();
        $title_field = self::titleFieldName();

        self::creating(function (Model $model) use ($slug_field, $title_field) {
            self::populateSlug($model, $title_field, $slug_field);
        });

        self::updating(function (Model $model) use ($slug_field, $title_field) {
            self::populateSlug($model, $title_field, $slug_field);
        });
    }

    private static function populateSlug(Model $model, string $title_field, string $slug_field): void
    {
        $is_dirty = $model->isDirty($title_field);
        if ($is_dirty) {
            $title              = sprintf('%s %s', $model->$title_field, time());
            $model->$slug_field = Str::slug($title);
        }
    }
}
