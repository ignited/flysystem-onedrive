<?php

namespace Ignited\Flysystem\OneDrive;

use GuzzleHttp\Client;
use GuzzleHttp\Subscriber\Log\LogSubscriber;
use GuzzleHttp\Subscriber\Log\Formatter;

class OneDriveClient extends Client
{
    protected $baseUrl;

    public static function factory($config = array(), $logger=null)
    {
    	$client = new Client(['base_url' => $config['base_url'].'/']);

    	$client->setDefaultOption('headers', array('Authorization' => 'Bearer '.$config['access_token']));
        $client->setDefaultOption('config', ['curl' => [CURLOPT_SSLVERSION => 1]]);

        if($logger !== null)
        {
        	$subscriber = new LogSubscriber($logger, ">>>>>>>>\n{request}\n<<<<<<<<\n{response}");

        	$client->getEmitter()->attach($subscriber);
        }

        return $client;
    }
}