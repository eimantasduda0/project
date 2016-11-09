<?php

namespace App\Jobs;

use App\Item;
use App\Jobs\Job;
use App\Settings;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use TeamWorx\SoapConnector\SoapConfig;
use TeamWorx\SoapConnector\SoapConnector;

class UpdateItems extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    private $user,$password,$url;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //

        $user = Settings::getOne('user');
        $password = Settings::getOne('pass');
        $url = Settings::getOne('url');
        $this->url = $url;
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {


        Item::where('update','=',1)->chunk(50, function ($items){
            $config = new SoapConfig($this->user,$this->password,$this->url);
//            Log::debug($this->url."|".$this->user."|".$this->password);
            $connector = new SoapConnector($config);
            $client = $connector->_getInstance();
//            Log::debug(print_r($items[0],true));
            $data = array();
            $ids = array();
            foreach ($items as $item){
                $data['PropertyToItemList'][] = [
                    'ItemId'=>$item->system_id,
                    'Lang'=>'De',
                    'PropertyId'=>568,
                    'PropertyItemValue'=>'text'
                ];
                $ids[] = $item->id;
            }
//            Log::debug(print_r($data,true));
            $client->SetPropertiesToItem($data);
            Item::whereIn('id',$ids)->update(['update'=>0]);
        });

    }
}
