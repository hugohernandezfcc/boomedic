<?php

namespace App\Http\Controllers\Api;

use App\transaction_bank;
use App\Transformers\TransactionBankTransformer;
use App\Http\Requests\Api\TransactionBank\storeTransactionBankRequest;
use App\Http\Requests\Api\TransactionBank\updateTransactionBankRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cyvelnet\Laravel5Fractal\Facades\Fractal;

class transactionBankController extends Controller
{
    public function index(){
    	$transactionBank = transaction_bank::all();
    	return Fractal::collection($transactionBank, new TransactionBankTransformer);
    }

    public function show(transaction_bank $transactionBank){
    	return Fractal::item($transactionBank, new TransactionBankTransformer);

    }

    public function store(storeTransactionBankRequest $request){
    	$transactionBank = new transaction_bank;

    	$transactionBank->receiver = $request->receiver;
        $transactionBank->amount = $request->amount; 
        $transactionBank->paymentmethod = $request->paymentmethod;
        $transactionBank->transaction = $request->transaction;
        $transactionBank->credit_debit = $request->credit_debit;

        $transactionBank->save();

        return Fractal::item($transactionBank, new TransactionBankTransformer);

    }

    public function update(updateTransactionBankRequest $request, transaction_bank $transactionBank){
    	$transactionBank->receiver = ($request->has('receiver')) ? $request->receiver :  $transactionBank->receiver;
        $transactionBank->amount = ($request->has('amount')) ? $request->amount :  $transactionBank->amount;
        $transactionBank->paymentmethod = ($request->has('paymentmethod')) ? $request->paymentmethod :  $transactionBank->paymentmethod;
        $transactionBank->transaction = ($request->has('transaction')) ? $request->transaction :  $transactionBank->transaction;
        $transactionBank->credit_debit = ($request->has('credit_debit')) ? $request->credit_debit :  $transactionBank->credit_debit;

        $transactionBank->save();

        return Fractal::item($transactionBank, new TransactionBankTransformer);

    }
}
