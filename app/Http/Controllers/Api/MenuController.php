<?php

namespace App\Http\Controllers\Api;

use App\menu;
use App\Transformers\MenuTransformer;
//use App\Http\Requests\Api\Menu\storeMenuRequest;
//use App\Http\Requests\Api\Menu\updateMenuRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cyvelnet\Laravel5Fractal\Facades\Fractal;

class MenuController extends Controller
{
    public function index(){
    	$menu = menu::all();
    	return Fractal::includes('parent_menu')->collection($menu, new MenuTransformer);
    }

    public function show(menu $menu){
    	return Fractal::includes('parent_menu')->item($menu, new MenuTransformer);

    }

    /*public function store(storeMenuRequest $request){
    	$menu = new menu;

    	$menu->text = $request->text;
    	$menu->order = $request->order;
    	$menu->label = $request->label;
    	$menu->icon = $request->icon;
    	$menu->label_color = $request->label_color;
    	$menu->url = $request->url;
    	$menu->to = $request->to;
    	$menu->typeitem = $request->typeitem;

    	$menu->parent = ($request->has('parent')) ? $request->parent : $menu->parent;

    	$menu->save();

    	return Fractal::includes('parent_menu')->item($menu, new MenuTransformer);

    }

    public function update(updateMenuRequest $request, menu $menu){
    	$menu->text = ($request->has('text')) ? $request->text : $menu->text;
    	$menu->order = ($request->has('order')) ? $request->order : $menu->order;
    	$menu->label = ($request->has('label')) ? $request->label : $menu->label;
    	$menu->icon = ($request->has('icon')) ? $request->icon : $menu->icon;
    	$menu->label_color = ($request->has('label_color')) ? $request->label_color : $menu->label_color;
    	$menu->url = ($request->has('url')) ? $request->url : $menu->url;
    	$menu->to = ($request->has('to')) ? $request->to : $menu->to;
    	$menu->typeitem = ($request->has('typeitem')) ? $request->typeitem : $menu->typeitem;

    	$menu->parent = ($request->has('parent')) ? $request->parent : $menu->parent;

    	$menu->save();

    	return Fractal::includes('parent_menu')->item($menu, new MenuTransformer);
    }*/
}
