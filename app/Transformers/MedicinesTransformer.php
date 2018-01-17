<?php

namespace App\Transformers;

use League\Fractal;
use League\Fractal\TransformerAbstract;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use App\medicines;


class MedicinesTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = ['parent_medicine', 'cli_recipes_tests'];

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
    public function transform( medicines $medicine)
    {
        return [

            'id' => $medicine->id,
            'name' => $medicine->name,
            'description' => $medicine->description,
            'code' => $medicine->code,
            'parent' => $medicine->parent
			
        ];
    }

    public function includeParentMedicine(medicines $medicine){
        $test = $medicine->owner;
        if($test != null){
            return $this->item($medicine->owner, new DiagnosticTestsTransformer);
        }
    }

    public function includeCliRecipesTest(medicines $medicine){
        return $this->collection($medicine->cliRecipesTest, new CliRecipesTestsTransformer);
    }
}
