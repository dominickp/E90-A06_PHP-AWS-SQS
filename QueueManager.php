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

    // Create a queue, returns the queue URL
    public function createQueue($queueName)
    {
        $result = $this->sqsClient->createQueue(array('QueueName' => $queueName));
        $queueUrl = $result->get('QueueUrl');
        return $queueUrl;
    }

    // Set attributes of an already created queue. Returns a response Model object
    public function setAttributes($queueUrl, $seconds)
    {
        $result = $this->sqsClient->setQueueAttributes(array(
            'QueueUrl'   => $queueUrl,
            'Attributes' => array(
                'VisibilityTimeout' => $seconds,
            ),
        ));

        return $result;
    }

}