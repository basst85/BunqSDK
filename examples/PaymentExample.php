<?php
/**
 * This example shows how to make a payment, for this, the user and monetary-account need to be retrieved first.
 */

require './BunqSDK/vendor/autoload.php';

use Bunq\BunqSession;
use Bunq\Payments\Payment;
use Bunq\Setup\SessionServer;
use Bunq\User\User;
use Bunq\MonetaryAccounts\MonetaryAccount;

$clientPrivateKey = 'YOUR PRIVATE KEY HERE';
$clientPublicKey = 'YOUR PUBLIC KEY HERE';
$secret = 'YOUR BUNQ API KEY HERE';

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

//Retrieve the Installation and DeviceServer from the files and store them in the BunqSession object.
$session->setInstallation(unserialize(file_get_contents("BunqObjects/Installation")));
$session->setDeviceServer(unserialize(file_get_contents("BunqObjects/DeviceServer")));

//Create a SessionServer object.
$sessionServer = new SessionServer('session-server');
$sessionServer->setSecret($secret);

//Make the SessionServer call on the server.
$session->createSessionServer($sessionServer);

/**
 * Below this line any API call can be made.
 * ---------------------------------------------------------------------------------------------------------------------
 */

//Create and send the User object.
$user = new User('user');
$session->get($user);

//Extract the userId.
$userId = $user->getUserCompany()->id;

echo "UserId: " . $userId . PHP_EOL;

//Create and send the MonetaryAccount object.
$monetaryAccount = new MonetaryAccount('user/' . $userId . '/Monetary-account');
$session->get($monetaryAccount);

//Extract the MonetaryAccountId.
$monetaryAccountId = $monetaryAccount->getMonetaryAccountBank()->balance->id;

echo "Monetary-account ID: " . $monetaryAccountId . PHP_EOL;

//Create a new Payment object.
$payment = new Payment('user/' . $userId . '/monetary-account/' . $monetaryAccountId . '/payment');

//Add the data to the object.
$payment->setAmountValue('13.37');
$payment->setAmountCurrency('EUR');
$payment->setCounterPartyAliasType('EMAIL');
$payment->setCounterPartyAliasValue('info@jellevanhengel.com');
$payment->setDescription('Gin Tonics! <3');

//Make the post call.
$session->post($payment);

//Extract the paymentId.
$paymentId = $payment->getId()->id;

echo "Payment succesfull, paymentID: " . $paymentId . PHP_EOL;
