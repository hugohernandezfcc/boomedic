<?php

namespace App\Transformers;

use App\SupporTicket;
use League\Fractal;
use League\Fractal\TransformerAbstract;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;


class SupportTicketTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = ['user_data'];

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
    public function transform(SupporTicket $st)
    {
        return [

            'id' => $st->id,
            'user' => $st->user,
            'email' => $st->email,
            'userType' => $st->userType,
            'ticketDescription' => $st->ticketDescription,
            'userId' => $st->userId,
            'status' => $st->status, 
            'subject' => $st->subject
			
        ];
    }

    public function includeUser(SupporTicket $st){
        return $this->item($st->userApi, new UserTransformer);
    }
}
