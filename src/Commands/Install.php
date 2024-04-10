<?php

namespace NumaxLab\CinemaCatalog\Commands;

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
    protected $signature = 'numaxlab:cinema-catalog:install
                                {--debug} : Show process output or not. Useful for debugging.';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Cinema Catalog package';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->progressBlock('Adding menu items');
        $this->executeArtisanProcess('backpack:add-menu-content', [
            'code' => '<x-backpack::menu-item title="' . __(
                    'cinema-catalog::backpack.projects'
                ) . '" icon="la la-film" :link="backpack_url(\'project\')"/>',
        ]);

        if (config('cinema-catalog.include_film_makers')) {
            $this->executeArtisanProcess('backpack:add-menu-content', [
                'code' => '<x-backpack::menu-item title="' . __(
                        'cinema-catalog::backpack.film_makers'
                    ) . '" icon="la la-users" :link="backpack_url(\'film_maker\')"/>'
            ]);
        }
        if (config('cinema-catalog.include_project_collections')) {
            $this->executeArtisanProcess('backpack:add-menu-content', [
                'code' => '<x-backpack::menu-item title="' . __(
                        'cinema-catalog::backpack.project_collections'
                    ) . '" icon="la la-layer-group" :link="backpack_url(\'project_collection\')"/>'
            ]);
        }

        if (config('cinema-catalog.include_sessions')) {
            $this->executeArtisanProcess('backpack:add-menu-content', [
                'code' => '<x-backpack::menu-item title="' . __(
                        'cinema-catalog::backpack.cinemas'
                    ) . '" icon="la la-video" :link="backpack_url(\'cinema\')"/>'
            ]);

            $this->executeArtisanProcess('backpack:add-menu-content', [
                'code' => '<x-backpack::menu-item title="' . __(
                        'cinema-catalog::backpack.sessions'
                    ) . '" icon="la la-calendar" :link="backpack_url(\'session\')"/>'
            ]);
        }

        $this->closeProgressBlock();
    }
}
