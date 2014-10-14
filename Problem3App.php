<?php
/*
 * CSCI-E90 Assignment 06
 * Dominick Peluso 2014
 */

ini_set('max_execution_time', 300); // Increase max exec time, due to sleep()

include('NotificationManager.php');

$nm = new NotificationManager(); // Get NotificationManager object

// Create an SNS topic
$topicResponse = $nm->createTopic("MyCoolTopic3");
$arn = $topicResponse['TopicArn'];
echo "Topic created. ARN: $arn".'<hr>';

// Subscribe a couple of people via email
$subscribe1 = $nm->subscribe($arn, 'email', 'peluso.dominick@gmail.com');
$subscribe2 = $nm->subscribe($arn, 'email', 'dpeluso@g.harvard.edu');

// Get the request IDs
$requestId1 = $subscribe1['ResponseMetadata']['RequestId'];
$requestId2 = $subscribe2['ResponseMetadata']['RequestId'];

// Print subscription request ID
echo "Subscribed user. Request ID: $requestId1".'<hr>';
echo "Subscribed user. Request ID: $requestId2".'<hr>';

// Confirm subscriptions programmatically
    # Wasn't able to get this working, don't want to deal with parsing emails...
#$confirmResponse1 = $nm->confirmSubscription($arn, $requestId1);
#$confirmResponse2 = $nm->confirmSubscription($arn, $requestId2);

// Sleep while I wait to confirm subscriptions
sleep(30);

// Publish a message
$message = 'Example message!!!!';
$publishResponse = $nm->publishPlainTextMessage($arn, $message);
$messageId = $publishResponse['MessageId'];
echo "Message published. ID: $messageId".'<hr>';