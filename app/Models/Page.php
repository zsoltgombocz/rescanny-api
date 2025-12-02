<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Page extends Model
{
    use HasTranslations;

    protected $fillable = [
        'title',
        'subtitle',
        'slug',
        'content',
    ];

    /**
     * @var string[]
     */
    public array $translatable = [
        'title',
        'subtitle',
        'slug',
        'content',
    ];

    public static function findOrFailBySlug(string $slug): Page
    {
        $locale = app()->getLocale();

        return Page::where("slug->$locale", $slug)->firstOrFail();
    }
}
