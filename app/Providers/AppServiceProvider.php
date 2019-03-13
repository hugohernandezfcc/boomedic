<?php

namespace App\Providers;

use App\User;
use App\menu;
use App\ProfessionalInformation;
use Carbon\Carbon;
use Jenssegers\Agent\Agent;
use View;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
       
        Carbon::setLocale(config('app.locale'));
      
        \URL::forceScheme('https');
        $agent = new Agent();

        View::share('agent', $agent);
        
        Validator::extend('space', function ($attribute, $value, $parameters, $validator) {
                $val = explode(' ', $value);
                    if(count($val) > 1)
                       return true;
                    else
                        return false;
             });

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

            $confirmed = User::find(Auth::id());           
            if($profInfo->count() > 0 && $confirmed->confirmed == false){
                $event->menu->add([
                    'text' => ' Confirmación de correo',
                    'url'  => 'medicalconsultations',
                    'icon' => ''
                ]);
            }

            elseif($profInfo->count() > 0 && is_null($StatementForUser) || $StatementForUser != $privacyStatement[0]->id && $confirmed->confirmed == true){
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
                                    ->where('to', 'Doctor')->orderBy('order')
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
                     if($confirmed->confirmed == false){
                            $event->menu->add([
                                'text' => ' Confirmación de correo',
                                'url'  => 'medicalconsultations',
                                'icon' => ''
                            ]);
                     }

                    elseif(is_null($StatementForUser) || $StatementForUser != $privacyStatement[0]->id && $confirmed->confirmed == true){
                     $event->menu->add([
                                        'text' => 'Aviso de Privacidad',
                                        'url'  => 'privacyStatement/index',
                                        'icon' => ''
                                    ]);
                    }else{
                        $assistant = DB::table('assistant')->where('user_assist', Auth::id())->get();
                        if(count($assistant) == 0){

                        $menusInfo = DB::table('menus')
                                        ->where('to', 'Patient' )
                                        ->orWhere('to', 'Both')->orderBy('order')
                                        ->get();

                        for ($i=0; $i < $menusInfo->count(); $i++) { 
                            if($menusInfo[$i]->typeitem == 'section' ){
                                # Se agrega la sección
                                $event->menu->add( $menusInfo[$i]->text );
                                
                                for ($o=0; $o < $menusInfo->count(); $o++) { 
                                    if($menusInfo[$o]->parent == $menusInfo[$i]->id ){

                                        # Se agregan los items de la sección.
                                        $event->menu->add([
                                            'text'   => $menusInfo[$o]->text,
                                            'url'    => $menusInfo[$o]->url,
                                            'icon'   => $menusInfo[$o]->icon,
                                            'active' => [$menusInfo[$o]->url, explode('/', $menusInfo[$o]->url)[0] . '/*']
                                        ]);
                                    }
                                }
                            }
                        }
                                }else{

                                        Session(['utype' => 'assistant']); 
                                        $menusInfo = DB::table('menus')
                                                        ->where('to', 'Assistant' )
                                                        ->orWhere('to', 'Both')->orderBy('order')
                                                        ->get();

                                        for ($i=0; $i < $menusInfo->count(); $i++) { 
                                            if($menusInfo[$i]->typeitem == 'section' ){
                                                # Se agrega la sección
                                                $event->menu->add( $menusInfo[$i]->text );
                                                
                                                for ($o=0; $o < $menusInfo->count(); $o++) { 
                                                    if($menusInfo[$o]->parent == $menusInfo[$i]->id ){

                                                        # Se agregan los items de la sección.
                                                        $event->menu->add([
                                                            'text'   => $menusInfo[$o]->text,
                                                            'url'    => $menusInfo[$o]->url,
                                                            'icon'   => $menusInfo[$o]->icon,
                                                            'active' => [$menusInfo[$o]->url, explode('/', $menusInfo[$o]->url)[0] . '/*']
                                                        ]);
                                                    }
                                                }
                                            }
                                        }
                                }
                    }
                    }
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
