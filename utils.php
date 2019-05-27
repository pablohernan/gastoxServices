<?php
/*

Chamada periodo de gastos
Params GET
start=1556769600 'data inicio del filtro
end=1557889200 'data fin del filtro
group=month 'month o day para el retorno

url ejemplo:
http://localhost/gastoxPentaho/rest.php?start=1556769600&end=1557889200&group=month


Docs:
https://firebase-php.readthedocs.io/en/1.2.2/overview.html
para pegar o gastoxteste-firebase-adminsdk-rqqgr-8c2e07e33b.json com as configuracoes
https://firebase.google.com/docs/admin/setup#add_firebase_to_your_app

*/

include 'firebase.php';

//print_r($result);

foreach($result as $key=>$r){

	//$des = $r['descripcion'];
	$categoria = $r['categoria'];



	if( $categoria == 'Alimentaci�n casa'){
		echo $key.':'.$categoria.'
		';
		$r['categoria'] = 'Alimentación casa';
		/*
		$firebase->update([
		    $key => $r
		], '/gastox/datos/gastos');		
		*/
	}



	/*
	if(!array_key_exists('metodo', $r)){

			$val = 'Efectivo';
			if(strtolower($des) == 'card'){
				$val = 'Tarjeta';
			}

			//cria uma key nova "metodo"
		  $r['metodo'] = $val;

	/*
	// remove
	// $firebase->delete('/gastox/datos/gastos/'.$key);

	// update
	/*
			$firebase->update([
			    $key => $r
			], '/gastox/datos/gastos');
	*/
	//}


}

?>