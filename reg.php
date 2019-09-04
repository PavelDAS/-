<!doctype html>
<html lang="ru">
<head>
  <meta charset="utf-8" />
  <title>Форма регистрации</title>
<head>
  <script type="text/javascript" src="./js/jquery.js"></script>
  <script type="text/javascript" src="./js/ajax.js"></script>
  <link rel="stylesheet" type="text/css" href="./css/style.css" >
</head>
<body>
  <label id="name_user_error" class="error"></label>
  <form action="validate.php" method="post" name="LogInFRM" id="RegForm" accept-charset="utf-8">
    <table border="1">
      <tr><td>login</td><td><input type="text" id="login"></td></tr>
      <tr><td>password</td><td><input type="text" id="password"></td></tr>
      <tr><td>confirm_password</td><td><input type="text" id="confirm_password"></td></tr>
      <tr><td>email</td><td><input type="text" id="email"></td></tr>
      <tr><td>name</td><td><input type="text" id="name"></td></tr>
    </table>
    <input type="submit" value="Зарегистрироваться" id="send_data" />
  </form>
</body>
</html>