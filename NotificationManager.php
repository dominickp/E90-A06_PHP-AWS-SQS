<?php
// Require AWS
require 'vendor/autoload.php';

use Aws\Sns\SnsClient;

class NotificationManager
{

    protected $snsClient;

    public function __construct()
    {
        // Set the SNS client
        $this->snsClient = $this->getSnsClient();
    }

    // Return the SNS client
    public function getSnsClient()
    {
        $clientParams = array('region' => 'us-east-1');
        $client = SnsClient::factory($clientParams);
        return $client;
    }

    // Create an SNS topic
    public function createTopic($name)
    {
        $response = $this->snsClient->createTopic(array(
            'Name' => $name
        ));

        return $response;
    }

    // Subscribe
    public function subscribe($arn, $protocol, $endpoint)
    {
        $subscribeParams = array(
            'TopicArn' => $arn,
            'Protocol' => $protocol,
            'Endpoint' => $endpoint
        );
        $response = $this->snsClient->subscribe($subscribeParams);

        return $response;
    }

    // Confirm subscription
    public function confirmSubscription($arn, $token)
    {
        $confirmParams = array(
            'TopicArn' => $arn,
            'Token' => $token
        );
        $response = $this->snsClient->confirmSubscription($confirmParams);

        return $response;
    }

    // Send a text-based message
    public function publishPlainTextMessage($arn, $message)
    {
        $response = $this->snsClient->publish(array(
            'TopicArn' => $arn,
            'Message' => $message
        ));

        return $response;
    }

}