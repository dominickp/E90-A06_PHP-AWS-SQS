<?php
/*
 * CSCI-E90 Assignment 06
 * Dominick Peluso 2014
 */

include('QueueManager.php');


$qm = new QueueManager(); // Get the QueueManager

// Make a queue
#$queueUrl = $qm->createQueue('test-queue2');
#echo 'The Queue URL returned is '.$queueUrl;
$queueUrl = 'https://sqs.us-east-1.amazonaws.com/330312668718/test-queue';
$response = $qm->setAttributes($queueUrl, 20); // Set visibility timeout to 20 seconds

// Make a dummy message
$myMessage = 'This is an example message - '.date('l \t\h\e jS');

// Send the message to the queue
$response = $qm->sendMessage($queueUrl, $myMessage);
echo 'The Message ID returned is '.$response['MessageId'];

print_r($response);