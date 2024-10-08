<?php

namespace NumaxLab\CinemaCatalog\Http\Controllers\Backpack;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use NumaxLab\CinemaCatalog\Models\Project;

/**
 * Class ProjectCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ProjectCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ReorderOperation;


    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(config('cinema-catalog.project_model_namespace'));
        //CRUD::setModel(Project::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/project');
        CRUD::setEntityNameStrings(
            __('cinema-catalog::backpack.project'),
            __('cinema-catalog::backpack.projects')
        );
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::filter('status')
            ->type('dropdown')
            ->label(__('cinema-catalog::backpack.status'))
            ->values([
                Project::STATUS_DEVELOPMENT => __(
                    'cinema-catalog::backpack.projects_status.development'
                ),
                Project::STATUS_PRODUCTION => __('cinema-catalog::backpack.projects_status.production'),
                Project::STATUS_POSTPRODUCTION => __(
                    'cinema-catalog::backpack.projects_status.postproduction'
                ),
                Project::STATUS_DISTRIBUTION => __('cinema-catalog::backpack.projects_status.distribution'),

            ])
            ->whenActive(function ($value) {
                CRUD::addClause('where', 'status', $value);
            });

        CRUD::filter('type')
            ->type('dropdown')
            ->label(__('cinema-catalog::backpack.type'))
            ->values([
                Project::TYPE_FEATURE_FILM => __('cinema-catalog::backpack.projects_types.feature_film'),
                Project::TYPE_SHORT_FILM => __('cinema-catalog::backpack.projects_types.short_film'),
                Project::TYPE_OTHER => __('cinema-catalog::backpack.projects_types.other'),
            ])
            ->whenActive(function ($value) {
                CRUD::addClause('where', 'type', $value);
            });

        CRUD::column('id');

        CRUD::addColumn([
            'name' => 'title',
            'label' => __('cinema-catalog::backpack.title'),
            'type' => 'text'
        ]);

        CRUD::addColumn([
            'name' => 'status',
            'label' => __('cinema-catalog::backpack.status'),
            'type' => 'select_from_array',
            'options' => [
                Project::STATUS_DEVELOPMENT => __(
                    'cinema-catalog::backpack.projects_status.development'
                ),
                Project::STATUS_PRODUCTION => __('cinema-catalog::backpack.projects_status.production'),
                Project::STATUS_POSTPRODUCTION => __(
                    'cinema-catalog::backpack.projects_status.postproduction'
                ),
                Project::STATUS_DISTRIBUTION => __('cinema-catalog::backpack.projects_status.distribution'),

            ],
        ]);

        CRUD::addColumn([
            'name' => 'type',
            'label' => __('cinema-catalog::backpack.type'),
            'type' => 'select_from_array',
            'options' => [
                Project::TYPE_FEATURE_FILM => __('cinema-catalog::backpack.projects_types.feature_film'),
                Project::TYPE_SHORT_FILM => __('cinema-catalog::backpack.projects_types.short_film'),
                Project::TYPE_OTHER => __('cinema-catalog::backpack.projects_types.other'),

            ],
        ]);

        CRUD::addColumn([
            'name' => 'is_public',
            'label' => __('cinema-catalog::backpack.is_public_m'),
            'type' => 'check',
        ]);
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation([
            'title' => 'required',
        ]);


        CRUD::addField([
            'name' => 'title',
            'label' => __('cinema-catalog::backpack.title'),
            'type' => 'text'
        ]);


        CRUD::addField([   // Text
            'name' => 'slug',
            'target' => 'title',
            'label' => "Slug",
            'type' => 'slug',
        ]);

        CRUD::addField([
            'name' => 'original_title',
            'label' => __('cinema-catalog::backpack.original_title'),
            'type' => 'text'
        ]);

        CRUD::addField([
            'name' => 'type',
            'label' => __('cinema-catalog::backpack.type'),
            'type' => 'select_from_array',
            'options' => [
                Project::TYPE_FEATURE_FILM => __('cinema-catalog::backpack.projects_types.feature_film'),
                Project::TYPE_SHORT_FILM => __('cinema-catalog::backpack.projects_types.short_film'),
                Project::TYPE_OTHER => __('cinema-catalog::backpack.projects_types.other'),

            ],
        ]);

        CRUD::addField([
            'name' => 'length',
            'label' => __('cinema-catalog::backpack.length'),
            'type' => 'number'
        ]);
        CRUD::addField([
            'name' => 'year',
            'label' => __('cinema-catalog::backpack.year'),
            'type' => 'number'
        ]);


        CRUD::addField([
            'name' => 'status',
            'label' => __('cinema-catalog::backpack.status'),
            'type' => 'select_from_array',
            'options' => [
                Project::STATUS_DEVELOPMENT => __(
                    'cinema-catalog::backpack.projects_status.development'
                ),
                Project::STATUS_PRODUCTION => __('cinema-catalog::backpack.projects_status.production'),
                Project::STATUS_POSTPRODUCTION => __(
                    'cinema-catalog::backpack.projects_status.postproduction'
                ),
                Project::STATUS_DISTRIBUTION => __('cinema-catalog::backpack.projects_status.distribution'),
            ],
        ]);

        if (config('cinema-catalog.include_project_collections')
        ) {
            {
                CRUD::addField([   // relationship
                    'name' => 'project_collection',
                    'type' => "relationship",
                    'label' => __('cinema-catalog::backpack.project_collection'),

                ]);
            }
        }

        CRUD::addField([
            'name' => 'synopsis',
            'label' => __('cinema-catalog::backpack.synopsis'),
            'type' => 'ckeditor',
        ]);


        CRUD::addField([
            'name' => 'trailer',
            'label' => 'Trailer',
            'type' => 'textarea'
        ]);


        CRUD::addField([
            'name' => 'poster_file_path',
            'label' => __('cinema-catalog::backpack.poster'),
            'type' => 'image',
            'withFiles' => [
                'disk' => 'public',
                'path' => config('cinema-catalog.projects_folder_name'),
            ],
            'wrapper' => ['class' => 'form-group col-md-4']

        ]);

        CRUD::addField([
            'name' => 'main_image_file_path',
            'label' => __('cinema-catalog::backpack.main_image'),
            'type' => 'image',
            'withFiles' => [
                'disk' => 'public',
                'path' => config('cinema-catalog.projects_folder_name'),
            ],
            'wrapper' => ['class' => 'form-group col-md-4'],
            'hint' => config('cinema-catalog.project_main_image_hint')


        ]);


        CRUD::addfield([
            'name' => 'gallery_files_paths',
            'label' => __('cinema-catalog::backpack.images_gallery'),
            'type' => 'repeatable',
            'subfields' => [
                [

                    'name' => 'path',
                    'label' => __('cinema-catalog::backpack.image'),
                    'type' => 'browse'
                ],


            ],
            'new_item_label' => __('cinema-catalog::backpack.add_image'),
            'reorder' => true,
            'wrapper' => ['class' => 'form-group col-md-4'],
            'hint' => config('cinema-catalog.project_images_gallery_hint')

        ]);

        CRUD::addfield([
            'name' => 'tech_info',
            'label' => __('cinema-catalog::backpack.tech_info'),
            'type' => 'repeatable',
            'subfields' => [
                [
                    'name' => 'name',
                    'label' => __('cinema-catalog::backpack.key'),
                    'type' => 'text',
                    'wrapper' => ['class' => 'form-group col-md-6']
                ],
                [
                    'name' => 'value',
                    'label' => __('cinema-catalog::backpack.value'),
                    'type' => 'text',
                    'wrapper' => ['class' => 'form-group col-md-6']
                ],
            ],
            'new_item_label' => __('cinema-catalog::backpack.add_element'),
            'reorder' => true,
            'default' => $this->getDefaultTechInfoFields(),
            'tab' => __('cinema-catalog::backpack.tech_info')


        ]);


        if (config('cinema-catalog.include_film_makers')
        ) {
            //realtionship director filmmaker
            CRUD::addField([   // relationship
                'name' => 'film_makers',
                'type' => "relationship",
                'label' => __('cinema-catalog::backpack.direction'),
                'tab' => __('cinema-catalog::backpack.artistic_info')


            ]);
        }

        CRUD::addfield([
            'name' => 'artistic_info',
            'label' => __('cinema-catalog::backpack.artistic_info'),
            'type' => 'repeatable',
            'subfields' => [
                [
                    'name' => 'name',
                    'label' => __('cinema-catalog::backpack.key'),
                    'type' => 'text',
                    'wrapper' => ['class' => 'form-group col-md-6']
                ],
                [
                    'name' => 'value',
                    'label' => __('cinema-catalog::backpack.value'),
                    'type' => 'text',
                    'wrapper' => ['class' => 'form-group col-md-6']
                ],
            ],
            'new_item_label' => __('cinema-catalog::backpack.add_element'),
            'reorder' => true,
            'default' => $this->getDefaultArtisticInfoFields(),
            'tab' => __('cinema-catalog::backpack.artistic_info')

        ]);


        CRUD::addfield([
            'name' => 'sponsors',
            'label' => __('cinema-catalog::backpack.sponsors'),
            'type' => 'repeatable',
            'subfields' => [
                [
                    'name' => 'type',
                    'type' => 'text',
                    'label' => __('cinema-catalog::backpack.type'),
                ],

                [
                    'name' => 'name',
                    'type' => 'text',
                    'label' => __('cinema-catalog::backpack.name'),
                ],
                [
                    'name' => 'url',
                    'type' => 'text',
                    'label' => __('cinema-catalog::backpack.url'),
                ],


                [
                    'name' => 'logo',
                    'label' => 'Logo',
                    'type' => 'browse',

                ],

            ],
            'new_item_label' => __('cinema-catalog::backpack.add_element'),
            'reorder' => true,
            'tab' => __('cinema-catalog::backpack.sponsors')

        ]);


        CRUD::addfield([
            'name' => 'festivals',
            'label' => __('cinema-catalog::backpack.festivals'),
            'type' => 'repeatable',
            'subfields' => [
                [
                    'name' => 'title',
                    'type' => 'text',
                    'label' => __('cinema-catalog::backpack.title'),
                ],

                [
                    'name' => 'year',
                    'type' => 'number',
                    'label' => __('cinema-catalog::backpack.year'),
                ],
                [
                    'name' => 'description',
                    'label' => __('cinema-catalog::backpack.small-description'),
                    'type' => 'text',

                ],

                [
                    'name' => 'logo',
                    'label' => 'Logo',
                    'type' => 'browse',
                    'hint' => config('cinema-catalog.event_logo_hint'),


                ],
                [
                    'name' => 'href',
                    'label' => 'Enlace',
                    'type' => 'url',
                ],

            ],

            'new_item_label' => __('cinema-catalog::backpack.add_element'),
            'reorder' => true,
            'tab' => __('cinema-catalog::backpack.events')

        ]);

        CRUD::addfield([
            'name' => 'awards',
            'label' => __('cinema-catalog::backpack.awards'),
            'type' => 'repeatable',
            'subfields' => [

                [
                    'name' => 'title',
                    'type' => 'text',
                    'label' => __('cinema-catalog::backpack.title'),
                ],

                [
                    'name' => 'year',
                    'type' => 'number',
                    'label' => __('cinema-catalog::backpack.year'),
                ],
                [
                    'name' => 'description',
                    'label' => __('cinema-catalog::backpack.small-description'),
                    'type' => 'text',

                ],
                [
                    'name' => 'logo',
                    'label' => 'Logo',
                    'type' => 'browse',
                    'hint' => config('cinema-catalog.event_logo_hint'),


                ],
                [
                    'name' => 'href',
                    'label' => 'Enlace',
                    'type' => 'url',
                ],


            ],

            'new_item_label' => __('cinema-catalog::backpack.add_element'),
            'reorder' => true,
            'tab' => __('cinema-catalog::backpack.events')

        ]);

        CRUD::addfield([
            'name' => 'reviews',
            'label' => __('cinema-catalog::backpack.reviews'),
            'type' => 'repeatable',
            'subfields' => [

                [
                    'name' => 'content',
                    'type' => 'textarea',
                    'label' => __('cinema-catalog::backpack.content'),
                ],

                [
                    'name' => 'author',
                    'type' => 'text',
                    'label' => __('cinema-catalog::backpack.author'),
                ],
                [
                    'name' => 'media',
                    'label' => __('cinema-catalog::backpack.media'),
                    'type' => 'text',

                ],


            ],
            'new_item_label' => __('cinema-catalog::backpack.add_element'),
            'reorder' => true,
            'tab' => __('cinema-catalog::backpack.reviews')

        ]);

        CRUD::addfield([
            'name' => 'attachments',
            'label' => __('cinema-catalog::backpack.attachments'),
            'type' => 'repeatable',
            'subfields' => [

                [
                    'name' => 'title',
                    'type' => 'text',
                    'label' => __('cinema-catalog::backpack.title'),
                ],
                [
                    'name' => 'document',
                    'type' => 'browse',
                    'label' => __('cinema-catalog::backpack.attachments'),
                ],
            ],
            'new_item_label' => __('cinema-catalog::backpack.add_element'),
            'reorder' => true,

        ]);


        CRUD::addField([
            'name' => 'is_public',
            'label' => __('cinema-catalog::backpack.is_public_m'),
            'type' => 'checkbox'
        ]);
    }

    /**
     * @return array[]
     */


    private function getDefaultTechInfoFields()
    {
        $tech_info_arr = [];


        foreach ((config('cinema-catalog.default_project_tech_info')) as $tech_info_label) {
            array_push($tech_info_arr, [
                'name' => __($tech_info_label),
                'value' => '',
            ]);
        }

        return $tech_info_arr;
    }

    private function getDefaultArtisticInfoFields()
    {
        $artistic_info_arr = [];

        foreach ((config('cinema-catalog.default_project_artistic_info')) as $artistic_info_label) {
            array_push($artistic_info_arr, [
                'name' => __($artistic_info_label),
                'value' => '',
            ]);
        }

        return $artistic_info_arr;
    }


    protected function setupReorderOperation()
    {
        CRUD::set('reorder.label', 'title');
        CRUD::set('reorder.max_level', 1);
    }
}
