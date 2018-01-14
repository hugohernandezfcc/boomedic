<?php

namespace App\Http\Controllers\Api;

use App\SupportTicket;
use App\Transformers\SupportTicketTransformer;
use App\Http\Requests\Api\SupportTicket\storeSupportTicket;
use App\Http\Requests\Api\SupportTicket\updateSupportTicket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cyvelnet\Laravel5Fractal\Facades\Fractal;

class SupportTicketController extends Controller
{
    public function index(){
    	$supportTicket = SupportTicket::all();
    	return Fractal::collection($supportTicket, new SupportTicketTransformer);
    }

    public function show(SupportTicket $supportTicket){
    	return Fractal::item($supportTicket, new SupportTicketTransformer);

    }

    public function store(storeSupportTicket $request){
    	$supportTicket = new SupportTicket;

    	$supportTicket->user = $request->user;
        $supportTicket->email = $request->email; 
        $supportTicket->userType = $request->userType;
        $supportTicket->ticketDescription = $request->ticketDescription;
        $supportTicket->userId = $request->userId; 
        $supportTicket->status = $request->status;  
        $supportTicket->subject = $request->subject;

        $supportTicket->save();

        return Fractal::item($supportTicket, new SupportTicketTransformer);

    }

    public function update(updateSupportTicket $request, SupportTicket $supportTicket){
    	$supportTicket->user = ($request->has('user')) ? $request->user :  $supportTicket->user;
        $supportTicket->email = ($request->has('email')) ? $request->email :  $supportTicket->email;
        $supportTicket->userType = ($request->has('userType')) ? $request->userType :  $supportTicket->userType;
        $supportTicket->ticketDescription = ($request->has('ticketDescription')) ? $request->ticketDescription :  $supportTicket->ticketDescription;
        $supportTicket->userId = ($request->has('userId')) ? $request->userId :  $supportTicket->userId;
        $supportTicket->status = ($request->has('status')) ? $request->status :  $supportTicket->status; 
        $supportTicket->subject = ($request->has('subject')) ? $request->subject :  $supportTicket->subject;

        $supportTicket->save();

        return Fractal::item($supportTicket, new SupportTicketTransformer);

    }
}
