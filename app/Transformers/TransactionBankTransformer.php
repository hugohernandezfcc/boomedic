<?php

namespace App\Transformers;

use App\transaction_bank;
use League\Fractal;
use League\Fractal\TransformerAbstract;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;


class TransactionBankTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [];

    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [];

    /**
     * Transform object into a generic array
     *
     * @var $resource
     * @return array
     */
    public function transform(transaction_bank $tb)
    {
        return [

            'id' => $tb->id,
            'receiver' => $tb->receiver,
            'amount' => $tb->amount,
            'paymentmethod' => $tb->paymentmethod,
            'transaction' => $tb->transaction,
            'created_at' => $tb->created_at->format('d M Y'),
            'updated_at' => $tb->updated_at->format('d M Y'),
            'credit_debit' => $tb->credit_debit
			
        ];
    }
}
