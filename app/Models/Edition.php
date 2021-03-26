<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use TeamTNT\TNTSearch\Indexer\TNTIndexer;

class Edition extends Model implements HasMedia
{
	use HasMediaTrait, Searchable;

    protected $fillable = ['identifier', 'language', 'name', 'name_en', 'format', 'type'];

    
    public $asYouType = true;

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = [
            'id' => $this->id,
            'name' => $this->name,
            'englishName' => $this->englishName,
            'name_trigrams' => utf8_encode((new TNTIndexer)->buildTrigrams($this->name)),
        ];

        return $array;
    }
    
    /**
     * The ayahs that belong to the edition.
     */
    public function ayahs()
    {
        return $this->belongsToMany(Ayah::class)->withPivot('data', 'is_audio');;
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
