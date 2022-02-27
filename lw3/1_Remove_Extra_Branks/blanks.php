<?php

function getGetParameter(string $name): ?string
{
    return isset($_GET[$name]) ? $_GET[$name] : null;
}

header('Content-Type: text/plain');

$text = getGetParameter('text'); // проверка переданных параметров
if ($text !== null) {
	$trimmedText = trim($_GET['text']);	// удаление ' ' в начале и в конце строки
	$arr = explode(' ', $trimmedText);	// запись в массив разбивая по ' '
	$tmpArr = [];	// временный массив для записи непробельных символов
	for ($i=0; $i < count($arr); $i++) { 
		if ($arr[$i] !== '')
			$tmpArr[] = $arr[$i];
	}
	$stringWithounBlanks = implode('#', $tmpArr);  // преобразование массива в строку
	echo $stringWithounBlanks;
} else {
	echo 'No such parameter: text';
}