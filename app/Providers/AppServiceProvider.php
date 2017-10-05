<?php

namespace App\Providers;

use App\User;
use App\menu;
use App\ProfessionalInformation;


use Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {

        URL::forceScheme('https');


        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {

            $profInfo = DB::table('ProfessionalInformation')->where('user', Auth::id() )->get();

            if($profInfo->count() > 0){
                //es un médico
                $event->menu->add('DOCTORES');
            }else{
                $menusInfo = DB::table('menus')
                                ->where('to', 'Patient' )
                                ->orWhere('to', 'Both')
                                ->get();

                for ($i=0; $i < $menusInfo->count(); $i++) { 
                    if($menusInfo[$i]->typeitem == 'section' ){
                        # Se agrega la sección
                        $event->menu->add( $menusInfo[$i]->text );
                        
                        for ($o=0; $o < $menusInfo->count(); $o++) { 
                            if($menusInfo[$o]->parent == $menusInfo[$i]->id ){

                                # Se agregan los items de la sección.
                                $event->menu->add([
                                    'text' => $menusInfo[$o]->text,
                                    'url'  => $menusInfo[$o]->url,
                                    'icon' => $menusInfo[$o]->icon
                                ]);
                            }

                        }
                    }

                }
                // $event->menu->add('MAIN NAVIGATION');
                // $event->menu->add([
                //     'text' => 'Blog ' . Auth::id(),
                //     'url' => 'admin/blog',
                // ]);

            }            
        });
    }
 
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
