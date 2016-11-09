<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\Listings;
use App\Settings;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use TeamWorx\SoapConnector\SoapConfig;
use TeamWorx\SoapConnector\SoapConnector;

class UpdateListings extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    private $user;
    private $password;
    private $url;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {

        $user = Settings::getOne('user');
        $password = Settings::getOne('pass');
        $url = Settings::getOne('url');
        $this->url = $url;
        $this->user = $user;
        $this->password = $password; //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //

        Listings::where('update','=',1)->chunk(50, function ($listings){
            $config = new SoapConfig($this->user,$this->password,$this->url);
//            Log::debug($this->url."|".$this->user."|".$this->password);
            $connector = new SoapConnector($config);
            $client = $connector->_getInstance();
//            Log::debug(print_r($items[0],true));
            $data = array();
            $ids = array();
            foreach ($listings as $listing) {
                $item = (double)12.99;
                $json = json_decode($listing->offer_data);
                if ($json['type'] == 'percent') {
                    $price = $item*((100-$json['value'])/100);
                }
                $data['MarketListings'][] = [
                    'Lang'=>'De',
                    'ListingId'=> $listing->system_id,
                    'MarketListingEbay'=>[
                        'BestOffer'=> ($listing->offer == 1)? true : false,
                        'AcceptMinPreis'=> $price
                    ]
                ];
                $ids[] = $listing->id;
            }
            $client->SetMarketListings();

            Listings::whereIn('id',$ids)->update(['update'=>0]);
        });


    }
}
