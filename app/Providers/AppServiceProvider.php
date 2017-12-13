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
        
        \URL::forceScheme('https');


        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {

            $profInfo = DB::table('professional_information')
                            ->where('user', Auth::id() )
                            ->get();

            $privacyStatement = DB::table('privacy_statement')
                            ->orderby('id','DESC')
                            ->take(1)
                            ->get();
            $StatementForUser = DB::table('users')
                            ->where('id', Auth::id() )
                            ->value('privacy_statement');


            if($profInfo->count() > 0 && is_null($StatementForUser) || $StatementForUser != $privacyStatement[0]->id){
                $event->menu->add([
                    'text' => 'Aviso de Privacidad',
                    'url'  => 'privacyStatement/index',
                    'icon' => ''
                ]);

            }else{

                /**
                 * Se contabiliza la información profesional del médico 
                 * y en caso de ser mayor a 0 se considerá como uno 
                 * y la interfaz cambia.
                 */

                if($profInfo->count() > 0){
                    //es un médico
                    $menusInfo = DB::table('menus')
                                    ->where('to', 'Doctor' )
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

                }else{

                  if(is_null($StatementForUser) || $StatementForUser != $privacyStatement[0]->id){
                     $event->menu->add([
                                        'text' => 'Aviso de Privacidad',
                                        'url'  => 'privacyStatement/index',
                                        'icon' => ''
                                    ]);
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
                    }
         } }
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
