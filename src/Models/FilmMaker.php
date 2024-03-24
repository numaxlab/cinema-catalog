<?php

namespace NumaxLab\CinemaCatalog\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FilmMaker extends Model
{

    use Sluggable;
    use HasFactory;
    use CrudTrait;
    use HasTranslations;


    protected $fillable = [
        'name',
        'slug',
        'description',
        'image_file_path',
        'image_caption',
        'is_public'

    ];


    protected $translatable = [
        'description',
        'image_caption',

    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['name']
            ]
        ];
    }


    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

}
