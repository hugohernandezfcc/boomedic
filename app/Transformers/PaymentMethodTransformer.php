<?php

namespace App\Transformers;

use App\PaymentMethod;
use League\Fractal;
use League\Fractal\TransformerAbstract;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;


class PaymentMethodTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = ['user'];

    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = ['transactions'];

    /**
     * Transform object into a generic array
     *
     * @var $resource
     * @return array
     */
    public function transform(PaymentMethod $pm)
    {
        return [

            'id' => $pm->id,
            'provider' => $pm->provider,
            'typemethod' => $pm->typemethod,
            'country' => $pm->country,
            'month' => $pm->month,
            'year' => $pm->year,
            'cvv' => $pm->cvv,
            'cardnumber' => $pm->cardnumber,
            'owner' => $pm->owner,
            'paypal_email' => $pm->paypal_email,
            'bank' => $pm->bank
			
        ];
    }

    public function includeUser(PaymentMethod $pm){
        return $this->item($pm->userApi, new UserTransformer);
    }

    public function includeTransactions(PaymentMethod $pm){
        return $this->collection($pm->transactions, new ArticleTransformer);
    }
}
