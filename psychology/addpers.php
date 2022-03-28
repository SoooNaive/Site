<?php
session_start();
include "connect.php"
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<title></title>
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
<?php 
$usname=$_SESSION["username"];
$result = "SELECT `priority`,`login` FROM users WHERE `login` = '$usname'"; 
$result1 = mysqli_query($conn, $result) or trigger_error(mysql_error()." in ". $result); //извлекаем из базы все данные о пользователе с введенным логином
$myrow = mysqli_fetch_array($result1);;	
?>

		<div class="span7 homeabout">
				<div class="person">
					<span class="name">Личный кабинет <?php echo"игрока";?></span>
					<div class="font16"> <p style="color:#000000;">Изменение персоналньых данных</p></div>
                    <section>
						<section>
							<div>
                            <div>
                            <div class="container">
                            <div>
                                <div>
                                <?php
            if(isset($_POST["send17"]))
            {
            
            $form = $_POST;
            
            if (isset($_POST['Name'])) { $Name=$_POST['Name']; if ($Name =='') { unset($Name);} } //заносим введенный пользователем  переменную $login, если он пустой, то уничтожаем переменную
            if (isset($_POST['Familia'])) { $Familia=$_POST['Familia']; if ($Familia =='') { unset($Familia);} }
            if (isset($_POST['Otchestvo'])) { $Otchestvo = $_POST['Otchestvo']; if ($Otchestvo == '') { unset($Otchestvo);} }
            if (isset($_POST['pol'])) { $pol = $_POST['pol']; if ($pol == '') { unset($pol);} }
            if (isset($_POST['email'])) { $email = $_POST['email']; if ($email == '') { unset($email);} }
            if (isset($_POST['age'])) { $date = $_POST['age']; if ($date == '') { unset($date);} }
         if (empty($Name) or empty($Familia) or empty($email)) 
            {

           exit ("Вы ввели не всю информацию, вернитесь назад и заполните все поля!");
            }
            $tvoyid=rand(1,1000);
            
            
            
            echo $pass;
            print_r ($tvoyid);
            echo $usname;
            
            
            $result2 = "INSERT INTO trgames.игрок (`Фамилия`, `Имя`, `Отчество`, `Возраст` ,`Пол`, `О себе`, `idGamer`,`login`)
            VALUES('$Familia','$Name','$Otchestvo','$age','$pol','$email','$tvoyid','$usname')";
            // Проверяем, есть ли ошибки
           
            if ($conn->query($result2) === TRUE) {
                echo "Вы успешно обновили свои данные!";
                exit('<meta http-equiv="refresh" content="0; url=kabiner.php" />');
            } else {
                echo "Ошибка! Вы не зарегистрированы.";
            }     
        } 
        
            ?>
                                    <form action="addpers.php" method="POST" name="form1">
                                        <fieldset>
                                            
                                           <p style="color: #000000"> Ваше имя <input style="width: 300px" type="text" name="Name"> 
                                            Ваша фамилия <input style="width: 300px" type="text" name="Familia">
                                            Ваше Отчество <input style="width: 300px" type="text" name="Otchestvo">
                                            Ваш пол <input style="width: 300px" type="text" name="pol">
                                            Ваш возраст <input style="width: 300px"  type="text" name="age">
                                            Коротко о себе <input style="width: 300px" type="text" name="email"></p>
                                            <input type="submit" name="send17" value="Отправить">
                                        
                                            
                                        </fieldset> 
                                    </form>
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