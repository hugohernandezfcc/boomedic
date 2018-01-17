<?php

namespace App\Transformers;

use League\Fractal;
use League\Fractal\TransformerAbstract;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use App\diagnostic_tests;


class DiagnosticTestsTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = ['parent_test'];

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
    public function transform(diagnostic_tests $diagT)
    {
        return [

            'id' => $diagT->id,
            'name' => $diagT->name,
            'description' => $diagT->description,
            'code' => $diagT->code,
            'parent' => $diagT->parent,
			
        ];
    }

    public function includeParentTest(diagnostic_tests $diagT){
        $test = $diagT->owner;
        if($test != null){
            return $this->item($diagT->owner, new DiagnosticTestsTransformer);
        }
        
    }
}
