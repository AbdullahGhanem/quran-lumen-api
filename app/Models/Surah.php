<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Surah extends Model
{
   	protected $fillable = ['number', 'name_ar', 'name_en', 'name_en_translation', 'type'];


    /**
     * get ayahs.
     */
    public function ayahs()
    {
        return $this->hasMany(Ayah::class);
    }
}
