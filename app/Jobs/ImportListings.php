<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\Settings;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use TeamWorx\SoapConnector\SoapConfig;
use TeamWorx\SoapConnector\SoapConnector;

class ImportListings extends Job implements ShouldQueue
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
        $user = Settings::getOne('user');
        $password = Settings::getOne('pass');
        $url = Settings::getOne('url');
        $config = new SoapConfig($user,$password,$url);
        $connector = new SoapConnector($config);
        $client = $connector->_getInstance();

//        $data = $client->GetListingsTemplates();
//        $data = $client->GetListings(['CallItemsLimit'=>50,'Page'=>0,'GetListings'=>(object)['ListingStatus'=>'active']]);
        $data = $client->GetListings(['GetListings'=>['ListingStatus'=>'active']]);

        Log::debug(print_r($data,true));

    }
}
