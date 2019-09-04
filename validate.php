<?
session_start();
ini_set(session.use_cookies, 1);
//ini_set(session.use_trans_sid, 1);

$xml = simplexml_load_file('db.xml');

if ( (isset($_GET['type'])) AND ($_GET['type'] == 'aut') ) {
  // массив для хранения ошибок
  $errorContainer = array();
  // полученные данные
  $arrayFields = array(
    'login' => mysql_real_escape_string($_POST['login']),
    'password' => mysql_real_escape_string($_POST['password']),
  );

  // проверка всех полей на пустоту
  foreach($arrayFields as $fieldName => $oneField) {
    if($oneField == '' || !isset($oneField)){
      $errorContainer[$fieldName] = 'Заполните все поля!';
    }
  }
  if (!empty($errorContainer)) goto exitValidAut;

  // проверка пользователя в БД
  foreach ($xml as $users) {
    $salt = "paveldas";
    $password = $arrayFields['password'];
    $md5 = md5($salt.$password);
    if ($arrayFields['login'] == $users->login) { //пользователь найден
      if ($md5 == $users->password) { // пароль сошёлся
        $errorContainer = array();
      
        //выполняем вход
        $_SESSION['token'] = md5(uniqid(mt_rand));
        $new_session = $xml->addChild('sessions');
        $new_session->addChild('login', $users->login);
        $new_session->addChild('token', $_SESSION['token']);
        $new_session->addChild('sessionid', $_COOKIE['PHPSESSID']);
        $xml->asXML("db.xml");
        $_SESSION['name'] = $user_name = strval($users->name);
        break;
      }
    }
      else {
      $errorContainer['email'] = 'Ошибка в имени пользователя или пароле';
      }
  }

  exitValidAut:
  // ответ для клиента
  if(empty($errorContainer)){
  // сообщаем об успехе
  echo json_encode(array('result' => 'success', 'a' => $user_name));
  }
  else {
    // если есть ошибки
    echo json_encode(array('result' => 'error', 'text_error' => $errorContainer));
  };
}

else {
  // массив для хранения ошибок
  $errorContainer = array();
  // полученные данные
  $arrayFields = array(
    'login' => mysql_real_escape_string($_POST['login']),
    'password' => mysql_real_escape_string($_POST['password']),
    'confirm_password' => mysql_real_escape_string($_POST['confirm_password']),
    'email' => mysql_real_escape_string($_POST['email']),
    'name' => mysql_real_escape_string($_POST['name'])
  );

  // проверка всех полей на пустоту
  foreach($arrayFields as $fieldName => $oneField) {
    if($oneField == '' || !isset($oneField)){
      $errorContainer[$fieldName] = 'Заполните все поля!';
    }
  }
  if (!empty($errorContainer)) goto exitValid;

  // сравнение введённых паролей
  if($arrayFields['password'] != $arrayFields['confirm_password']) {
      $errorContainer['confirm_password'] = 'Пароли не совпадают';
      goto exitValid;
    }

  // проверка на уникальность в БД
  foreach ($xml as $users) {
    if ($arrayFields['login'] == $users->login)
      $errorContainer['login'] = 'Такой пользователь существует!';
    if ($arrayFields['email'] == $users->email)
      $errorContainer['email'] = 'Пользователь с таким email зарегистрирован!';
  }

  exitValid:
  // делаем ответ для клиента
  if(empty($errorContainer)) {
    //создаём пользователя
    $new_user = $xml->addChild('users');
    $new_user->addChild('login', $arrayFields['login']);

    $salt = "paveldas";
    $password = $arrayFields['password'];
    $md5 = md5($salt.$password);
    $new_user->addChild('password', $md5);
    
    $new_user->addChild('email', $arrayFields['email']);
    $new_user->addChild('name', $arrayFields['name']);
    
    $xml->asXML("db.xml");
    // сообщаем об успехе
    echo json_encode(array('result' => 'success', 'a'=>'OK'));
  }
  else {
      // если есть ошибки
    echo json_encode(array('result' => 'error', 'text_error' => $errorContainer));
  }
} //end else
?>