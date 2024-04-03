<?php

namespace NumaxLab\CinemaCatalog\Models;


use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasTranslations;
    use Sluggable;
    use HasFactory;
    use CrudTrait;

    public const STATUS_DEVELOPMENT = 'development';
    public const STATUS_PRODUCTION = 'production';
    public const STATUS_POSTPRODUCTION = 'postprodution';
    public const STATUS_DISTRIBUTION = 'distribution';
    public const TYPE_FEATURE_FILM = 'feature-film';
    public const TYPE_SHORT_FILM = 'short-film';
    public const TYPE_OTHER = 'other';


    protected $fillable = [
        'title',
        'slug',
        'original_title',
        'synopsis',
        'poster_file_path',
        'main_image_file_path',
        'gallery_files_paths',
        'awards',
        'festivals',
        'status',
        'tech_info',
        'artistic_info',
        'sponsors',
        'attachments',
        'reviews',
        'year',
        'length',
        'is_public',
        'project_collection_id',
        'type',
        'trailer'
    ];

    protected $translatable = [
        'title',
        'slug',
        'synopsis',
        'awards',
        'festivals',
        'artistic_info',
        'tech_info',
        'reviews'

    ];


    protected $casts = [
        'awards' => 'array',
        'festivals' => 'array',
        'tech_info' => 'array',
        'artistic_info' => 'array',
        'gallery_files_paths' => 'array',
    ];


    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['title']
            ]
        ];
    }


    public function project_collection(): BelongsTo
    {
        return $this->belongsTo(ProjectCollection::class);
    }

    public function film_makers(): BelongsToMany
    {
        return $this->BelongsToMany(FilmMaker::class);
    }

    public function sessions(): HasMany
    {
        return $this->hasMany(Session::class);
    }

}
