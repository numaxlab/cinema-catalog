<?php

namespace NumaxLab\CinemaCatalogBackpack\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cinema extends Model
{
    use HasFactory;
    use CrudTrait;

    protected $fillable = [
        'name',
        'city',
        'address',
        'logo_file_path',
        'coordinates',
        'web_url',
        'is_public'

    ];


    protected $casts = [
        'address' => 'array',
        'coordinates' => 'array',

    ];


    public function sessions(): HasMany
    {
        return $this->hasMany(Session::class);
    }

}
