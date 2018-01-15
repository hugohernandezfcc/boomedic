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
            'labInformation' => $wb->labInformation,
            'created_at' => $wb->created_at->format('d M Y'),
            'updated_at' => $wb->updated_at->format('d M Y'),
			
        ];
    }

    public function includeParent(Workboard $wb){
        return $this->item($wb->labInformation, new LaborInformationTransformer);
    }
}
