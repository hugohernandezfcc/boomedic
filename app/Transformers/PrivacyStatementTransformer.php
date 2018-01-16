<?php

namespace App\Transformers;

use App\privacy_statement;
use League\Fractal;
use League\Fractal\TransformerAbstract;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;


class PrivacyStatementTransformer extends TransformerAbstract
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
    public function transform(privacy_statement $ps)
    {
        return [

            'id' => $ps->id,
            'description' => $ps->description,
            'created_at' => $ps->created_at,
            'updated_at' => $ps->updated_at
			
        ];
    }
}
