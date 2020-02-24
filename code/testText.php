<?php

require __DIR__ . '/twilio/twilio-php/src/Twilio/autoload.php';

use Twilio\Rest\Client;

$sid = 'ACf08eb7445f5c0fb48082d49105535856';
$token = '71327d177f61437fe229e9df6715c39b';
$client = new Client($sid, $token);

$client->messages->create(
	'+19054830213',
	array(
		'from' => '+16475600859',
		'body' => "Testing messages"
	)
);

?>
