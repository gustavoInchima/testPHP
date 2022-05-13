<?php

//String de hora y minutos “hh:mm”
//formato hora “00:00”, “12:30”, “12:05”, “12:12”, “12:27”. No menciona hora militar dado que es un reloj analogo
//Si el parámetro de la función no fue puesto correctamente o si la hora y minuto no es numérico, la función debe tirar un error. 

define("FIVE_MINUTES", 5);
define("ONE_MINUTE_TO_DEGREES", 6);
define("ONE_HOUR_IN_MINUTES", 60);

function getMinorAngleOfHour($stringHour){
	//regex validates format & numeric type
	if (!preg_match('/^(\d{2}):(\d{2})$/', $stringHour, $matches)){ return 'Error'; }
	
	[, $hour, $minutes] = $matches;

	//limit hour & minute
	if($hour > 12 or $minutes > 59){ return 'Error';}
	
	$hourToMinutes = ($hour == 12) ? 0 : $hour * FIVE_MINUTES;
	
	$angle1 = abs(($minutes - $hourToMinutes) * ONE_MINUTE_TO_DEGREES);
	$angle2 = ((ONE_HOUR_IN_MINUTES - $minutes) + $hourToMinutes) * ONE_MINUTE_TO_DEGREES;

	return min($angle1, $angle2);
}

$hours = [
	'01:45', 
	'10:30', 
	'02:25', 
	'00:00', 
	'12:30', 
	'12:05', 
	'12:12', 
	'12:27',
];

foreach ($hours as $hour) {
	echo "\"{$hour}\" = ". getMinorAngleOfHour($hour). "\n\n";
}
