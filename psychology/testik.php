<?php
session_start();
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title></title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
		<style>
		</style>
	</head>
	<body class="is-preload">

		<!-- Page Wrapper -->
		

				<!-- Header -->
					<header id="header">
						<h1><a href="index.php">Трансформация</a></h1>
						<nav id="nav">
						<ul>
								<li class="special">
									<a href="#menu" class="menuToggle"><span>Меню</span></a>
									<div id="menu">
										<ul>
											<li><a href="index.php">Главная</a></li>
											<li><a href="igropraktic.php">Игропрактики</a></li>
											<li><a href="adminnews.php">Новости</a></li> <br>
											<?php 
											if (empty($_SESSION['username']))
												{
													echo '<li><a href="registr.php">Регистрация</a></li><br>';
													echo '<form action="testik.php" method="post">													
													<p>
													   <label>Ваш логин:<br></label>
													   <input name="username" type="text" size="15" maxlength="15">
													   </p>																																								 
													   <p>												
													   <label>Ваш пароль:<br></label>
													   <input name="password" type="password" size="15" maxlength="15">
													   </p>
													   <p>
													   <input type="submit" name="submit" value="Войти"></form>';
												}
											else
												{
													$usname=$_SESSION["username"];
													echo "ваш логин:   "; 													
													echo $usname;					
													echo '<li><a href="kabiner.php">личный кабинет</a></li><br>';																											
													echo '<form action="exitses.php" method="post">
													<input type="submit" name="send" value="выход" />
												</form>';
													
												}
												?>
										</ul>
									</div>
								</li>
							</ul>
						</nav>
					</header>

				<!-- Main -->
		
								<?php
   //  вся процедура работает на сессиях. Именно в ней хранятся данные  пользователя, пока он находится на сайте. Очень важно запустить их в  самом начале странички!!!
if (isset($_POST['username'])) { $username = $_POST['username']; if ($username == '') { unset($username);} } //заносим введенный пользователем логин в переменную $login, если он пустой, то уничтожаем переменную
    if (isset($_POST['password'])) { $password=$_POST['password']; if ($password =='') { unset($password);} }
    //заносим введенный пользователем пароль в переменную $password, если он пустой, то уничтожаем переменную
if (empty($username) or empty($password)) //если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт
    {
    exit ("Вы ввели не всю информацию, вернитесь назад и заполните все поля!");
    }
    //если логин и пароль введены,то обрабатываем их, чтобы теги и скрипты не работали, мало ли что люди могут ввести
    $username = stripslashes($username);
    $username = htmlspecialchars($username);
$password = stripslashes($password);
    $password = htmlspecialchars($password);
//удаляем лишние пробелы
    $username = trim($username);
    $password = trim($password);
// подключаемся к базе
        include "connect.php";
        $result = "SELECT `pass`,`login` FROM users WHERE `login` = '$username'"; //извлекаем из базы все данные о пользователе с введенным логином'
       
        
        $result1 = mysqli_query($conn, $result) or trigger_error(mysql_error()." in ". $result); //извлекаем из базы все данные о пользователе с введенным логином
        $myrow = mysqli_fetch_array($result1);
        if (empty($myrow['pass']))
        {
        //если пользователя с введенным логином не существует
        
        
        echo ' 
		<section class="wrapper style5">
							<div class="inner">
                            <div class="form-center fancy-form">
                            <div class="container">
                            <div class="wrapper">
                                <div class="form-center fancy-form">
                    <h2 class="naming">Пароль или логин неверные<br>Вход.</h2>

                    <form action="testik.php" method="post">													
                    <p>
                     <label>Ваш логин:<br></label>
                     <input name="username" type="text" size="15" maxlength="15">
                     </p>																																								 
                     <p>												
                     <label>Ваш пароль:<br></label>
                    <input name="password" type="password" size="15" maxlength="15">
                     </p>
                    <p>
                    <input type="submit" name="submit" value="Войти">
                </div>
            </div>
        </div>

            </div>
        </section>>';
            

        

        }
        else {
        //если существует, то сверяем пароли
        if ($myrow['pass']==$password) {
        //если пароли совпадают, то запускаем пользователю сессию! Можете его поздравить, он вошел!
        $_SESSION['username']=$myrow['login'];
        $_SESSION['password']=$myrow['pass'];
        $_SESSION['id']=$myrow['id'];//эти данные очень часто используются, вот их и будет "носить с собой" вошедший пользователь
        exit('<meta http-equiv="refresh" content="0; url=index.php" />');
        }
        else    {    
        echo "Пароль или логин неверные.";
        echo '<form action="testreg.php" method="post">													
			<p>
			 <label>Ваш логин:<br></label>
			 <input name="username" type="text" size="15" maxlength="15">
		     </p>																																								 
			 <p>												
		     <label>Ваш пароль:<br></label>
			<input name="password" type="password" size="15" maxlength="15">
			 </p>
			<p>
			<input type="submit" name="submit" value="Войти">';
        
        }
        }
    ?>
								
								

								<hr />

							</div>
						</section>
					</article>

				<!-- Footer -->
					

			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>