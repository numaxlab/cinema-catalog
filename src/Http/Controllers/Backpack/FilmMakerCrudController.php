<?php

namespace NumaxLab\CinemaCatalog\Http\Controllers\Backpack;

use App\Http\Requests\FilmMakerRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class FilmMakerCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class FilmMakerCrudController extends CrudController
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
        CRUD::setModel(config('cinema-catalog.film_maker_model_namespace'));
        CRUD::setRoute(config('backpack.base.route_prefix') . '/film_maker');
        CRUD::setEntityNameStrings(
            __('cinema-catalog::backpack.film_maker'),
            __('cinema-catalog::backpack.film_makers')
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
            'name' => 'image_file_path',
            'label' => __('cinema-catalog::backpack.image'),
            'type' => 'image',
            'withFiles' => [
                'disk' => 'public',
                'path' => config('cinema-catalog.film_makers_folder_name'),
            ],
        ]);

        CRUD::addColumn([
            'name' => 'name',
            'label' => __('cinema-catalog::backpack.name'),
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
            'name' => 'required',
        ]);

        CRUD::addField([
            'name' => 'name',
            'label' => __('cinema-catalog::backpack.name'),
            'type' => 'text'
        ]);
        CRUD::addField([   // Text
            'name' => 'slug',
            'target' => 'name',
            'label' => "Slug",
            'type' => 'slug',
        ]);

        CRUD::addField([
            'name' => 'description',
            'label' => __('cinema-catalog::backpack.description'),
            'type' => 'wysiwyg'
        ]);

        CRUD::addField([
            'name' => 'image_file_path',
            'label' => __('cinema-catalog::backpack.image'),
            'type' => 'image',
            'withFiles' => [
                'disk' => 'public',
                'path' => config('cinema-catalog.film_makers_folder_name'),
            ],
        ]);

        CRUD::addField([
            'name' => 'image_caption',
            'label' => __('cinema-catalog::backpack.caption'),
            'type' => 'text'
        ]);


        CRUD::addField([
            'name' => 'is_public',
            'label' => __('cinema-catalog::backpack.is_public_m'),
            'type' => 'checkbox'
        ]);
    }

    protected function setupReorderOperation()
    {
        CRUD::set('reorder.label', 'name');
        CRUD::set('reorder.max_level', 1);
    }
}
