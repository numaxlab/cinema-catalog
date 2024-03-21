<?php

namespace NumaxLab\CinemaCatalogBackpack\Http\Controllers;


use App\Http\Requests\SessionRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class SessionCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class SessionCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(config('cinema-catalog-backpack.session_model_namespace'));
        CRUD::setRoute(config('backpack.base.route_prefix') . '/session');
        CRUD::setEntityNameStrings(
            __('cinema-catalog-backpack::backpack.session'),
            __('cinema-catalog-backpack::backpack.sessions')
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
            'name' => 'project',
            'type' => "relationship",
            'label' => __('cinema-catalog-backpack::backpack.film'),

        ]);
        CRUD::addColumn([
            'name' => 'cinema',
            'type' => "relationship",
            'label' => __('cinema-catalog-backpack::backpack.cinema'),

        ]);
        CRUD::addColumn([
            'name' => 'date',
            'type' => "datetime",
            'label' => __('cinema-catalog-backpack::backpack.date'),

        ]);
        CRUD::addColumn([
            'name' => 'is_public',
            'label' => __('cinema-catalog-backpack::backpack.is_public_f'),
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
            'project' => 'required',
            'cinema' => 'required',
            'date' => 'required',
        ]);

        CRUD::addField([
            'name' => 'project',
            'type' => "relationship",
            'label' => __('cinema-catalog-backpack::backpack.film'),

        ]);

        CRUD::addField([
            'name' => 'date',
            'label' => __('cinema-catalog-backpack::backpack.date'),
            'type' => 'datetime'
        ]);

        CRUD::addField([
            'name' => 'cinema',
            'type' => "relationship",
            'label' => __('cinema-catalog-backpack::backpack.cinema'),

        ]);
        CRUD::addField([
            'name' => 'purchase_link',
            'label' => __('cinema-catalog-backpack::backpack.purchase_link'),
            'type' => 'text'
        ]);

        CRUD::addField([
            'name' => 'is_public',
            'label' => __('cinema-catalog-backpack::backpack.is_public_f'),
            'type' => 'checkbox'
        ]);
    }
}
