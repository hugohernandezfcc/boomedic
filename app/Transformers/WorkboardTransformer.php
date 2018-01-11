<?php

namespace App\Transformers;

use App\Workboard;
use League\Fractal;
use League\Fractal\TransformerAbstract;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;


class WorkboardTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = ['parent'];

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
    public function transform(Workboard $wb)
    {
        return [

            'id' => $wb->id,
            'workingDays' => $wb->workingDays, 
            'workingHours' => $wb->workingHours,
            'labInformation' => $wb->labInformation
			
        ];
    }

    public function includeParent(Workboard $wb){
        return $this->item($wb->labInformation, new LaborInformationTransformer);
    }
}
