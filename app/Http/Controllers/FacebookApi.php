<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Campaigns;
use FacebookAds\Object\AdAccount;
use FacebookAds\Object\AdsInsights;
use FacebookAds\Api;
use FacebookAds\Logger\CurlLogger;
//define('SDK_DIR',  '/facebook/php-ads-sdk'); // Path to the SDK directory

//require '/Users/admin/Desktop/facebook larvel/worktestfacebook/vendor/autoload.php';

// require '/vendor/autoload.php';

class FacebookApi extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

//  function will show the this will show the campaign_id
    public function campaign (Campaigns  $campaign)
    {

        $Adid = $campaign->ad_id;



        $ad_id = "23842620178120418";
        $campaign_id = $Adid;
        $app_id = "266019973906156";
        $access_token = 'EAADx8ZAoMPuwBAEN6zEMzm2SEGrewgFWllMX9PJTHy6ZBxzmHvAvDkxHkLUwDflpkztIZAZAruWzG2A4edwg4Fru40SlP4gZC1iDZAB1NumtfUcE9xmsdkRGNAmK0mDESZCCdQu7a6Erpik8WsK44sYM6vWt4Dn4kd1WYhtyLGWhS87LeOmgfH18cnYCCPo5xUZD';
        $ad_account_id = 'act_746430005546805';
        $app_secret = '6636b08694496ee3956d16864fca3446';
        require '/Users/admin/Desktop/facebook larvel/worktestfacebook/vendor/autoload.php';


        if (is_null($access_token) || is_null($app_id) || is_null($app_secret)) {
            throw new \Exception(
                'You must set your access token, app id and app secret before executing'
            );
        }

        if (is_null($ad_account_id)) {
            throw new \Exception(
                'You must set your account id before executing');
        }


        Api::init($app_id, $app_secret, $access_token);
//        $logger = new CurlLogger();

        Api::instance();
//            ->setLogger($logger);
//
//        $api->setLogger(new CurlLogger());

        $fields = array(
            'account_id',
            'account_name',
            'campaign_id',
            'campaign_name',
            'ad_name',
            'clicks',
            'cost_per_action_type',
            'ctr',
            'cpm',
            'cpp',
            'actions',
            'reach',
            'cost_per_total_action',
            'impressions',
            'spend',
        );
        $params = array(
            'level' => 'ad',
            'filtering' => array(),
            'breakdowns' => array(),
            'date_preset' => 'lifetime'
//  'time_range' => array('since' => '2017-08-21','until' => '2017-09-20'),
        );

//        this will call the campaign_id, if i changed the value to $ad_account_id it will show the total for that whole ad account
//        if i change the value to $ad_id will show for that ad. i think ad_id and campaign_id will show the same info

        $jsonResponse = json_encode((new AdAccount($campaign_id))->getInsights(
            $fields,
            $params
        )->getResponse()->getContent(), JSON_PRETTY_PRINT);

//        dd(gettype ( $jsonResponse ));
        $arrayResponse = json_decode($jsonResponse);

//        dd($arrayResponse);


        return view('facebookcampaign', compact('arrayResponse'));

    }


//  function will show the this will show the campaign_id
    public function adaccountid(Campaigns  $campaign)
    {

        $Adid = $campaign->ad_id;

        $ad_id = "23842620178120418";
        $campaign_id = "23842620178120418";
        $app_id = "266019973906156";
        $access_token = 'EAADx8ZAoMPuwBAEN6zEMzm2SEGrewgFWllMX9PJTHy6ZBxzmHvAvDkxHkLUwDflpkztIZAZAruWzG2A4edwg4Fru40SlP4gZC1iDZAB1NumtfUcE9xmsdkRGNAmK0mDESZCCdQu7a6Erpik8WsK44sYM6vWt4Dn4kd1WYhtyLGWhS87LeOmgfH18cnYCCPo5xUZD';
        $ad_account_id = 'act_746430005546805';
        $app_secret = '6636b08694496ee3956d16864fca3446';
        require '/Users/admin/Desktop/facebook larvel/worktestfacebook/vendor/autoload.php';


        if (is_null($access_token) || is_null($app_id) || is_null($app_secret)) {
            throw new \Exception(
                'You must set your access token, app id and app secret before executing'
            );
        }

        if (is_null($ad_account_id)) {
            throw new \Exception(
                'You must set your account id before executing');
        }


        Api::init($app_id, $app_secret, $access_token);
//        $logger = new CurlLogger();

        Api::instance();
//            ->setLogger($logger);
//
//        $api->setLogger(new CurlLogger());

        $fields = array(
            'account_id',
            'account_name',
            'campaign_id',
            'campaign_name',
            'ad_name',
            'clicks',
            'cost_per_action_type',
            'ctr',
            'cpm',
            'cpp',
            'actions',
            'reach',
            'cost_per_total_action',
            'impressions',
            'spend',
        );
        $params = array(
            'level' => 'ad',
            'filtering' => array(),
            'breakdowns' => array(),
            'date_preset' => 'lifetime'
//  'time_range' => array('since' => '2017-08-21','until' => '2017-09-20'),
        );

//        this will call the campaign_id, if i changed the value to $ad_account_id it will show the total for that whole ad account
//        if i change the value to $ad_id will show for that ad. i think ad_id and campaign_id will show the same info

        $jsonResponse = json_encode((new AdAccount($ad_account_id))->getInsights(
            $fields,
            $params
        )->getResponse()->getContent(), JSON_PRETTY_PRINT);

//        dd(gettype ( $jsonResponse ));
        $arrayResponse = json_decode($jsonResponse);
//
        dd($arrayResponse);
//

        return view('facebook', compact('arrayResponse'));

    }

}
