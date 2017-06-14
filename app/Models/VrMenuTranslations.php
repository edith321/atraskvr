<?php

namespace App\Models;



class VrMenuTranslations extends CoreModel
{

    /**
     * Database table name
     * @var string
     */
    protected $table = 'vr_menu_translations';
    /**
     * Fillable column names
     * @var array
     */
    protected $fillable = ['id', 'name', 'url', 'record_id', 'language_code'];

    public function translation() {
        $language = app()->getLocale();
        return $this->hasOne(VrMenuTranslations::class, 'record_id', 'id')->where('language_code', $language);
    }
}
