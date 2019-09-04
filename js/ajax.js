$(document).ready(function() {
  $('#RegForm').submit(function() {
    // убираем класс ошибок с инпутов
    $('input').each(function() {
      $(this).removeClass('error_input');
      });
    // прячем текст ошибок
    $('.error').hide();
    // получение данных из полей
    var login = $('#login').val();
    var password = $('#password').val();
    var confirm_password = $('#confirm_password').val();
    var email = $('#email').val();
    var name = $('#name').val();
    $.ajax( {
      type: "POST",
      url: "validate.php",
      data: {
        'login': login, 
        'password': password,
        'confirm_password': confirm_password,
        'email': email,
        'name': name
        },
      dataType: "json",
      success: function(data) {
        if(data.result == 'success') {
          alert('Пользователь зарегистрирован');
          $('#name_user_error').html(data.a);
          // показываем текст ошибок
          $('#name_user_error').show();
          }
        else { //ошибка
        // перебираем массив с ошибками
          for(var errorField in data.text_error) {
            // выводим текст ошибок
            $('#name_user_error').html(data.text_error[errorField]);
            // показываем текст ошибок
            $('#name_user_error').show();
            // обводим инпуты красным цветом
            $('#'+errorField).addClass('error_input');
           }
        }
      }
    });
    return false; //не перегружать
  });
});

$(document).ready(function() {
  $('#AutForm').submit(function() {
    // убираем класс ошибок с инпутов
    $('input').each(function() {
      $(this).removeClass('error_input');
    });
    // прячем текст ошибок
    $('.error').hide();

    // получение данных из полей
    var login = $('#login').val();
    var password = $('#password').val();
    $.ajax( {
      type: "POST",
      url: "validate.php?type=aut",
      data: {
        'login': login, 
        'password': password
      },
      dataType: "json",
      success: function(data) {
        if(data.result == 'success') {
          $('#name_user_error').html('Hello '+data.a);
          // показываем текст ошибок
          $('#name_user_error').show();
          $('#AutForm').hide();
          }
        else { //ошибка
        // перебираем массив с ошибками
          for(var errorField in data.text_error) {
            // выводим текст ошибок
            $('#name_user_error').html(data.text_error[errorField]);
            $('#name_user_error').show();
            $('#'+errorField).addClass('error_input');
          }
        }
      }
    });
    return false; //не перегружать
  });
});
