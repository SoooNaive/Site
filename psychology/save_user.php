<style>.okno {
        width: 300px;
        height: 50px;
        text-align: center;
        padding: 15px;
        border: 3px solid #0000cc;
        border-radius: 10px;
        color: #0000cc;
      }
      </style>
      
<?php
    if (isset($_POST['username'])) { $username = $_POST['username']; if ($username == '') { unset($username);} } //заносим введенный пользователем логин в переменную $login, если он пустой, то уничтожаем переменную
    if (isset($_POST['password'])) { $password=$_POST['password']; if ($password =='') { unset($password);} }
    //заносим введенный пользователем пароль в переменную $password, если он пустой, то уничтожаем переменную
 if (empty($username) or empty($password)) //если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт
    {
    exit ("Вы ввели не всю информацию, вернитесь назад и заполните все поля!");
    }
    //если логин и пароль введены, то обрабатываем их, чтобы теги и скрипты не работали, мало ли что люди могут ввести
    $username = stripslashes($username);
    $username = htmlspecialchars($username);
    $password = stripslashes($password);
    $password = htmlspecialchars($password);
 //удаляем лишние пробелы
    $username = trim($username);
    $password = trim($password);
 // подключаемся к базе
    include ("connect.php");// 
       
 // если такого нет, то сохраняем данные
    $tvoyid=rand(1,100);

    $result2 = "INSERT INTO trgames.users (idUser,priority,login,pass) VALUES('$tvoyid',default,'$username','$password')";
    // Проверяем, есть ли ошибки
    if ($conn->query($result2) === TRUE) {
        exit('<meta http-equiv="refresh" content="0; url=index.php" />');
    } else {
        echo "Ошибка! Вы не зарегистрированы.";
    }      

    ?>
    