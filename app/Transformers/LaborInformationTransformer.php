<?php

namespace App\Transformers;

use App\LaborInformation;
use League\Fractal;
use League\Fractal\TransformerAbstract;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;


class LaborInformationTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = ['parent', 'workboard'];

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
    public function transform(LaborInformation $LaIn)
    {
        return [

            'id' => $LaIn->id,
            'workplace' => $LaIn->workplace,
            'professionalPosition' => $LaIn->professionalPosition,
            'profInformation' => $LaIn->profInformation,
            'country' => $LaIn->country,
            'state' => $LaIn->state,
            'delegation' => $LaIn->delegation,
            'colony' => $LaIn->colony,
            'street' => $LaIn->street, 
            'streetNumber' => $LaIn->streetNumber,
            'interiorNumber' => $LaIn->interiorNumber,
            'phone' => $LaIn->phone,
            'latitude' => $LaIn->latitude, 
            'longitude' => $LaIn->longitude,
            'postalcode' => $LaIn->postalcode
			
        ];
    }

    public function includeParent(LaborInformation $li){
        return $this->item($li->user, new ProfessionalInformationTransformer);
    }

    public function includeWorkboard(LaborInformation $li){
        return $this->collection($li->workboard, new WorkboardTransformer);
    }
}
