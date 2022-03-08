<?php

header('Content-Type: text/plain');

$mail = getGetParameter('email');
if ($mail === null) {
	echo "Не указан email";
} else {
	$firstName = getGetParameter('first_name');
	$lastName = getGetParameter('last_name');
	$age = getGetParameter('age');
	
	$file = "./data/$mail.txt";
	
	if (file_exists($file)) {	// перезапись инфы в файле
		$f = fopen($file, 'r');
		$txt = fread($f, filesize($file));
		fclose($f);
		$patternFirstName = "/(First Name: )(\w*)/";
		$patternLastName = "/(Last Name: )(\w*)/";
		$patternAge = "/(Age: )(\w*)/";

		if ($firstName) {	// если в запросе указано имя - меняется имя
			// $arg = $firstName;
			// $txt = preg_replace_callback($patternFirstName, 'callBackReplace', $txt);
			$txt = preg_replace_callback(
				$patternFirstName, 
				function ($matches) use ($firstName) { return $matches[1] . $firstName; }, 
				$txt);
		}

		if ($lastName) {	// если в запросе указана фамилия - меняется фамилия
			// $arg = $lastName;
			// $txt = preg_replace_callback($patternLastName, 'callBackReplace', $txt);
			$txt = preg_replace_callback(
				$patternLastName, 
				function ($matches) use ($lastName) { return $matches[1] . $lastName; }, 
				$txt);
		}

		if ($age) {		// если в запросе указан возраст - меняется возраст
			// $arg = $age;
			// $txt = preg_replace_callback($patternAge, 'callBackReplace', $txt);
			$txt = preg_replace_callback(
				$patternAge, 
				function ($matches) use ($age) { return $matches[1] . $age; }, 
				$txt);
		}

		// $res = preg_replace_callback($patternLastName, 'callBackReplace', $txt);
		$f = fopen($file, 'w');
		fwrite($f, $txt);
		fclose($f);
	} else {	// создать новый файл
		$f = fopen($file, 'w');
		fwrite($f, "First Name: $firstName\nLast Name: $lastName\nEmail: $mail\nAge: $age");
		fclose($f);
	}
}

function getGetParameter(string $name): ?string
{
    return isset($_GET[$name]) ? $_GET[$name] : null;
}

// function callBackReplace($matches, $arg)
// {
// 	$val = $matches[1] . $arg;
// 	return $val;
// }

function getSubstringRegEx(string $pattern, string $text): ?string
{
	preg_match($pattern, $text, $matches);
	return $matches[1];
}
