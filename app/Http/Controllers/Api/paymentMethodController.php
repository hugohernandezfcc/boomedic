<?php

namespace App\Http\Controllers\Api;

use App\PaymentMethod;
use App\Transformers\PaymentMethodTransformer;
use App\Http\Requests\Api\PaymentMethod\storePaymentMethodRequest;
use App\Http\Requests\Api\PaymentMethod\updatePaymentMethodRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cyvelnet\Laravel5Fractal\Facades\Fractal;

class paymentMethodController extends Controller
{
	public function index(){
    	$paymentMethod = PaymentMethod::all();
    	return Fractal::includes('user')->collection($paymentMethod, new PaymentMethodTransformer);
    }

    public function show(PaymentMethod $paymentMethod){
    	return Fractal::includes('user')->item($paymentMethod, new PaymentMethodTransformer);

    }

    public function store(storePaymentMethodRequest $request){
    	$paymentMethod = new PaymentMethod;

    	$paymentMethod->provider = $request->provider;
        $paymentMethod->typemethod = $request->typemethod; 
        $paymentMethod->cvv = $request->cvv;
        $paymentMethod->cardnumber = $request->cardnumber;
        $paymentMethod->owner = $request->owner;

        $paymentMethod->country = ($request->has('country')) ? $request->country :  $paymentMethod->country;
        $paymentMethod->month = ($request->has('month')) ? $request->month :  $paymentMethod->month;
        $paymentMethod->year = ($request->has('year')) ? $request->year :  $paymentMethod->year;
        $paymentMethod->paypal_email = ($request->has('paypal_email')) ? $request->paypal_email :  $paymentMethod->paypal_email;
        $paymentMethod->bank = ($request->has('bank')) ? $request->bank :  $paymentMethod->bank;
        $paymentMethod->notified = ($request->has('notified')) ? $request->notified :  $paymentMethod->notified;


        $paymentMethod->save();

        return Fractal::includes('user')->item($paymentMethod, new PaymentMethodTransformer);

    }

    public function update(updatePaymentMethodRequest $request, PaymentMethod $paymentMethod){
    	$paymentMethod->provider = ($request->has('provider')) ? $request->provider :  $paymentMethod->provider;
        $paymentMethod->typemethod = ($request->has('typemethod')) ? $request->typemethod :  $paymentMethod->typemethod;
        $paymentMethod->country = ($request->has('country')) ? $request->country :  $paymentMethod->country;
        $paymentMethod->month = ($request->has('month')) ? $request->month :  $paymentMethod->month;
        $paymentMethod->year = ($request->has('year')) ? $request->year :  $paymentMethod->year;
        $paymentMethod->cvv = ($request->has('cvv')) ? $request->cvv :  $paymentMethod->cvv;
        $paymentMethod->cardnumber = ($request->has('cardnumber')) ? $request->cardnumber :  $paymentMethod->cardnumber;
        $paymentMethod->owner = ($request->has('owner')) ? $request->owner :  $paymentMethod->owner;
        $paymentMethod->paypal_email = ($request->has('paypal_email')) ? $request->paypal_email :  $paymentMethod->paypal_email;
        $paymentMethod->bank = ($request->has('bank')) ? $request->bank :  $paymentMethod->bank;
        $paymentMethod->notified = ($request->has('notified')) ? $request->notified :  $paymentMethod->notified;

        $paymentMethod->save();

        return Fractal::includes('user')->item($paymentMethod, new PaymentMethodTransformer);

    }   
}
