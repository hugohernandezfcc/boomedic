<?php

namespace App\Transformers;

use League\Fractal;
use League\Fractal\TransformerAbstract;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use App\history_session;


class HistorySessionTransformer extends TransformerAbstract
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
    public function transform(history_session $hs)
    {
        return [

            'id' => $hs->id,
            'browser' => $hs->browser,
            'dateIn' => $hs->dateIn,
            'status' => $hs->status,
            'dateOut' => $hs->dateOut,
            'createdBy' => $hs->createdBy
    			
        ];
    }
}
