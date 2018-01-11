<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Transformers\UserTransformer;
use App\Http\Requests\Api\User\StoreUserRequest;
use App\Http\Controllers\Controller;
use Cyvelnet\Laravel5Fractal\Facades\Fractal;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
    	$users = User::all();

    	return Fractal::collection($users, new UserTransformer);
    }

    public function show(User $user){
    	return Fractal::item($users, new UserTransformer);
    }

    /*public function store(StoreUserRequest $request){
    	$user = new User;
    	$uN = explode('@', $request->email);
        $uN['username'] = $uN[0] . '@boomedic.mx';
        $explodeName = explode(' ', $request->name);
        $namesUser = array();
        $age = date("Y") - substr($request->birthdate, -4);

        $user->name = $request->name;
        	if(count($explodeName) == 2){

                $namesUser['first'] = $explodeName[0];
                $namesUser['last'] = $explodeName[1];
            
            }elseif (count($explodeName) == 3) {

                $namesUser['first'] = $explodeName[0];
                $namesUser['last'] = $explodeName[1] . ' ' . $explodeName[2];

            }elseif (count($explodeName) == 4) {

                $namesUser['first'] = $explodeName[0] . ' ' . $explodeName[1];
                $namesUser['last'] = $explodeName[2] . ' ' . $explodeName[3];
            }

    }*/
}
