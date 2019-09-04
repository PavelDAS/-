<? session_start(); ?>
<!doctype html>
<html lang="ru">
<head>
  <meta charset="utf-8" />
  <title>Форма авторизации</title>
<head>
  <script type="text/javascript" src="./js/jquery.js"></script>
  <script type="text/javascript" src="./js/ajax.js"></script>
  <link rel="stylesheet" type="text/css" href="./css/style.css" >
</head>
<body>
  <label id="name_user_error" class="error"></label>
<? if (isset($_SESSION['name'])) echo 'Hello '.$_SESSION['name']; else { ?>
  <form action="validate.php" method="post" name="LogInFRM" id="AutForm" accept-charset="utf-8">
    <table border="1">
      <tr><td>login</td><td><input type="text" id="login"></td></tr>
      <tr><td>password</td><td><input type="text" id="password"></td></tr>
    </table>
    <input type="submit" value="Вход" id="send_data" />
  </form>
<? } ?>
</body>
</html>
