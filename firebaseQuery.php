<?php

require __DIR__.'/vendor/autoload.php';

use Kreait\Firebase\Configuration;
use Kreait\Firebase\Firebase;
use Kreait\Firebase\Query;

$config = new Configuration();
$config->setAuthConfigFile(__DIR__.'/gastoxteste-firebase-adminsdk-rqqgr-8c2e07e33b.json');
$firebase = new Firebase('https://gastoxteste.firebaseio.com', $config);
$reference = $firebase->getReference('/gastox/datos/gastos');
$result = $reference->getData();


$query = new Query();
$query
    ->orderByChildKey('fecha')->equalTo('1557028800');

$result = $firebase->gastox->datos->gastos->query($query);
print_r($result)

?>