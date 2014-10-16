<?php
/*
 * CSCI-E90 Assignment 06
 * Dominick Peluso 2014
 */

ini_set('max_execution_time', 300); // Increase max exec time, due to sleep()

// Require AWS
require 'vendor/autoload.php';

use Aws\Sqs\SqsClient;

$client = SqsClient::factory(array(
    'region'  => 'us-east-1',
    'request.options' => array(
        'proxy' => '127.0.0.1:8088'
    ),
    'scheme' => 'http'
));

// Create
$result = $client->createQueue(array('QueueName' => 'my-queue'));
$queueUrl = $result->get('QueueUrl');

// Delete
$result = $client->deleteQueue(array(
    'QueueUrl' => $queueUrl,
));
