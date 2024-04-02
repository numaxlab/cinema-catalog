<?php

namespace NumaxLab\CinemaCatalog\Http\Controllers\Backpack;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ProjectCollectionCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ProjectCollectionCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(config('cinema-catalog.project_collection_model_namespace'));
        CRUD::setRoute(config('backpack.base.route_prefix') . '/project_collection');
        CRUD::setEntityNameStrings(
            __('cinema-catalog::backpack.project_collection'),
            __('cinema-catalog::backpack.project_collections')
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
        CRUD::addColumn([
            'name' => 'poster_file_path',
            'label' => __('cinema-catalog::backpack.poster'),
            'type' => 'image',
            'withFiles' => [
                'disk' => 'public',
                'path' => config('cinema-catalog.project_collections_folder_name'),
            ],
        ]);
        CRUD:

        CRUD::addColumn([
            'name' => 'title',
            'label' => __('cinema-catalog::backpack.title'),
            'type' => 'text'
        ]);

        CRUD::addColumn([
            'name' => 'is_public',
            'label' => __('cinema-catalog::backpack.is_public_m'),
            'type' => 'checkbox'
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

        CRUD::addField([
            'name' => 'description',
            'label' => __('cinema-catalog::backpack.description'),
            'type' => 'wysiwyg'
        ]);

        CRUD::addField([
            'name' => 'poster_file_path',
            'label' => __('cinema-catalog::backpack.poster'),
            'type' => 'image',
            'withFiles' => [
                'disk' => 'public',
                'path' => config('cinema-catalog.project_collections_folder_name'),
            ],
        ]);
        CRUD::addField([
            'name' => 'image_file_path',
            'label' => __('cinema-catalog::backpack.image'),
            'type' => 'image',
            'withFiles' => [
                'disk' => 'public',
                'path' => config('cinema-catalog.project_collections_folder_name'),
            ],


        ]);


        {
            CRUD::addField([   // relationship
                'name' => 'projects',
                'type' => "relationship",
                'label' => __('cinema-catalog::backpack.projects'),

            ]);
        }

        CRUD::addField([
            'name' => 'is_public',
            'label' => __('cinema-catalog::backpack.is_public_m'),
            'type' => 'checkbox'
        ]);
    }

    protected function setupReorderOperation()
    {
        CRUD::set('reorder.label', 'title');
        CRUD::set('reorder.max_level', 1);
    }
}
