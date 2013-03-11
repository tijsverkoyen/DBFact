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
//    $response = $dbFact->getAppendicesGezipt($sessionId, null, array('P:\MARKETING\PRODUCTINFO\HARMAN KARDON\TECHNISCHE FICHES\SPECIFICATION SHEET - GO + PLAY II (DUTCH).PDF'));
//    $response = $dbFact->getAppendicesGezipt($sessionId, array('10573'));
//    $response = $dbFact->keepAlive($sessionId);
//    $files = array(
//        array(
//            'File' => file_get_contents('./../temp/temp.xml'),
//            'FileName' => 'foo.xml',
//        ),
//    );
//	$response = $dbFact->receiveFile($files);
} catch (Exception $e) {
    var_dump($e);
}

// output
var_dump($response);
