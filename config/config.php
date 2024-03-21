<?php

return [

    'include_project_collections' => true,
    'include_sessions' => true,

    'project_model_namespace' => \NumaxLab\CinemaCatalogBackpack\Models\Project::class,
    'project_collection_model_namespace' => \NumaxLab\CinemaCatalogBackpack\Models\ProjectCollection::class,
    'cinema_model_namespace' => \NumaxLab\CinemaCatalogBackpack\Models\Cinema::class,
    'film_maker_model_namespace' => \NumaxLab\CinemaCatalogBackpack\Models\FilmMaker::class,
    'session_model_namespace' => \NumaxLab\CinemaCatalogBackpack\Models\Session::class,


    'default_project_tech_info' => [

        'cinema-catalog-backpack::backpack.default_project_tech_info.release_date',
        'cinema-catalog-backpack::backpack.default_project_tech_info.gender',
        'cinema-catalog-backpack::backpack.default_project_tech_info.production_country',
        'cinema-catalog-backpack::backpack.default_project_tech_info.languages',
        'cinema-catalog-backpack::backpack.default_project_tech_info.color',
        'cinema-catalog-backpack::backpack.default_project_tech_info.resolution',
        'cinema-catalog-backpack::backpack.default_project_tech_info.aspect_ration',
        'cinema-catalog-backpack::backpack.default_project_tech_info.audio',

    ],
    'default_project_artistic_info' => [

        'cinema-catalog-backpack::backpack.default_project_artistic_info.script',
        'cinema-catalog-backpack::backpack.default_project_artistic_info.interpreters',
        'cinema-catalog-backpack::backpack.default_project_artistic_info.photo',
        'cinema-catalog-backpack::backpack.default_project_artistic_info.assembly',
        'cinema-catalog-backpack::backpack.default_project_artistic_info.art_direction',
        'cinema-catalog-backpack::backpack.default_project_artistic_info.audio',
        'cinema-catalog-backpack::backpack.default_project_artistic_info.music',
        'cinema-catalog-backpack::backpack.default_project_artistic_info.production',
        'cinema-catalog-backpack::backpack.default_project_artistic_info.production_direction',
        'cinema-catalog-backpack::backpack.default_project_artistic_info.distribution',

    ],

    'projects_folder_name' => 'proxectos',
    'film_makers_folder_name' => 'cineastas',
    'project_collections_folder_name' => 'ciclos',
    'cinemas_folder_name' => 'cines'
];
