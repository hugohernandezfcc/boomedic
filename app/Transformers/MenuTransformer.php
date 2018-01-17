<?php

namespace App\Transformers;

use App\menu;
use League\Fractal;
use League\Fractal\TransformerAbstract;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;


class MenuTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = ['parent_menu'];

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
    public function transform(menu $menu)
    {
        return [

            'id' => $menu->id,
            'text' =>$menu->text, 
            'order' =>$menu->order, 
            'label' =>$menu->label, 
            'icon' =>$menu->icon, 
            'label_color' =>$menu->label_color, 
            'url' =>$menu->url, 
            'to' =>$menu->to, 
            'typeitem' =>$menu->typeitem, 
            'parent' =>$menu->parent
			
        ];
    }

    public function includeParentMenu(menu $menu){
        $test = $menu->owner;
        if($test != null){
            return $this->item($menu->owner, new MenuTransformer);
        }
        
    }
}
