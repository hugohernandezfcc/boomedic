<?php

namespace App\Providers;

use App\User;
use App\menu;
use App\medical_appointments;
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

                   
                    $changeHorary = DB::table('medical_appointments')
                                    ->join('workboard', 'medical_appointments.workplace', '=', 'workboard.labInformation')
                                    ->join('users', 'medical_appointments.user', '=', 'users.id')
                                    ->where('medical_appointments.user_doctor', '=', Auth::id())
                                    ->where('medical_appointments.status', '!=', 'No completed')
                                    ->where('workboard.oldnew','new')
                                    ->wheredate('when', '>', Carbon::today())
                                    ->select('medical_appointments.*', 'users.name', 'users.profile_photo')
                                    ->get(); 

                        if(count($changeHorary) > 0){
                            $result = $changeHorary->unique('id');
                            Session(['workboardnew' => $result]);   
                        }           
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

                    //patient 



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
                        $clinic_history = DB::table('clinic_history')
                                        ->join('questions_clinic_history', 'clinic_history.question_id', '=', 'questions_clinic_history.id')
                                        ->where('userid', Auth::id())
                                        ->select('clinic_history.*', 'questions_clinic_history.text_help', 'questions_clinic_history.type')
                                        ->get();                

                        for ($i=0; $i < $menusInfo->count(); $i++) { 
                            if($menusInfo[$i]->typeitem == 'section' ){
                                # Se agrega la sección
                                $event->menu->add( $menusInfo[$i]->text );
                                
                                for ($o=0; $o < $menusInfo->count(); $o++) { 

                                            if($menusInfo[$o]->parent == $menusInfo[$i]->id ){
                                               if(count($clinic_history) == 0 && $menusInfo[$o]->id == 7){
                                                     $event->menu->add([
                                                        'text'   => $menusInfo[$o]->text,
                                                        'url'    => $menusInfo[$o]->url,
                                                        'icon'   => $menusInfo[$o]->icon,
                                                        'active' => [$menusInfo[$o]->url, explode('/', $menusInfo[$o]->url)[0] . '/*'],
                                                        'label'  => 'Pendiente',
                                                        'label_color' => 'yellow'

                                                    ]);
                                                }else{ 
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
