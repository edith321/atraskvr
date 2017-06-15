<?php

use App\Models\VrLanguageCodes;

function getActiveLanguages() {
    $locale = app()->getLocale();
    $languages = VrLanguageCodes::where('is_active', '1')->pluck('name', 'id')->toArray();

    if(!isset($languages[$locale])) {

        $locale = config('app.fallback_locale'); // fallback locales issitraukimas, taip galima issitraukti betkoki parametra is config direktorijos

        if(!isset($languages[$locale])) {

            return $languages;
        }
    }

    $languages = [$locale => $languages[$locale]] + $languages;

    return $languages;
}