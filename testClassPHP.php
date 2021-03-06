<?php

//String de hora y minutos “hh:mm”
//formato hora “00:00”, “12:30”, “12:05”, “12:12”, “12:27”. No menciona hora militar dado que es un reloj analogo
//Si el parámetro de la función no fue puesto correctamente o si la hora y minuto no es numérico, la función debe tirar un error. 

class MinorAngleOfHour 
{
	private int $hour;
	private int $minutes;

	private const FIVE_MINUTES = 5; 
	private const ONE_MINUTE_TO_DEGREES = 6;
	private const ONE_HOUR_IN_MINUTES  = 60;

	public function __construct(string $stringHour)
	{
		$this->validate($stringHour);
	}

	public function getMinorAngleOfHour(): int
	{
		$hourToMinutes = ($this->hour == 12) ? 0 : $this->hour * self::FIVE_MINUTES;

		$angle1 = abs(($this->minutes - $hourToMinutes) * self::ONE_MINUTE_TO_DEGREES);
		$angle2 = ((self::ONE_HOUR_IN_MINUTES - $this->minutes) + $hourToMinutes) * self::ONE_MINUTE_TO_DEGREES;

		return min($angle1, $angle2);
	}

	private function validate($stringHour): void
	{
		if (!preg_match('/^(\d{2}):(\d{2})$/', $stringHour, $matches))
		{
			throw new exception('Error the expected format is not met hh:mm');
		}
		
		list(, $this->hour, $this->minutes) = $matches;

		if($this->hour > 12 or $this->minutes > 59)
		{
			throw new exception('Error hour or minute outside the allowed range, hour <=12, minutes <=59');
		}
		
	}

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
	echo "\"{$hour}\" = ". (new MinorAngleOfHour($hour))->getMinorAngleOfHour() . "\n\n";
}