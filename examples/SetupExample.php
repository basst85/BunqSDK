<?php

/**
 * This example shows how to setup a new Installation, and device server.
 */

require './BunqSDK/vendor/autoload.php';

use Bunq\BunqSession;
use Bunq\Setup\Installation;
use Bunq\Setup\DeviceServer;

$clientPrivateKey = 'YOUR PRIVATE KEY HERE';
$clientPublicKey = 'YOUR PUBLIC KEY HERE';
$secret = 'YOUR BUNQ API KEY HERE';
$description = 'Epic bunq SDK';

$defaultHeaders = [
    'Cache-Control' => 'no-cache',
    'User-Agent' => 'SandboxPublicApi:DefaultUser',
    'X-Bunq-Geolocation' => '0 0 0 0 000',
    'X-Bunq-Language' => 'en_US',
    'X-Bunq-Region' => 'en_US',
];


/**
 * You should not have to change anything below this line.
 * ---------------------------------------------------------------------------------------------------------------------
 */

//Create a new BunqSession.
$session = new BunqSession($clientPrivateKey, $defaultHeaders);

//Create the Installation object and add the needed data.
$installation = new Installation('installation');
$installation->setClientPublicKey($clientPublicKey);

//Create the DeviceServer object and add the needed data.
$deviceServer = new DeviceServer('device-server');
$deviceServer->setDescription($description);
$deviceServer->setSecret($secret);

//Make the Installation and DeviceServer calls on the server.
$session->createInstallation($installation);
$session->createDeviceServer($deviceServer);

//Write the responses to files for future use.
file_put_contents("BunqObjects/Installation", (serialize($installation)));
file_put_contents("BunqObjects/DeviceServer", (serialize($deviceServer)));