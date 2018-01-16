<?php

namespace App\Transformers;

use League\Fractal;
use League\Fractal\TransformerAbstract;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use App\diagnostics;


class DiagnosticsTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = ['parent_diagnostic'];

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
    public function transform(diagnostics $diag)
    {
        return [

            'id' => $diag->id,
			'name' => $diag->name,
            'description' => $diag->description,
            'code' => $diag->code,
            'parent' => $diag->parent,
        ];
    }

    public function includeParentDiagnostic(diagnostics $diag){
        $test = $diag->owner;
        if($test != null){
            return $this->item($diag->owner, new DiagnosticsTransformer);
        }
        
    }
}
