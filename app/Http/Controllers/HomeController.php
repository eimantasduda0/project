<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Jobs\Import;
use App\Jobs\ImportProperties;
use App\Jobs\ImportListings;
use App\Jobs\UpdateItems;
use App\Properties;
use App\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use TeamWorx\SoapConnector\SoapConfig;
use TeamWorx\SoapConnector\SoapConnector;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Input::get('items') == 1) {
            $job = (new Import())->delay(5 * 1);
            $this->dispatch($job);
        }
        if (Input::get('properties') == 1) {
            $job = (new ImportProperties())->delay(5 * 1);
            $this->dispatch($job);
        }
        if (Input::get('listings') == 1) {
//            $job = (new ImportListings())->delay(10);
            $job = (new UpdateItems())->delay(10);
            $this->dispatch($job);

        }

        return view('home');
    }

    public function settings()
    {
        if (Input::get('items') == 1) {
            $job = (new Import())->delay(10 * 1);
            $this->dispatch($job);
        }
        if (Input::get('properties') == 1) {
            $job = (new ImportProperties())->delay(10 * 1);
            $this->dispatch($job);
        }
        if (Input::get('listings') == 1) {
            $job = (new ImportListings())->delay(10);
            $this->dispatch($job);
        }
        if (Input::has('user') && Input::has('pass') && Input::has('url')) {
            $user = Settings::firstOrNew(['name'=>'user']);
            $user->value = Input::get('user');
            $user->save();
            $pass = Settings::firstOrNew(['name'=>'pass']);
            $pass->value = Input::get('pass');
            $pass->save();
            $url = Settings::firstOrNew(['name'=>'url']);
            $url->value = Input::get('url');
            $url->save();
        }
        if (Input::has('amazon')){
            $amazon = Settings::firstOrNew(['name'=>'amazon']);
            $amazon->value = Input::get('amazon');
            $amazon->save();
        }
        $data = Settings::all();
        foreach ($data as $item){
            $settings[$item->name] = $item->value;
        }
        $property = Properties::all();
        return view('loged.soap_settings',['settings'=>$settings,'property'=>$property]);
    }
    
    public function import(){
        
        if (Input::get('items') == 1) {
            $job = (new Import())->delay(10 * 1);
            $this->dispatch($job);
        }
        if (Input::get('properties') == 1) {
            $job = (new ImportProperties())->delay(10 * 1);
            $this->dispatch($job);
        }
        if (Input::get('listings') == 1) {
            $job = (new ImportListings())->delay(10);
            $this->dispatch($job);
        }
    }
    
}
