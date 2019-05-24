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
include 'includes/array.php';

// ordena o array por fecha
usort($result, "comparator");
//

$fecha_aux = '';
$total = 0;
$array = [];
$start = $_GET['start'];
$end = $_GET['end'];
$end = strtotime('+6 hour',(int)$end); // fix data fin para mostrar el ultimo dia
$group = $_GET['group']; // day or month

foreach($result as $key=>$r){

	if($group == 'month')
		$d_format = "Y-m";
	else
		$d_format = "Y-m-d";

	$fecha = $r['fecha'];
	$precio = floatval($r['precio']);

	if( $fecha >= $start && $fecha <= $end){

		$fecha = date($d_format, $fecha);

		if($fecha_aux != $fecha){

			if($fecha_aux != ''){
				$object = new StdClass;
				$object->fecha = $fecha_aux;
				$object->precio = $total;
				array_push($array , $object);		
			}

			$total = $precio;
			$fecha_aux = $fecha;
			
		}else{
			$total += $precio;
		}

	}

}

$object = new StdClass;
$object->fecha = $fecha_aux;
$object->precio = $total;
array_push($array , $object);		

/* debugg trae todo
print_r($result);
echo "

------------------------------------------------------------

";
*/
$array = fixDateArray($array,$d_format);

header('Content-type: application/json');
echo json_encode($array,JSON_UNESCAPED_UNICODE);
/**/
?>