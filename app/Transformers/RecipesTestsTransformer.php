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
    protected $availableIncludes = ['doctor_data', 'patient_data'];

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
            'type' => $recipe->type,
            'doctor' => $recipe->doctor,
            'patient' => $recipe->patient,
            'notes' => $recipe->notes,
            'folio' => $recipe->folio,
            'date' => $recipe->date,
			
        ];
    }

    public function includeDoctorData(recipes_tests $recipe){
        return $this->item($recipe->apiDoctor, new UserTransformer);
    }

    public function includePatientData(recipes_tests $recipe){
        return $this->item($recipe->apiPatient, new UserTransformer);
    }
}
