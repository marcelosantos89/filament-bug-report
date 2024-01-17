<?php

namespace App\Models;

use RalphJSmit\Laravel\SEO\Models\SEO as RalphJSmitSeo;
use Spatie\Translatable\HasTranslations;

class SEO extends RalphJSmitSeo
{
    use HasTranslations;

    public $translatable = ['title', 'description', 'canonical_url'];

}