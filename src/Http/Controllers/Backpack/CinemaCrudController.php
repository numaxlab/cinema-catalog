<?php

namespace NumaxLab\CinemaCatalog\Http\Controllers\Backpack;

use App\Http\Requests\CinemaRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CinemaCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CinemaCrudController extends CrudController
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
        CRUD::setModel(config('cinema-catalog.cinema_model_namespace'));
        CRUD::setRoute(config('backpack.base.route_prefix') . '/cinema');
        CRUD::setEntityNameStrings(
            __('cinema-catalog::backpack.cinema'),
            __('cinema-catalog::backpack.cinemas')
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
        CRUD::column('id');

        CRUD::addColumn([
            'name' => 'logo_file_path',
            'label' => 'Logo',
            'type' => 'image',
            'withFiles' => [
                'disk' => 'public',
                'path' => config('cinema-catalog.cinemas_folder_name'),
            ],
        ]);

        CRUD::addColumn([
            'name' => 'name',
            'label' => __('cinema-catalog::backpack.name'),
            'type' => 'text'
        ]);

        CRUD::addColumn([
            'name' => 'city',
            'label' => __('cinema-catalog::backpack.address.city'),
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
            'city' => 'required',
        ]);


        CRUD::addField([
            'name' => 'name',
            'label' => __('cinema-catalog::backpack.name'),
            'type' => 'text'
        ]);
        CRUD::addField([
            'name' => 'city',
            'label' => __('cinema-catalog::backpack.address.city'),
            'type' => 'text'
        ]);


        CRUD::addField([
            'name' => 'logo_file_path',
            'label' => 'Logo',
            'type' => 'image',
            'withFiles' => [
                'disk' => 'public',
                'path' => config('cinema-catalog.cinemas_folder_name'),
            ],
        ]);


        CRUD::addField([
            'name' => 'web_url',
            'label' => __('cinema-catalog::backpack.url'),
            'type' => 'text'
        ]);

        CRUD::addfield([
            'name' => 'address',
            'label' => __('cinema-catalog::backpack.address.label'),
            'type' => 'repeatable',
            'subfields' => [


                [
                    'name' => 'street',
                    'type' => 'text',
                    'label' => __('cinema-catalog::backpack.address.street'),
                    'wrapper' => ['class' => 'form-group col-md-8']

                ],
                [
                    'name' => 'number',
                    'type' => 'number',
                    'label' => __('cinema-catalog::backpack.address.number'),
                    'wrapper' => ['class' => 'form-group col-md-2']

                ],
                [
                    'name' => 'floor',
                    'type' => 'text',
                    'label' => __('cinema-catalog::backpack.address.floor'),
                    'wrapper' => ['class' => 'form-group col-md-2']

                ],
                [
                    'name' => 'postal_code',
                    'type' => 'number',
                    'label' => __('cinema-catalog::backpack.address.postal_code'),
                    'wrapper' => ['class' => 'form-group col-md-2']

                ],
                [
                    'name' => 'city',
                    'type' => 'text',
                    'label' => __('cinema-catalog::backpack.address.city'),
                    'wrapper' => ['class' => 'form-group col-md-5']

                ],
                [
                    'name' => 'prvince',
                    'type' => 'text',
                    'label' => __('cinema-catalog::backpack.address.province'),
                    'wrapper' => ['class' => 'form-group col-md-5']

                ],

            ],
            'init_rows' => 1,
            'max_rows' => 1,
            'new_item_label' => __('cinema-catalog::backpack.add_element'),

        ]);

        CRUD::addfield([
            'name' => 'coordinates',
            'label' => __('cinema-catalog::backpack.address.coordinates'),
            'type' => 'repeatable',
            'subfields' => [

                [
                    'name' => 'latitude',
                    'type' => 'text',
                    'label' => __('cinema-catalog::backpack.address.latitude'),
                    'wrapper' => ['class' => 'form-group col-md-6']

                ],
                [
                    'name' => 'longitude',
                    'type' => 'text',
                    'label' => __('cinema-catalog::backpack.address.longitude'),
                    'wrapper' => ['class' => 'form-group col-md-6']


                ],

            ],
            'init_rows' => 1,
            'max_rows' => 1,
        ]);


        CRUD::addField([
            'name' => 'is_public',
            'label' => __('cinema-catalog::backpack.is_public_m'),
            'type' => 'checkbox'
        ]);
    }
}
