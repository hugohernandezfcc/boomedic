<?php

namespace App\Transformers;

use App\professional_information;
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
    protected $availableIncludes = ['parent'];

    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = ['laborInformation'];

    /**
     * Transform object into a generic array
     *
     * @var $resource
     * @return array
     */
    public function transform(professional_information $pi)
    {
        return [
            'specialty'  => $pi->specialty,
            'schoolOfMedicine'  => $pi->schoolOfMedicine,
            'facultyOfSpecialization'  => $pi->facultyOfSpecialization,
            'practiseProfessional'  => $pi->practiseProfessional,
            'user'  => $pi->user,
            'professional_license'  => $pi->professional_license,
            'medical_society' => $pi->medical_society
			
        ];
    }

    public function includeParent(professional_information $pfi){
        return $this->item($pfi->userApi, new UserTransformer);
    }

    public function includeLaborInformation(professional_information $pfi){
        return $this->collection($pfi->laborInfo, new LaborInformationTransformer);
    }
    
}
