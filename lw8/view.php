<!DOCTYPE html>
<head>
  <meta charset="utf-8">
	<title>Страница</title>
	<link rel="stylesheet" href="css/style.css">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600&family=Noto+Sans:wght@700&family=Roboto+Condensed&display=swap" rel="stylesheet">
</head>
<body>
  <form method="POST" action="show.php" enctype="x-www-formd-data" class="form-show-info">
    <input type="email" name="email" placeholder="Email" required class="form__input form-show-info__input">
    <input type="submit" value="Получить данные" class="form__input form__button">
  </form>
</body>