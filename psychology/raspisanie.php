<?php
session_start();
include "connect.php"
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<title>Расписание</title>
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
					background-color: #1d242a;
					color: #1b7e5a;	
                }
                table {
                    width: 50%; /* Ширина таблицы в процентах */
                }
                .col1 {
                    width: 100px; /* Ширина ячейки */
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
<?php   
$vaskek=$usname;
$result = " SELECT `idRukovodit`,`Фамилия`, `Имя`, `Отчество`,`О себе` FROM игропрактик WHERE `login` = '$usname'"; 
       
$result1 = mysqli_query($conn, $result) or trigger_error(mysql_error()." in ". $result); //извлекаем из базы все данные о пользователе с введенным логином
$myrow = mysqli_fetch_array($result1);;
$idprepodovat=$myrow["idRukovodit"];

?>


<div class="span7 homeabout">
				<div class="person">
					<span class="name">Личный кабинет <?php echo"игропрактика";?></span>
               
					<div class="font16"> <p style="color:#000000;">Работа с расписанием</p></div> 
                    </div>
                    <section>
						<section>
							<div>
                            <div>
                            <div class="container">
                            <div>
                                <div>
                                    <form action="raspisanie.php" method="post" >
                                    <input type="submit" name="send2" value="Добавить расписание игр"/></from>

                                    
                            <?php   
								if(isset($_POST["send2"])){
							?>		
							<div class="form-center fancy-form">
								<h4 style="color:#000000;" class="naming">Введите данные расписания</h4>
                                    <form  action="raspisanie.php" method="post">
    <!--**** save_user.php - это адрес обработчика.  То есть, после нажатия на кнопку "Зарегистрироваться", данные из полей  отправятся на страничку save_user.php методом "post" ***** -->
                                    
                                        <p style="color:#000000;">Укажите день недели:<br>
                                        <input style="width: 300px;" name="dayweek" type="text" >
                                       
                                    <!--**** В текстовое поле (name="login" type="text") пользователь вводит свой логин ***** -->
                                   
                                      	Укажите время:<br>
                                        <input  style="width: 300px;" name="time" type="text" >
									 	Укажите дату:<br>
                                        <input style="width: 300px;" name="dategame" type="text" >
										Укажите название игры:<br>
                                        <input style="width: 300px;" name="namegame" type="text"></p>
                                       
                                    <!--**** В поле для паролей (name="password" type="password") пользователь вводит свой пароль ***** --> 
                                   
                                        <input type="submit" name="submit17" value="Добавить">
<!--**** Кнопочка (type="submit") отправляет данные на страничку save_user.php ***** --> 
                                    </p></form>
							</div>	
                              <?php
							  }

							  if(isset($_POST["submit17"])){
								$tvoyid=rand(4,100);
								$dayweek = $_POST['dayweek'];
								$dategame = $_POST['dategame'];
								$time = $_POST['time'];
								$namegame = $_POST['namegame'];
								$result2 = "INSERT INTO trgames.расписание (`KodRasp`, `idGroup`, `День недели`, `Время`, `Дата`,`Название`,`idRukovodit`)
								 VALUES('$tvoyid',default,'$dayweek','$time','$dategame','$namegame','$idprepodovat')";
								// Проверяем, есть ли ошибки
								if ($conn->query($result2) === TRUE) {
									echo 'Игра добавлена';
									exit('<meta http-equiv="refresh" content="0; url=raspisanie.php" />');
								} else {
									echo "Ошибка! Вы не зарегистрированы.";
								}      

							  }
                             $query23 = " SELECT 
            `KodRasp`, `idGroup`, `День недели`, `Время`, `Дата`, `idRukovodit` FROM `расписание` WHERE `idRukovodit`=$idprepodovat
            ;";
            
            $result109 = $conn->query($query23);
            echo '<table style=color:#000000; width="50 px" border=1>
            <thead>
                <tr>
                    <td class="col1">День:</td>
                    <td class="col1">Время:</td>
                    <td class="col1">Длительность:</td>
                    
                </tr>
            </thead>
            <tbody>';
                
                    while ($row15 = mysqli_fetch_array($result109)):
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
                        
                    </tr>
                <?php endwhile; ?>


                                </div>
                            </div>
                        </div>

							</div>
						</section>
				</div>
                



			
				</div>			
				
			</div>	

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