<?php
session_start();
include "connect.php"
?>
<!DOCTYPE HTML>

<html>
	<head>
		<title>Новости</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	</head>
	<body class="is-preload">

		<!-- Page Wrapper -->
			<div id="page-wrapper">

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
					<article id="main">
						<header>
							<h2>Новостная страница</h2>
							<p>Здесь размещаются новости</p>
						</header>
						<section class="wrapper style5">
							<div class="inner">

                      <?php
                                if(isset($_POST['send24']))	{




                                    $KodGroup=$_POST["message1"];
                                    $idigropr=$_POST["zagolovok"];
                                    $img=$_POST["file"];

                                    $query17= "INSERT INTO `bignews`(`текст`,`img`, `заголовок`) VALUES ('$KodGroup','$img','$idigropr'); ";
                                    if ($conn->query($query17) === TRUE) {
                                        exit('<meta http-equiv="refresh" content="0; url=adminnews.php" />');
                                    }
                                    else {
                                        echo 'ошибка';

                                }
                            }






                                echo '<h3>Наши новости</h3>';
								$resultat11 = "SELECT `idnews`, `текст`, `img`, `заголовок` FROM `bignews`";
								$result1091 = $conn->query($resultat11);

								while ($row156 = mysqli_fetch_array($result1091)):
									?>

									<h3><?php echo $row156["заголовок"];?></h3><p><span class="image left"><img src="<?php echo "images/",$row156["img"];?>"  /></span><?php echo $row156["текст"];?></p><hr />
									<?php endwhile; ?>


                                    <?php
                                    $usname=$_SESSION["username"];
                                    $result = "SELECT `priority`,`login` FROM users WHERE `login` = '$usname'";
                                    $result1 = mysqli_query($conn, $result) or trigger_error(mysql_error()." in ". $result); //извлекаем из базы все данные о пользователе с введенным логином
                                    $myrow = mysqli_fetch_array($result1);
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
                                if ($myrow['priority']==1) { ?>
								<form method="post" action="adminnews.php">
								Добавление новой новости:
								<input type="text" id="message" name="zagolovok" placeholder="Введите заголовок новости" class="message" />
								<input type="text" id="message" name="message1" placeholder="Введите новость" class="message" />
								<input type="file" name="file"><br>
								<input type="submit" name="send24" value="Добавить" />

                                </form>

                                    <?php } // если была произведена отправка формы
						      ?>


							</div>
						</section>
					</article>

				

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