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
						<h1><a href="index.html">Трансформация</a></h1>
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
            if(isset($_POST["send17"]))
            {
                $Name1=$_POST["Name"]; 
                $Fam1=$_POST["Familia"]; 
                $otch1=$_POST["Otchestvo"]; 
                $emai1=$_POST["email"];
				$pocta=$_POST["pocta"]; 
				$telephone=$_POST["telephone"];
            $usname=$_SESSION["username"];
            $pass=$_SESSION["password"];
          
           
            $query3 = "update trgames.игропрактик set `Фамилия`='$Fam1', `Имя`='$Name1',`Почта`='$pocta',`Телефон`='$telephone', `Отчество`='$otch1',`О себе`='$emai1' where `login` = '$usname'";
            echo $query3;
                    if ($conn->query($query3) === TRUE) {
                        echo "<h2>Данные обновлены успешно</h2>";
                        exit('<meta http-equiv="refresh" content="0; url=kabiner.php" />');
                      
                    } else {
                        echo "Error: " . $query3 . "<br>" . $conn->error;
                    }      
        } 
        else {
            $result2 = "SELECT `Фамилия`, `Имя`, `Отчество`,`О себе`,`Телефон`,`Почта` FROM игропрактик WHERE `login` = '$usname'";  
                                $result3 = mysqli_query($conn, $result2) or trigger_error(mysql_error()." in ". $result2);
                            
                                while ($myrow2 = mysqli_fetch_array($result3)) {
                                    $name = $myrow2['Имя'];
                                    $familia = $myrow2['Фамилия'];
                                    $otch = $myrow2['Отчество'];                                    
                                    $email = $myrow2['О себе'];
									$pochta = $myrow2['Почта'];
									$mobile=$myrow2['Телефон'];
                                
                                }
                            }
                                ?>
<div class="span7 homeabout">
				<div class="person">
					<span class="name">Личный кабинет <?php echo"игропрактика";?></span>
					<div class="font16"> <p style="color:#000000;">Изменение персоналньых данных</p></div>
                    <section>
						<section>
							<div>
                            <div>
                            <div class="container">
                            <div>
                                <div>

                                    <form action="changePersIgropr.php" method="POST" name="form1">
                                        <fieldset>
                                            
                                           <p style="color: #000000"> Ваше имя <input style="width: 300px" type="text" name="Name" value="<?php echo $name; ?>"> 
                                            Ваша фамилия <input style="width: 300px" type="text" name="Familia" value="<?php echo $familia; ?>">
                                            Ваше Отчество <input style="width: 300px" type="text" name="Otchestvo" value="<?php echo $otch; ?>">
                                            Коротко о себе <input style="width: 300px" type="text" name="email" value="<?php echo $email; ?>">
											Ваше телефон <input style="width: 300px" type="text" name="telephone" value="<?php echo $pochta; ?>">
                                            Ваш email <input style="width: 300px" type="text" name="pocta" value="<?php echo $mobile; ?>"></p>
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