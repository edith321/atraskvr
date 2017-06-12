<?php

use App\Models\VrLanguageCodes;

function getActiveLanguages() {
    $config['languages'] = VrLanguageCodes::where('is_active', '1')->pluck('id', 'name');
    return $config;
}