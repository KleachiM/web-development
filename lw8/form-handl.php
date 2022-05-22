<?php

$username = getPostParameter("username");
$email = getPostParameter("email");
$profession = getPostParameter("profession");

if (empty($profession)) {
  $content = file_get_contents("_form.php");
  $search = array("{%username%}", "{%email%}");
  $replace = array($username, $email);
  $content = str_replace($search, $replace, $content);
  echo str_replace("<?php include 'form.php' ?>", $content, file_get_contents("index.php"));
}

$file = "./data/$email.txt";

$f = fopen($file, 'w');
fwrite($f, "Email: $email\nИмя: $username\nДеятельность: $profession");
fclose($f);

echo "Вы успешно записаны на курс!";

function getPostParameter(string $name): ?string
{
    return isset($_POST[$name]) ? $_POST[$name] : null;
}