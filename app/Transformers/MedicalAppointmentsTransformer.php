<?php

namespace App\Transformers;

use App\medical_appointments;
use League\Fractal;
use League\Fractal\TransformerAbstract;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;


class MedicalAppointmentsTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = ['owner', 'doctor'];

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
    public function transform(medical_appointments $mA)
    {
        return [

            'id' => $mA->id,
            'user' => $mA->user,
            'user_doctor' => $mA->user_doctor,
            'latitude' => $mA->latitude,
            'longitude' => $mA->longitude,
            'when' => $mA->when,
            'status' => $mA->status
			
        ];
    }

    public function includeOwner(medical_appointments $mA){
        return $this->item($mA->owner, new UserTransformer);
    }

    public function includeDoctor(medical_appointments $mA){
        return $this->item($mA->doctor, new UserTransformer);
    }
}
