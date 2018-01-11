<?php

namespace App\Transformers;

use League\Fractal;
use League\Fractal\TransformerAbstract;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use App\recipes_tests;


class RecipesTestsTransformer extends TransformerAbstract
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
    public function transform(recipes_tests $recipe)
    {
        return [

            'id' => $recipe->id,
            'type' => $recipe->id,
            'doctor' => $recipe->id,
            'patient' => $recipe->id,
            'notes' => $recipe->id,
            'folio' => $recipe->id,
            'date' => $recipe->id,
			
        ];
    }
}
