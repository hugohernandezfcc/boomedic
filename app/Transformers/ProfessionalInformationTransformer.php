<?php

namespace App\Transformers;

use App\ProfessionalInformation;
use League\Fractal;
use League\Fractal\TransformerAbstract;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;


class ProfessionalInformationTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = ['parent', 'laborInfo'];

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
    public function transform(ProfessionalInformation $pi)
    {
        return [
            'specialty'  => $pi->specialty,
            'schoolOfMedicine'  => $pi->schoolOfMedicine,
            'facultyOfSpecialization'  => $pi->facultyOfSpecialization,
            'practiseProfessional'  => $pi->practiseProfessional,
            'user'  => $pi->user,
            'professional_license'  => $pi->professional_license
			
        ];
    }

    public function includeParent(ProfessionalInformation $pfi){
        return $this->item($pfi->user, new UserTransformer);
    }

    public function includeLaborInfo(ProfessionalInformation $pfi){
        return $this->collection($pfi->laborInfo, new LaborInformationTransformer);
    }
    
}
