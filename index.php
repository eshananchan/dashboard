<!DOCTYPE html>
<html>

<head>

  <meta charset="UTF-8">

  <title>Login Form</title>

    <link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />

</head>

<body>
<span href="#" class="button" id="toggle-login">Log in</span>
<?php
if(isset($_POST['submitted'])) {
 
require_once('/includes/dbcon.php');

$errors = array();

if(empty($_POST['username'])){
$errors [] = 'Please enter username!';
}else{
$us = trim($_POST['username']);
}

if(empty($_POST['pass'])) {
$errors [] = 'Please enter the password!';
}else{
$p = trim($_POST['pass']);
}

if(empty($errors)){

$query = "SELECT userid, fname, posid, lname, username FROM users WHERE username = '$us' AND password = SHA('$p')";
$result = @mysql_query($query);
$row = mysql_fetch_array($result, MYSQL_NUM);
if($row){

session_start();
$_SESSION['user_id'] = $row[0];
$_SESSION['fname'] = $row[1];
$_SESSION['posid'] = $row[2];
$_SESSION['lname'] = $row[3];
$_SESSION['username'] = $row[4];

ob_end_clean();
if ($_SESSION['posid'] == 'A'){
$url ='admin/home.php';
}
elseif ($_SESSION['posid'] == 'M'){
$url ='manager/home.php';
}
else{
$url ='home.php';
}
header("Location: $url");
exit();
}else{
echo "<center>Incorrect UserName or Password!</center>";

}
}
mysql_close();

}//End submitted
?>

<div id="login">
  <div id="triangle"></div>
  <h1>Log in</h1>
	<form action="index.php" method="post" id="frm">
		<input type="text" placeholder="Username" name="username" />
		<input type="password" name="pass" placeholder="Password" />
		<input type="submit" value="Login" name="submit" />
		<input type="hidden" name="submitted" value="TRUE">
	</form>
</div>
</body>

  <script src='http://codepen.io/assets/libs/fullpage/jquery.js'></script>

  <script src="js/index.js"></script>
</html>