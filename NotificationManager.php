<?php
// Require AWS
require 'vendor/autoload.php';

use Aws\Sns\SnsClient;

class NotificationManager
{

    protected $snsClient;

    public function __construct()
    {
        // Set the SQS client
        $this->snsClient = $this->getSqsClient();
    }

    // Return the SQS client
    public function getSqsClient()
    {
        $clientParams = array('region' => 'us-east-1');
        $client = SnsClient::factory($clientParams);
        return $client;
    }
}