<?php
/**
 * Created by PhpStorm.
 * User: Nobody
 * Date: 2016-10-10
 * Time: 11:46
 */

namespace App\Http\Controllers;


use App\Item;
use App\Settings;

class ItemController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function itemInfo($id){
        return view('loged.item_info');
    }

    public function items(){
        $data = Item::paginate(15);
        foreach ($data as $item){
            $item->objects = unserialize($item->object);
            $item->price = $item->objects->PriceSet->Price;
        }
        return view('loged.items',['items'=>$data]);
    }

    public function itemSettings($id){
        $data = Item::find($id);
        return view('loged.item_settings',['item'=>$data]);
    }

}