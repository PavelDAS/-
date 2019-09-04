<? session_start();
setcookie("PHPSESSID", "", time()+60);  /* срок действия */

 ?>
<!doctype html>
<html lang="ru">
<head>
  <meta charset="utf-8" />
  <title>Главная</title>
<head>
  <script type="text/javascript" src="./js/jquery.js"></script>
  <link rel="stylesheet" type="text/css" href="./css/style.css" >
</head>
<body>
    <table border="1">
      <tr><td><a href="reg.php">Регистрация</a></td><td><a href="aut.php">Вход</a></td></tr>
    </table>
</body>
</html>