<?php

namespace NumaxLab\CinemaCatalog\Models;


use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\Sluggable;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasTranslations;
    use Sluggable, SluggableScopeHelpers;
    use HasFactory;
    use CrudTrait;

    public const STATUS_DEVELOPMENT = 'development';
    public const STATUS_PRODUCTION = 'production';
    public const STATUS_POSTPRODUCTION = 'postprodution';
    public const STATUS_OTHER = 'other';
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
        'trailer',
        'custom_type',
        'custom_status',
        'highlight',
        'cast'
    ];

    public $translatable = [
        'title',
        'slug',
        'synopsis',
        'awards',
        'festivals',
        'artistic_info',
        'tech_info',
        'reviews',
        'attachments',
        'sponsors',
        'custom_type',
        'custom_status'
    ];


    protected $casts = [
        'awards' => 'array',
        'festivals' => 'array',
        'tech_info' => 'array',
        'artistic_info' => 'array',
        'gallery_files_paths' => 'array',
        'sponsors' => 'array',
        'attachments' => 'array',
        'cast' => 'array',

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

    public function getTechInfoAsArrayAttribute()
    {
        if ($this->tech_info) {
            $tech_info = json_decode($this->tech_info, true);
            return $tech_info;
        }

        return [];
    }

    public function getArtisticInfoAsArrayAttribute()
    {
        if ($this->artistic_info) {
            $artistic_info = json_decode($this->artistic_info, true);
            return $artistic_info;
        }

        return [];
    }

    public function getAwardsAsArrayAttribute()
    {
        if ($this->awards) {
            $awards = json_decode($this->awards, true);
            return $awards;
        }

        return [];
    }

    public function getFestivalsAsArrayAttribute()
    {
        if ($this->festivals) {
            $festivals = json_decode($this->festivals, true);
            return $festivals;
        }

        return [];
    }


    public function getSponsorsAsArrayAttribute()
    {
        if ($this->sponsors) {
            $sponsors = json_decode($this->sponsors, true);
            return $sponsors;
        }

        return [];
    }

    public function getAttachmentsAsArrayAttribute()
    {
        if ($this->attachments) {
            $attachments = json_decode($this->attachments, true);
            return $attachments;
        }

        return [];
    }

    public function getGalleryFilePathsAsArrayAttribute()
    {
        if ($this->gallery_files_paths) {
            $gallery_file_paths = json_decode($this->gallery_files_paths, true);
            return $gallery_file_paths;
        }

        return [];
    }

    public function getHumanStatusAttribute()
    {
        $status_array = [
            Project::STATUS_DEVELOPMENT => __(
                'cinema-catalog::backpack.projects_status.development'
            ),
            Project::STATUS_PRODUCTION => __('cinema-catalog::backpack.projects_status.production'),
            Project::STATUS_POSTPRODUCTION => __(
                'cinema-catalog::backpack.projects_status.postproduction'
            ),
            Project::STATUS_DISTRIBUTION => __('cinema-catalog::backpack.projects_status.distribution'),

        ];

        if ($this->status) {
            return $status_array[$this->status];
        }

        return null;
    }


    public function getHumanTypeAttribute()
    {
        $types_array = [
            Project::TYPE_FEATURE_FILM => __(
                'cinema-catalog::backpack.projects_types.feature_film'
            ),
            Project::TYPE_SHORT_FILM => __(
                'cinema-catalog::backpack.projects_types.short_film'
            ),
            Project::TYPE_OTHER => __(
                'cinema-catalog::backpack.projects_types.other'
            ),

        ];

        if ($this->type) {
            return $types_array[$this->type];
        }

        return null;
    }

    public function getSponsorTypesSeparetlyAttribute()
    {
        if ($this->sponsors_as_array) {
            $sponsors_collections = collect($this->sponsors_as_array)->groupBy('type');
            return $sponsors_collections;
        }

        return null;
    }

}
