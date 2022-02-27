<?php

function getGetParameter(string $name): ?string
{
    return isset($_GET[$name]) ? $_GET[$name] : null;
}

header('Content-Type: text/plain');

$identifier = getGetParameter('identifier'); // проверка переданных параметров
if ($identifier !== null) {
	if (is_numeric($identifier)){
		echo 'no, ', var_export($identifier, true), ' is digit';
	} else {
		if (ctype_alpha($identifier)) {
			echo 'yes, ', var_export($identifier, true), ' is identifier';
		} else {
			if (is_numeric($identifier[0])) {
				echo 'no, ', var_export($identifier, true), ' starts with digit';
			} elseif (!ctype_alpha($identifier[0])) {
				echo 'no, ', var_export($identifier, true), ' starts with illegal character';
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
					echo 'no, ', var_export($identifier, true), ' contain illegal character';
				}
			}
		}
	}
} else {
	echo 'No such parameter: identifier';
}