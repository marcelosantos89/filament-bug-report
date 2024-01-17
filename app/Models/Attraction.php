<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use Spatie\Translatable\HasTranslations;

class Attraction extends Model
{
    use HasFactory, HasTranslations, HasSEO;

    public $translatable = ['slug', 'name', 'description', 'highlight_text', 'content', 'chat_text'];

    protected $guarded = ['id'];

    protected $casts = [
        'recommended' => 'array',
    ];
}
