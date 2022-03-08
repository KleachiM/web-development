<?php

function getGetParameter(string $name): ?string
{
    return isset($_GET[$name]) ? $_GET[$name] : null;
}

header('Content-Type: text/plain');

$identifier = getGetParameter('identifier'); // проверка переданных параметров
if ($identifier !== null) {
	if (!ctype_alpha($identifier[0])) {
		echo 'no, ', var_export($identifier, true), ' nonono';
	} else { 
		$isIdentifier = true;
		$tmpArray = str_split($identifier);
		for ($i=1; $i < count($tmpArray); $i++) { 
			if ((!is_numeric($tmpArray[$i]) and (!ctype_alpha($tmpArray[$i])))) {
				$isIdentifier = false;
			}
		}
		if ($isIdentifier) {
			echo 'yes, ', var_export($identifier, true), ' is identifier';
		} else {
			echo 'no, ', var_export($identifier, true), ' no identifier';
		}
	}
} else {
	echo 'No such parameter: identifier';
}