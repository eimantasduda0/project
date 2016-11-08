<?php

namespace App\Jobs;

use App\Item;
use App\Jobs\Job;
use App\Settings;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use TeamWorx\SoapConnector\SoapConfig;
use TeamWorx\SoapConnector\SoapConnector;

class Import extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    private $page = 0;

    /**
     * Create a new job instance.
     *
     * @param int $page
     */
    public function __construct($page = 0)
    {
        $this->page = $page;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user = Settings::getOne('user');
        $password = Settings::getOne('pass');
        $url = Settings::getOne('url');
        $config = new SoapConfig($user,$password,$url);
        $connector = new SoapConnector($config);
        $client = $connector->_getInstance();

        // if ($this->page == 0){
        //     $data = $client->GetItemsBase(['Page'=>$this->page,'Lang'=>'de','GetAttributeValueSets'=>true,'GetItemProperties'=>true]);
        // }else{
            $data = $client->GetItemsBase(['Page'=>$this->page,'Lang'=>'de','GetAttributeValueSets'=>true,'GetItemProperties'=>true]);
        // }

//      Log::debug(print_r($data,true));

        if (($data->Pages > 1 && $this->page == 0)){
            for ($i=1;$i<=$data->Pages;$i++){
                $job = (new Import($i))->delay(5);
                dispatch($job);
                Log::debug("Import page: ".$i);
            }
                Log::debug("Import data: ". print_r($data,true));
        }

        if (count($data->ItemsBase) > 0) {
            foreach ($data->ItemsBase->item as $item) {
                $new = new Item();
                $new->name = $item->Texts->Name;
                $new->system_id = $item->ItemID;
                $new->price = $item->PriceSet->Price;
                $new->object = serialize($item);
                $new->saveOrFail();
            }
        }
    }

}
