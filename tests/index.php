<?php

//require
require_once '../../../autoload.php';
require_once 'config.php';

use \TijsVerkoyen\DBFact\DBFact;

// create instance
$dbFact = new DBFact(WSDL);
$response = $dbFact->login(LOGIN, PASSWORD);
$sessionId = $response->SessionId;

try {
//    $response = $dbFact->showAllVersions();
//    $response = $dbFact->showFilePath();
//    $response = $dbFact->showLocalPath();
//    $response = $dbFact->showVersion();
//    $response = $dbFact->login(LOGIN, PASSWORD);
//    $response = $dbFact->artExport($sessionId, EXTRA_PASSWORD, '');
//    $response = $dbFact->getArtImage($sessionId, array(119, 120));
//    $response = $dbFact->getMultipleArtInfo($sessionId, array(2, 3), 1);
//    $response = $dbFact->getAppendices($sessionId, array(10583, 10574));
} catch (Exception $e) {
    var_dump($e);
}

// output
var_dump($response);
