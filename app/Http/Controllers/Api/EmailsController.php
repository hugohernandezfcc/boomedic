<?php

namespace App\Http\Controllers\Api;

use App\Email;
use App\Transformers\EmailTransformer;
use App\Http\Requests\Api\Email\storeEmailsRequest;
use App\Http\Requests\Api\Email\updateEmailsRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cyvelnet\Laravel5Fractal\Facades\Fractal;

class EmailsController extends Controller
{
        public function index(){
    	$email = Email::all();
    	return Fractal::includes('owner')->collection($email, new EmailTransformer);
    }

    public function show(Email $email){
    	return Fractal::includes('owner')->item($email, new EmailTransformer);

    }

    public function store(storeEmailsRequest $request){
    	$email = new Email;

    	$email->userId = $request->userId;
        $email->email = $request->email; 
        $email->date = $request->date;
        $email->sender = $request->sender;
        $email->recipient = $request->recipient; 
        $email->subject = $request->subject;
        $email->message = $request->message;

        $email->parent = ($request->has('parent')) ? $request->parent :  $email->parent;

        $email->save();

        return Fractal::includes('owner')->item($email, new EmailTransformer);

    }

    public function update(updateEmailsRequest $request, Email $email){
    	$email->userId = ($request->has('userId')) ? $request->userId :  $email->userId;
        $email->email = ($request->has('email')) ? $request->email :  $email->email;
        $email->date = ($request->has('date')) ? $request->date :  $email->date;
        $email->sender = ($request->has('sender')) ? $request->sender :  $email->sender;
        $email->recipient = ($request->has('recipient')) ? $request->recipient :  $email->recipient;
        $email->subject = ($request->has('subject')) ? $request->subject :  $email->subject;
        $email->message = ($request->has('message')) ? $request->message :  $email->message;

        $email->save();

        return Fractal::includes('owner')->item($email, new EmailTransformer);

    }
}
