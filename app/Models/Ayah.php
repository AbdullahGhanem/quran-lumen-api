<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Ayah extends Model
{
	use Searchable;

    protected $fillable = [
        'number', 
        'text',
        'number_in_surah', 
    	'juz_id',
        'surah_id',
        'hizb_id',
        'page',
        'sajda'
    ];

    /**
     * get surah.
     */
    public function surah()
    {
        return $this->belongsTo(Surah::class);
    }

    
    /**
     * get juz.
     */
    public function juz()
    {
        return $this->belongsTo(Juz::class);
    }

    
    /**
     * get hizb.
     */
    public function hizb()
    {
        return $this->belongsTo(Hizb::class);
    }

    /**
     * Scope a query search.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeBySearch($query, $keyword)
    {
        return $query->when($keyword, function ($collection) use($keyword){
            $ids = self::search($keyword)->get()->pluck('id')->toArray();
            $collection->whereIn('id', $ids);
        });
    }
}
