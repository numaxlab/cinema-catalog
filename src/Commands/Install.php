<?php

namespace NumaxLab\CinemaCatalogBackpack\Commands;

use Illuminate\Console\Command;

class Install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:cinema-catalog-backpack:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //$this->progressBlock('Engadindo menú item');
        $this->executeArtisanProcess('backpack:add-menu-content', [
            'code' => '<x-backpack::menu-item title="Proxectos" icon="la la-question" :link="backpack_url(\'project\')"/>',
        ]);
        //

        //$this->closeProgressBlock();
        //             '<x-backpack::menu-item title="Cineastas" icon="la la-question" :link="backpack_url(\'film_maker\')"/>'


        //if config... add to the menu certain items (project collection / sessions)

    }
}
