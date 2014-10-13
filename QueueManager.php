<?php
// Require AWS
require 'vendor/autoload.php';

use Aws\Sqs\SqsClient;

class QueueManager{

    protected $sqsClient;

    public function __construct()
    {
        // Set the SQS client
        $this->sqsClient = $this->getSqsClient();
    }

    // Return the SQS client
    public function getSqsClient()
    {
        $clientParams = array('region'  => 'us-east-1');
        $client = SqsClient::factory($clientParams);
        return $client;
    }

}