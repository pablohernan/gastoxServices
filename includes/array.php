<?php

// ordena o array por fecha
function comparator($a, $b){
    return strcmp($a['fecha'], $b['fecha']);
}

function fixDateArray($array,$d_format){


	for($i=0;$i<count($array);$i++){
		//$date = date('d/m/Y', $array[$i]->fecha);

		if($d_format == "Y-m") // month
			$fixProximo = date($d_format, strtotime($array[$i]->fecha . ' +1 month'));
		else{
			$fixProximo = date($d_format, strtotime($array[$i]->fecha . ' +1 day'));
		}	

		if($i < count($array)-1){

				$proximo = $array[$i+1]->fecha;
				//echo $proximo . ':' . $fixProximo;
				if( $proximo != $fixProximo ){
					$object = new StdClass;
					$object->fecha = $fixProximo;
					$object->precio = 0;
					$newArray=[];
					array_push($newArray , $object);	
					array_splice( $array, $i+1, 0, $newArray ); 
				}

		}


	}

	return $array;


}



?>
