<?php

use App\Models\VrLanguageCodes;

function getActiveLanguages() {
    $config = VrLanguageCodes::where('is_active', '1')->pluck('name', 'id');
    return $config;
}