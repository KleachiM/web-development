<?php

function getGetParameter(string $name): ?string
{
    return isset($_GET[$name]) ? $_GET[$name] : null;
}

header('Content-Type: text/plain');
$password = getGetParameter('password'); // проверка переданных параметров
if ($password !== null) {
	if (ctype_alnum($password)) {
		$passwStrength = 0;
		$onlyDigits = false;
		$onlyChars = false;
		$notUniqueCount = 0;
		$countUpper = 0;
		$countLower = 0;
		$countDigits = 0;

		$length = strlen($password);
		if (is_numeric($password)) {
			$onlyDigits = true;
		} else {
			if (ctype_alpha($password)) {
				$onlyChars = true;
				if (ctype_lower($password))
					$countUpper = 0;
				if (ctype_upper($password))
					$countLower = 0;
			}
			$arrForUniqueCount = [];
			$tmpArray = str_split($password);
			foreach ($tmpArray as $char) {
				if (in_array($char, $arrForUniqueCount))
					$notUniqueCount++;
				if (is_numeric($char)) 
					$countDigits++;
				if (ctype_lower($char))
					$countLower++;
				if (ctype_upper($char))
					$countUpper++;
				$arrForUniqueCount[] = $char;
			}
			$passwStrength = 4 * $length;
			$passwStrength += $countDigits;
			if ($countUpper)
				$passwStrength += (($length - $countUpper) * 2);
			if ($countLower)
				$passwStrength += (($length - $countLower) * 2);
			if ($onlyDigits)
				$passwStrength -= $length;
			if ($onlyChars)
				$passwStrength -= $length;
			$passwStrength -= $notUniqueCount;
			echo 'Password Strength: ', var_export($passwStrength, true);
		}
	} else {
		echo 'Illegal character in password';
	}
} else {
	echo 'No such parameter: password';
}