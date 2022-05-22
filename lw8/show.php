<?php

header('Content-Type: text/plain');

$email = getPostParameter('email');

$file = "./data/$email.txt";

if (file_exists($file)) {
  $f = fopen($file, 'r');
  $txt = fread($f, filesize($file));
  fclose($f);
  echo $txt;
} else {
  echo "No such user";
}

function getPostParameter(string $name): ?string
{
  return isset($_POST[$name]) ? $_POST[$name] : null;
}