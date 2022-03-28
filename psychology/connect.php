<html>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
</head>
<body>
<?php
$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "trgames";
$conn = mysqli_connect($servername, $dbUsername, $dbPassword, $dbName);
if ($conn->connect_errno) {
die("Connection to db failed".mysqli_connect_error());
}
?>
</body>
</html>