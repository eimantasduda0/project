<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\Settings;
use App\Properties;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use TeamWorx\SoapConnector\SoapConfig;
use TeamWorx\SoapConnector\SoapConnector;

class ImportProperties extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $user = Settings::getOne('user');
        $password = Settings::getOne('pass');
        $url = Settings::getOne('url');
        $config = new SoapConfig($user,$password,$url);
        $connector = new SoapConnector($config);
        $client = $connector->_getInstance();
        
        $data = $client->GetPropertiesList();
        
        foreach($data->PropertyGroups->item as $item){
            Log::debug(print_r($item,true));
            foreach($item->Properties->item as $sub_item){
                $new = new Properties();
                $new->name = $sub_item->PropertyName;
                $new->group = $item->PropertyGroupName;
                $new->group_id = $item->PropertyGroupID;
                $new->system_id = $sub_item->PropertyID;
                $new->save();
            }
        }
    }
}
