<?php


function diasEntre($start,$end){
	if(($end - $start) > 0)
		$dias = (int)(($end - $start) /86400);
	else
		$dias = 0;
	return $dias+1;
}



?>