<?php

namespace App\Transformers;

use League\Fractal;
use League\Fractal\TransformerAbstract;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use App\cli_recipes_tests;


class CliRecipesTestsTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = ['recipe_test_data', 'medicine_data', 'diagnostic_test_data'];

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
    public function transform(cli_recipes_tests $crt)
    {
        return [

            'id' => $crt->id,
            'medicine' => $crt->medicine,
            'test' => $crt->test,
            'recipe_test' => $crt->recipe_test
			
        ];
    }

    public function includeRecipeTestData(cli_recipes_tests $crt){
        dd($crt->apiRecipesTest);
        return $this->item($crt->apiRecipesTest, new RecipesTestsTransformer);
    }

    public function includeMedicineData(cli_recipes_tests $crt){
        return $this->item($crt->apiMedicine, new MedicinesTransformer);
    }

    public function includeDiagnosticTestData(cli_recipes_tests $crt){
        return $this->item($crt->apiDiagnostic, new DiagnosticTestsTransformer);
    }
}
