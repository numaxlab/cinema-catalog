<?php

namespace NumaxLab\CinemaCatalog\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\Sluggable;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProjectCollection extends Model
{
    use HasFactory;
    use HasTranslations;
    use Sluggable, SluggableScopeHelpers;
    use CrudTrait;


    protected $fillable = [
        'title',
        'slug',
        'description',
        'poster_file_path',
        'image_file_path',
        'is_public',
    ];

    protected $translatable = [
        'title',
        'slug',
        'description',

    ];


    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['title']
            ]
        ];
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }
}
