<?php
session_start();
include "connect.php"
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Личный кабинет</title>
	<link href="css/demo.css" rel="stylesheet" type="text/css">
	 <link rel="stylesheet" href="css/jqbar.css" />
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css">

	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,600' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" type="text/css" href="css/style1.css">

	<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/simpletextrotator.css" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main1.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
		<style>
                .fagobob {
					background-color: #000000;
					color: #1b7e5a;
                }
                </style>

</head>
<body>
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
	<div class="container topbottom">
		<div class="row-fluid">


<?php
$usname=$_SESSION["username"];
$result = "SELECT `priority`,`login` FROM users WHERE `login` = '$usname'";
$result1 = mysqli_query($conn, $result) or trigger_error(mysql_error()." in ". $result); //извлекаем из базы все данные о пользователе с введенным логином
$myrow = mysqli_fetch_array($result1);
if ($myrow['priority']==0) { ?>


<div class="span5">
				<img src="img/avatar.jpg" alt="Profile Avatar" class="avatar">

				<div class="navigation">
					<div>
						<ul>
							<li>
								<img src="img/about-icon.png">
								<a href="kabiner.php">Обо мне</a>
							</li>
							<li>
								<img src="img/portfolio-icon.png">
								<a href="changePers.php">Изменить данные</a>
							</li>
							<li>
								<img src="img/followme-icon.png">
								<a href="mygame.php">Мои игры</a>
							</li>
							<li>
								<img src="img/contact-icon.png">
								<a href="messageus.php">Сообщения</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		<div class="span7 homeabout">
				<div class="person">
					<span class="name">Личный кабинет <?php echo"игрока";?></span>
					<div class="font16"> <p style="color:#000000;">Персональные данные <a href="#">Изменить</a></p></div>
				</div>

				<?php
				 $result2 = "SELECT `Фамилия`,`Имя`,`ava`, `Отчество`, `Возраст`,`Пол`,`О себе` FROM `игрок` WHERE `login` = '$usname'";
				 $result3 = mysqli_query($conn, $result2) or trigger_error(mysql_error()." in ". $result2);
				 $myrow2 = mysqli_fetch_array($result3);

				 if (empty($myrow2["Фамилия"])) //если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт
				 {  ?>
				 	<p style=color:#000000;>Необходимо добавить информацию о себе, чтобы получить больше возможностей личного кабиента!</p>
					 <form action="addpers.php" method="post"  >
        			  <input class="fagobob" type="submit" name="send911" value="Добавить информацию"/></from>

			<?php	 }
				else {
					?>
					<form action="kabiner.php" method="post"  >
					<input type="file" name="file">
					<input type="submit" value="Загрузить новое фото" name="submit787">
						</form>
						<span style= width:180px; style= height:180px; class="image left"><img src="<?php echo "images/",$myrow2["ava"];?>"/></span>
						<?php

						// если была произведена отправка формы
						if(isset($_FILES['file'])) {
						// проверяем, можно ли загружать изображение
						$check = can_upload($_FILES['file']);

						if($check === true){
						// загружаем изображение на сервер
						make_upload($_FILES['file'], $_SESSION['type'], $id);
						echo "<strong>Файл успешно загружен!</strong>";
						}
						else{
						// выводим сообщение об ошибке
						echo "<strong>$check</strong>";
						}
					}
					if(isset($_POST['submit787']))	{


                        $img=$_POST["file"];

						$query3 = "update trgames.игрок set `ava`='$img' where `login` = '$usname'";
						echo $query3;
								if ($conn->query($query3) === TRUE) {
									echo "<h2>Данные обновлены успешно</h2>";
									exit('<meta http-equiv="refresh" content="0; url=kabiner.php" />');

								} else {
									echo "Error: " . $query3 . "<br>" . $conn->error;
								}
                }

					echo "<p style=color:#000000;><br>Ваша фамилия: ", $myrow2["Фамилия"];
					echo "<br>Ваше имя: ", $myrow2["Имя"];
					echo "<br>Ваше отчество: ",$myrow2["Отчество"];
					echo "<br>Ваш День рождения: ",$myrow2["Возраст"];
					echo "<br>Коротко о себе: ",$myrow2["О себе"];
					echo "<br>Ваш пол: ", $myrow2["Пол"],"<br>";
				}
				?>

					<form action="stanigropr.php" method="post"  >
        			<input class="fagobob" type="submit" name="send911" value="Стать игропрактиком"/></from>
				</div>

			</div>

<?php
}
else {
	if ($myrow['priority']==2) {
	?>
		<div class="span5">
				<img src="img/avatar.jpg" alt="Profile Avatar" class="avatar">

				<div class="navigation">
					<div>
						<ul>
							<li>
								<img src="img/about-icon.png">
								<a href="kabiner.php">Обо мне</a>
							</li>
							<li>
								<img src="img/portfolio-icon.png">
								<a href="changePersIgropr.php">Изменить данные</a>
							</li>
							<li>
								<img src="img/followme-icon.png">
								<a href="raspisanie.php">Расписание игр</a>
							</li>
							<li>
								<img src="img/contact-icon.png">
								<a href="messagepr.php">Сообщения</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		<div class="span7 homeabout">
				<div class="person">
					<span class="name">Личный кабинет <?php echo"игропрактика";?></span>
					<div class="font16"> <p style="color:#000000;">Персональные данные <a href="#">Изменить</a></p></div>
				</div>

				<?php
				 $result2 = "SELECT `idRukovodit`, `Имя`, `Фамилия`, `Отчество`, `Возраст`, `Опыт`, `Образование`,`img`, `Телефон`, `Почта`, `Фото`, `О себе`, `img`, `login` FROM `игропрактик` WHERE `login` = '$usname'";
				 $result3 = mysqli_query($conn, $result2) or trigger_error(mysql_error()." in ". $result2);
				 $myrow2 = mysqli_fetch_array($result3);

				 if (empty($myrow2["Фамилия"])) //если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт
				 {  ?>
				 	<p style=color:#000000;>Необходимо добавить информацию о себе, чтобы получить больше возможностей личного кабиента!</p>
					 <form action="changePersIgropr.php" method="post"  >
        			  <input class="fagobob" type="submit" name="send911" value="Добавить информацию"/></from>

			<?php	 }
				else {
					?>
					<form action="kabiner.php" method="post"  >
					<input type="file" name="file">
					<input type="submit" value="Загрузить новое фото" name="submit787">
						</form>
						<span style= width:180px; style= height:180px; class="image left"><img src="<?php echo "images/",$myrow2["img"];?>"/></span>
						<?php

						// если была произведена отправка формы
						if(isset($_FILES['file'])) {
						// проверяем, можно ли загружать изображение
						$check = can_upload($_FILES['file']);

						if($check === true){
						// загружаем изображение на сервер
						make_upload($_FILES['file'], $_SESSION['type'], $id);
						echo "<strong>Файл успешно загружен!</strong>";
						}
						else{
						// выводим сообщение об ошибке
						echo "<strong>$check</strong>";
						}
					}
					if(isset($_POST['submit787']))	{


                        $img=$_POST["file"];

						$query3 = "update trgames.игропрактик set `img`='$img' where `login` = '$usname'";
						echo $query3;
								if ($conn->query($query3) === TRUE) {
									echo "<h2>Данные обновлены успешно</h2>";
									exit('<meta http-equiv="refresh" content="0; url=kabiner.php" />');

								} else {
									echo "Error: " . $query3 . "<br>" . $conn->error;
								}
                }
					echo "<p style=color:#000000;><br>Ваша фамилия :", $myrow2["Фамилия"];
					echo "<br>Ваше имя :", $myrow2["Имя"];
					echo "<br>Ваше отчество :",$myrow2["Отчество"];
					echo "<br>Возраст :",$myrow2["Возраст"];
					echo "<br>О себе :",$myrow2["О себе"];
					echo "<br>Ваш контактный телефон :", $myrow2["Телефон"],"<br>";
				}
				?>
				</div>

			</div>
			<?php

}	else {
 ?>
<div class="span5">
				<img src="img/avatar.jpg" alt="Profile Avatar" class="avatar">

				<div class="navigation">
					<div>
						<ul>
							<li>
								<img src="img/about-icon.png">
								<a href="kabiner.php">Главная</a>
							</li>
							<li>
								<img src="img/portfolio-icon.png">
								<a href="loginpass.php">Управление</a>
							</li>
							<li>
								<img src="img/followme-icon.png">
								<a href="obrabotkazayav.php">Добавление игропрактика</a>
							</li>
							<li>
								<img src="img/contact-icon.png">
								<a href="message.php">Сообщения</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		<div class="span7 homeabout">
				<div class="person">
					<span class="name">Личный кабинет <?php echo"администратора";?></span>

				</div>



 <?php
}
}
?>




		</div>
	</div>
    <script src="js/jquery-1.7.1.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="../wp-content/themes/piha/js/top-bar.js" ></script>
    <script type="text/javascript" src="../wp-content/themes/piha/js/bsa-ads.js" ></script>
	<script src="js/jqbar.js" type="text/javascript"></script>

	<script type="text/javascript">
	 $(document).ready(function () {

            $('#bar-1').jqbar({ label: 'HTML5', value: 80, barColor: '#21ba82' });

            $('#bar-2').jqbar({ label: 'CSS', value: 99, barColor: '#21ba82' });

            $('#bar-3').jqbar({ label: 'JavaScript', value: 85, barColor: '#21ba82' });

            $('#bar-4').jqbar({ label: 'WordPress', value: 75, barColor: '#21ba82' });



			$('#bars-content .content').css({'opacity':'0',display:'none'});
			$('#bars-content .content:eq(0)').css('display','block').animate({opacity:1},1000);
			$('.jqbar:first').addClass('active');
			$('.jqbar').hover(function(){ $(this).addClass('hover');},function(){ $(this).removeClass('hover');});
			$('.jqbar').click(function(){
				$('.jqbar').removeClass('active');
				var id = $(this).addClass('active').attr('id').replace('bar','content');
				$('#bars-content .content').css({'opacity':'0',display:'none'});
				$('#' + id).css('display','block').animate({opacity:1},1000);

			});

			/* $(".rotate").textrotator({
				animation: "spin",
				separator: ",",
				speed: 2000
			  });
			*/

        });

    </script>
    <script type="text/javascript" src="js/jquery.simple-text-rotator.min.js"></script>
  <!--Dynamically creates analytics markup-->

  <script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

</body>
</html>