<?php
session_start();

?>

<html>
	<head>
		<title>Игропрактики</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
		<style>
            .align-top {
            vertical-align: top;
        }
		</style>
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

						<section class="wrapper style5">
							<div class="inner">

								<h3>Наши игропрактики</h3>
								<?php
								include "connect.php";
								echo'<form action="igropraktic.php" method="POST">';
							$query2 = "select idRukovodit,Фамилия,Имя from игропрактик;";
							$result = $conn->query($query2);
							echo "<label>Выберите:";
								echo '<select name="categoryID" id="">';
								while($row = $result->fetch_assoc()) {
									$NName=$row["Фамилия"];
									$catID=$row["Имя"];
                                    $id=$row["idRukovodit"];
									echo "<option value='$catID'>$NName $catID</option>";
								}
								echo'</select>';
								echo "</label>";

							echo '<input type="submit"  name="knopka1" value="Выбрать">';



	if(isset($_POST["heyrasp"]))
{

	$kordasp1=$_POST["newline"];
	$kektest1=$_POST["newline2"];
	$tvoyid=rand(1,100);
	$result10 = "SELECT `idGamer`,`login`	FROM игрок WHERE `login` = '$usname'";
	$result11 = mysqli_query($conn, $result10) or trigger_error(mysql_error()." in ". $result10); //извлекаем из базы все данные о пользователе с введенным логином
	$myrow34 = mysqli_fetch_array($result11);
	$idgeymer=$myrow34['idGamer'];
	$query37 = "INSERT INTO trgames.svyaz_rasp_igrok_prepod (`idRukovodit`, `KodRasp`, `idIgroka`, `idsvyazi`) VALUES($kektest1,$kordasp1,$idgeymer,$tvoyid)";
		if ($conn->query($query37) === TRUE) {
			echo '<h2>Расписание обновлено, запись успешна <a href="kabiner.php"> Мои игры</a></h2>';

		} else {
			echo "Error: " . $query37 . "<br>" . $conn->error;
		}
}

							if(isset($_POST["knopka1"]))
							{
                                $categoryID=$_POST["categoryID"];
                                $resultat = "SELECT idRukovodit FROM `игропрактик` WHERE `Имя` = '$categoryID'";
                                $result3 = mysqli_query($conn, $resultat) or trigger_error(mysql_error()." in ". $resultat);
                                $myrow2 = mysqli_fetch_array($result3);

                                $kektest=$myrow2["idRukovodit"];
								echo '<p>Игропрактик и информация о нем</p>';
								$query1 = "SELECT `idRukovodit`,`Имя`,`Фамилия`,`Отчество`,`Возраст`,`Опыт`,`Образование`,`Телефон`,`Почта`,`Фото`,`О себе`, `img`
								FROM игропрактик WHERE `Имя`='$categoryID';";
								$result11 = mysqli_query($conn, $query1) or trigger_error(mysql_error()." in ". $query1);
								$row1 = mysqli_fetch_array($result11);

								?>
								<h2><?php echo $categoryID; echo ' ';echo $row1["Фамилия"];    ?></h2>
									<p><span style= width:180px; style= height:180px; class="image left"><img src="<?php echo "images/",$row1["img"];?>" alt="" /></span> <?php echo $row1["О себе"]; ?>


                                <?php
												echo "<br><strong>Контактная почта: </strong>",$row1["Почта"];
												echo "<br><strong>Номер телефона: </strong>", $row1["Телефон"],"<br>";?></p>


                                <br><h2>Фотоальбом игропрактика</h2>
									<div class="box alt">
										<div class="row gtr-50 gtr-uniform">
											<div class="col-12"><span class="image fit"><img src="images/6сайт.jpg" alt="" /></span></div>
											<div class="col-4"><span class="image fit"><img src="images/4сайт.jpg" alt="" /></span></div>
											<div class="col-4"><span class="image fit"><img src="images/7сайт.jpg" alt="" /></span></div>
											<div class="col-4"><span class="image fit"><img src="images/5сайт.jpg" alt="" /></span></div>

										</div>
									</div>




									<section class="wrapper style5">
							<div class="inner">

							<?php
								$usname=$_SESSION["username"];
								$result = "SELECT `priority`,`login` FROM users WHERE `login` = '$usname'";
								$result1 = mysqli_query($conn, $result) or trigger_error(mysql_error()." in ". $result); //извлекаем из базы все данные о пользователе с введенным логином
								$myrow = mysqli_fetch_array($result1);
								if ($myrow['priority']==0) { ?>
								<h3>Мое расписание</h3>
								<?php

							  $query23 = " SELECT
									`KodRasp`, `idGroup`, `День недели`, `Время`, `Дата`,`Название`,`idRukovodit` FROM `расписание` WHERE `idRukovodit`=$kektest
									;";

									$result1077 = $conn->query($query23);
									echo '<table style=color:#000000; width="50 px" border=1>
									<thead>
										<tr>
											<td class="col1">День недели:</td>
											<td class="col1">Время:</td>
											<td class="col1">Дата:</td>
											<td class="col1">Игра:</td>
											<td class="col1">Записаться:</td>
											<td class="col1">Лимит:</td>
										</tr>
									</thead>
									<tbody>';

										while ($row15 = mysqli_fetch_array($result1077)):
									?>
										<tr>
											<td class="col1">
												<?php echo $row15["День недели"]; ?>
											</td>
											<td class="col1">
												<?php echo $row15["Время"]; ?>
											</td>
											<td class="col1" >
												<?php echo $row15["Дата"]; ?>
											</td>
											<td class="col1" >
												<?php echo $row15["Название"]; ?>
											</td>
											<td class="col1" >
												7/15
											</td>
											<td>
											<form action="igropraktic.php" method="POST">
												<input type="hidden" name="newline" value="<?php echo $row15["KodRasp"]; ?>">
												<input type="hidden" name="newline2" value="<?php echo $kektest; ?>">
												<input type="submit" name="heyrasp" value="Записаться">
											</form>
											</td>
										</tr>
									<?php endwhile; ?>
									</tbody>
                                </table>

                                <?php

								}

								echo '<h3>Мои новости</h3>';
								$resultat11 = "SELECT `idnews`, `img`, `text`, `idRukovodit`,`Заголовок` FROM `newspraktic` WHERE  `idRukovodit` = '$kektest'";
								$result1091 = $conn->query($resultat11);

								while ($row156 = mysqli_fetch_array($result1091)):
									?>

									<p><h4><?php echo $row156["Заголовок"];?></h4><span style= width:180px; style= height:180px; class="image left"><img src="<?php echo "images/",$row156["img"];?>"  /></span><?php echo $row156["text"];?></p>
									<?php endwhile; ?>
								<?php	if ($myrow['priority']==2) { ?>
								<form method="post" enctype="multipart/form-data" action="igropraktic.php">
								Добавление новой новости:
								<input type="text" id="message" name="zagolovok" placeholder="Введите заголовок новости" class="message" />
								<input type="text" id="message" name="message1" placeholder="Введите новость" class="message" />
								<input type="hidden" id="idigropr" name="idigropr" value="<?php echo $kektest;?>" class="message" />
								<input type="file" name="file"><br>
								<input type="submit" name="send24" value="Добавить" />
								<input type="reset" value="Очистить" /></form>
								</form>

							<?php }


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
							?>


								</section>

								<section>



								<?php
								echo '<h3>Отзывы</h3>';
                                $query2 = " SELECT `ava`,`Коммент`,`userlog` FROM `comments` WHERE `idigropr`= '$kektest';";
                                $result109 = $conn->query($query2);
                                    echo '<table border=1 >
                                    <thead>
                                        <tr>
                                            <td></td>
                                            <td></td>

                                        </tr>
                                    </thead>
                                    <tbody>';
                                    while ($row15 = mysqli_fetch_array($result109)):
                                        ?>
                                            <tr height="100" style=color:#000000;>
                                                <td>
                                               <img src="<?php echo "images/",$row15["ava"];?>" alt="" />
                                                <br>
                                                <?php echo $row15["userlog"]; ?>
                                                <br>
                                                </td>
                                                <td class="align-top">
                                                  <?php echo $row15["Коммент"]; ?>
                                                </td>





                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                                   <?php
                                   if (empty($_SESSION['username']))
                                   {
                                   }
                                   else {  ?>


									<h4>Написать отзыв</h4>
									<form method="post" action="#">
										<div class="row gtr-uniform">
											<div class="col-6 col-12-xsmall">
												<input type="text" name="demo-name" id="demo-name" value="<?php echo $usname; ?>" placeholder="<?php echo $usname; ?>" />
											</div>
											<div class="col-6 col-12-xsmall">
												<input type="email" name="demo-email" id="demo-email" value="" placeholder="Email" />
											</div>
											<div class="col-6 col-12-small">
												<input type="checkbox" id="demo-copy" name="demo-copy">
												<label for="demo-copy">Отправить копию на почту</label>
											</div>
											<div class="col-6 col-12-small">
												<input type="checkbox" id="demo-human" name="demo-human" checked>
												<label for="demo-human">Я не робот</label>
											</div>
                                            <div class="col-12">
                                            <form method="post" action="otzivy.php">
                                                Ваш отзыв: <input type="text" id="message" name="message" placeholder="Введите сообщение" class="message" />
                                                <input type="hidden" id="idigropr" name="idigropr" value="<?php echo $kektest;?>" class="message" />
                                                <input type="submit" name="send23" value="Добавить" />
                                                <input type="reset" value="Очистить" /></form>
                                                </form>
                                            </div>

										</div>
									</form>
								</section>
							</div>
					<?php }?>


								<?php



											}
								?>	 </p>






								<hr />

							</div>
                            <?php
                    if(isset($_POST['send23']))	{


                        $tvoyid11=rand(5,10000);

                        $KodGroup=$_POST["message"];
                        $idigropr=$_POST["idigropr"];


                        $query4 = "INSERT INTO trgames.comments(`id`,`Коммент`,`ava`,`userlog`,`idigropr`)
                        values($tvoyid11,'$KodGroup','question.jpg','$usname','$idigropr');";
                        if ($conn->query($query4) === TRUE) {
                            exit('<meta http-equiv="refresh" content="0; url=igropraktic.php" />');
                        }
                        else {
                            echo 'ошибка';

                    }
                }
				if(isset($_POST['send24']))	{




					$KodGroup=$_POST["message1"];
					$idigropr=$_POST["zagolovok"];
					$idigropr1=$_POST["idigropr"];
					$img=$_POST["file"];

					$query17= "INSERT INTO `newspraktic`(`img`,`text`, `Заголовок`, `idRukovodit`) VALUES ('$img','$KodGroup','$idigropr','$idigropr1');        ";
					if ($conn->query($query17) === TRUE) {
						exit('<meta http-equiv="refresh" content="0; url=igropraktic.php" />');
					}
					else {
						echo 'ошибка';

				}
			}

                ?>
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
