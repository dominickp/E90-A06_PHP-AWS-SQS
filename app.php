<?php
/*
 * CSCI-E90 Assignment 06
 * Dominick Peluso 2014
 */

include('QueueManager.php');

$qm = new QueueManager();
echo $qm->getSqsClient();