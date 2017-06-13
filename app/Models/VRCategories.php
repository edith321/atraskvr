<?php

namespace App\Models;



class VrCategories extends CoreModel
{

    /**
     * Database table name
     * @var string
     */
    protected $table = 'vr_categories';
    /**
     * Fillable column names
     * @var array
     */
    protected $fillable = ['id'];

    protected $with = ['translation'];

    public function translation() {
        $language = app()->getLocale();
        return $this->hasOne(VrCategoriesTranslations::class, 'record_id', 'id')->where('language_code', $language);
    }

}
