<?php

namespace NumaxLab\CinemaCatalogBackpack\Commands;

use Backpack\CRUD\app\Console\Commands\Traits\PrettyCommandOutput;
use Illuminate\Console\Command;

class Install extends Command
{

    use PrettyCommandOutput;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:cinema-catalog-backpack:install      {--debug} : Show process output or not. Useful for debugging.';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add crud menu items';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->progressBlock('Engadindo menú items');
        $this->executeArtisanProcess('backpack:add-menu-content', [

            'code' => '<x-backpack::menu-item title="' . __(
                    'cinema-catalog-backpack::backpack.projects'
                ) . '" icon="la la-question" :link="backpack_url(\'project\')"/>',


        ]);
        $this->executeArtisanProcess('backpack:add-menu-content', [


            'code' => '<x-backpack::menu-item title="' . __(
                    'cinema-catalog-backpack::backpack.film_makers'
                ) . '" icon="la la-question" :link="backpack_url(\'film_maker\')"/>'

        ]);

        if (config('cinema-catalog-backpack.include_project_collections')) {
            $this->executeArtisanProcess('backpack:add-menu-content', [


                'code' => '<x-backpack::menu-item title="' . __(
                        'cinema-catalog-backpack::backpack.project_collections'
                    ) . '" icon="la la-question" :link="backpack_url(\'project_collection\')"/>'

            ]);
        }

        if (config('cinema-catalog-backpack.include_sessions')) {
            $this->executeArtisanProcess('backpack:add-menu-content', [


                'code' => '<x-backpack::menu-item title="' . __(
                        'cinema-catalog-backpack::backpack.cinemas'
                    ) . '" icon="la la-question" :link="backpack_url(\'cinema\')"/>'

            ]);
            $this->executeArtisanProcess('backpack:add-menu-content', [


                'code' => '   <x-backpack::menu-item title="' . __(
                        'cinema-catalog-backpack::backpack.sessions'
                    ) . '" icon="la la-question" :link="backpack_url(\'session\')"/>'

            ]);
        }


        $this->closeProgressBlock();
    }
}
