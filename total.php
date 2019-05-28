<?php
/*

Chamada periodo de gastos
Params GET
start=1556769600 'data inicio del filtro
end=1557889200 'data fin del filtro
type=total o category

url ejemplo:
http://localhost/gastoxServices.git/total.php?start=1556769600&end=1557889200&type=total

Docs:
https://firebase-php.readthedocs.io/en/1.2.2/overview.html
para pegar o gastoxteste-firebase-adminsdk-rqqgr-8c2e07e33b.json com as configuracoes
https://firebase.google.com/docs/admin/setup#add_firebase_to_your_app

*/

include 'firebase.php';
include 'includes/array.php';
include 'includes/date.php';

// ordena o array por fecha
usort($result, "comparator");
//

$fecha_aux = '';
$total = 0;
$totalTarjeta = 0;
$totalEfectivo = 0;
$array = [];
$arrayCategorias = [];
$start = $_GET['start'];
$end = $_GET['end'];
$dias = 0;
$type = $_GET['type']; // total || category

foreach($result as $key=>$r){

	$d_format = "Y-m-d";
	$fecha = $r['fecha'];
	$precio = floatval($r['precio']);
	$categoria = $r['categoria'];
	$metodo = $r['metodo'];


	if( $fecha >= $start && $fecha <= $end){

		$fecha = date($d_format, $fecha);

		//cuanto dias
		if($fecha_aux != $fecha){
			if($fecha_aux != '')
				$dias++;	
			$fecha_aux = $fecha;	
		}

		$total += $precio;

		// metodo
		if($metodo == 'Tarjeta'){
			$totalTarjeta += $precio;
		}else{
			$totalEfectivo += $precio;	
		}



		if($type == 'description'){
			$r['precio'] = floatval($r['precio']);
			$r['fecha'] = date($d_format, $r['fecha']);
			array_push($array , $r);	
		}

		// categorias
		if(!array_key_exists($categoria, $arrayCategorias)){
			$arrayCategorias[$categoria] = 0;
		}
		$arrayCategorias[$categoria] += $precio;	

/*
		echo '
		precio:'.$precio.'
		total:'.$total.'
		totalTarjeta:'.$totalTarjeta.'
		totalEfectivo:'.$totalEfectivo.'

		';
*/
	}

}




if($type == 'total'){
	// totales
	$dias = diasEntre($start,$end);
	$promedioDia = $total / $dias;

	$return = new StdClass;
	$return->total = round($total,2);
	$return->dias = $dias;
	$return->promedioDia = round($promedioDia,2);
	array_push($array , $return);	

}elseif($type == 'method'){

	// metodo
	$return = new StdClass;
	$return->metodo = 'Tarjeta';
	$return->total = round($totalTarjeta,2);
	array_push($array , $return);		

	$return = new StdClass;
	$return->metodo = 'Efectivo';
	$return->total = round($totalEfectivo,2);
	array_push($array , $return);		

}elseif($type == 'category'){

	// categorias format json
	foreach($arrayCategorias as $key=>$v){
		$return = new StdClass;
		$return->categoria = $key;
		$return->precio = $v;
		array_push($array , $return);	

	}

}


//array_push($array , $arrayCategorias);

/* debugg trae todo
print_r($result);
echo "

------------------------------------------------------------

";
*/
header('Content-type: application/json');
echo json_encode($array,JSON_UNESCAPED_UNICODE);

?>