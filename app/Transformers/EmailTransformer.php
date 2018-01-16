<?php

namespace App\Transformers;

use League\Fractal;
use League\Fractal\TransformerAbstract;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use App\Email;


class EmailTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = ['owner'];

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
    public function transform(Email $email)
    {
        return [

            'id' => $email->id,
            'userId' => $email->userId,
            'email' => $email->email,
            'date' => $email->date,
            'sender' => $email->sender,
            'recipient' => $email->recipient,
            'subject' => $email->subject,
            'message' => $email->message,
            'parent' => $email->parent
			
        ];
    }

    public function includeOwner(Email $email){
        return $this->item($email->owner, new UserTransformer);
    }
}
