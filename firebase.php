<?php

require __DIR__.'/vendor/autoload.php';

use Kreait\Firebase\Configuration;
use Kreait\Firebase\Firebase;

$config = new Configuration();
$config->setAuthConfigFile(__DIR__.'/gastoxteste-firebase-adminsdk-rqqgr-8c2e07e33b.json');
$firebase = new Firebase('https://gastoxteste.firebaseio.com', $config);
$reference = $firebase->getReference('/gastox/datos/gastos');
$result = $reference->getData();

?>