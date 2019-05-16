<?php

require __DIR__.'/vendor/autoload.php';

use Kreait\Firebase\Configuration;
use Kreait\Firebase\Firebase;

$config = new Configuration();
/*
https://firebase-php.readthedocs.io/en/1.2.2/overview.html

para pegar o gastoxteste-firebase-adminsdk-rqqgr-8c2e07e33b.json com as configuracoes
https://firebase.google.com/docs/admin/setup#add_firebase_to_your_app

*/
$config->setAuthConfigFile(__DIR__.'/gastoxteste-firebase-adminsdk-rqqgr-8c2e07e33b.json');

$firebase = new Firebase('https://gastoxteste.firebaseio.com', $config);

$reference = $firebase->getReference('/gastox/datos/gastos');

$result = $reference->getData();

//print_r($result);

foreach($result as $key=>$r){

	$des = $r['descripcion'];

	if(!array_key_exists('metodo', $r)){

			$val = 'Efectivo';
			if(strtolower($des) == 'card'){
				$val = 'Tarjeta';
			}

			//cria uma key nova "metodo"
		  $r['metodo'] = $val;


	// remove
	// $firebase->delete('/gastox/datos/gastos/'.$key);

	// update
	/*
			$firebase->update([
			    $key => $r
			], '/gastox/datos/gastos');
	*/
	}


}

?>