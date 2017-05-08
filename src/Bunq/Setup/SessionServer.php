<?php

namespace Bunq\Setup;

include_once('Client/BunqClient.php');
include_once('Client/BunqRequest.php');
include_once('Client/BunqResponse.php');
include_once('Exceptions/BunqObjectException.php');
include_once('Exceptions/BunqVerificationException.php');
include_once('Setup/Installation.php');
include_once('Setup/DeviceServer.php');

use Bunq\Client\BunqClient;
use Bunq\Client\BunqRequest;
use Bunq\Client\BunqResponse;
use Bunq\Exceptions\BunqObjectException;
use Bunq\Exceptions\BunqVerificationException;
use Bunq\Setup\Installation;
use Bunq\Setup\DeviceServer;

/**
 * Class SessionServer
 * Class for the session-server endpoint.
 * Used to create installations, device servers and sessions.
 * The session created here will be used in future API-calls.
 * @package Bunq\Setup
 */
class SessionServer
{

}