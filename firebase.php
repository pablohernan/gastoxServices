<?php

require __DIR__.'/vendor/autoload.php';

use Kreait\Firebase\Configuration;
use Kreait\Firebase\Firebase;

$config = new Configuration();
$config->setAuthConfigFile(__DIR__.'/db_bkp/gastox-36265-firebase-adminsdk-2l29o-2171cc940f.json');
$firebase = new Firebase('https://gastox-36265.firebaseio.com', $config);
$reference = $firebase->getReference('/gastox/datos/gastos');
$result = $reference->getData();

?>