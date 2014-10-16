<?php
/*
 * CSCI-E90 Assignment 06
 * Dominick Peluso 2014
 */

include('QueueManager.php');

ini_set('max_execution_time', 300); // Increase max exec time, due to sleep()

$qm = new QueueManager(); // Get the QueueManager

// Make a queue
$queueUrl = $qm->createQueue('test-queue23');
echo 'The Queue URL returned is '.$queueUrl.'<hr>';
#$queueUrl = 'https://sqs.us-east-1.amazonaws.com/330312668718/test-queue';
$response = $qm->setAttributes($queueUrl, 20); // Set visibility timeout to 20 seconds

// Make a dummy message
$myMessage = 'This is an example message - '.date('l \t\h\e jS h:i:s A');

// Send the message to the queue
$response = $qm->sendMessage($queueUrl, $myMessage);
echo "The message '$myMessage' was sent and given ID ".$response['MessageId'].'<hr>';

// Receive messages
$messageResponse = $qm->receiveMessage($queueUrl);
echo "Message received: ".$messageResponse['Body'].'<hr>';

// Delete message
$deleteResult = $qm->deleteMessage($queueUrl, $messageResponse['ReceiptHandle']);
echo 'Message deleted'.'<hr>';

// Do it again but don't delete this one
$myMessage2 = 'Here is another one which I will not delete';
$response2 = $qm->sendMessage($queueUrl, $myMessage2);
echo "The message '$myMessage2' was sent and given ID ".$response['MessageId'].'<hr>';
$messageResponse2 = $qm->receiveMessage($queueUrl);
echo "Message received: ".$messageResponse2['Body'].'<hr>';

// Sleep for 30 seconds
sleep(30);
echo 'SLEPT 30 SECONDS'.'<hr>';

// Try to get new messages. The one not deleted should still be there.
$messageResponse = $qm->receiveMessage($queueUrl);
echo "Message received: ".$messageResponse['Body'].'<hr>';

// Add two more messages
$response3 = $qm->sendMessage($queueUrl, 'Another message');
$response4 = $qm->sendMessage($queueUrl, 'One more...');

// Get queue attributes
$attributes = $qm->getAllAttributes($queueUrl);
echo 'Queue attributes print:'.'<hr>';
echo '<pre>'.var_dump($attributes).'</pre>';

// Delete the queue
$qm->deleteQueue($queueUrl);
echo 'Queue deleted!';