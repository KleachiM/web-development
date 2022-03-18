<?php

header('Content-Type: text/plain');

$mail = getGetParameter('email');

if ($mail === null) {
	echo 'no email';
} else {
	$file = "./data/$mail.txt";

	if (file_exists($file)) {
		$f = fopen($file, 'r');
		$txt = fread($f, filesize($file));
		fclose($f);
		echo $txt;
	} else {
		echo "No such file";
	}
}

function getGetParameter(string $name): ?string
{
    return isset($_GET[$name]) ? $_GET[$name] : null;
}