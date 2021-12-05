<?php

	$password = "12345";

	// Set Your Admin Login Password

?>


























<!doctype html>
<head>
<title>Admin Login - easyBuy</title>
<link rel="stylesheet" type="text/css" href="/_font/font.css">
<style>
body {
	font-family:Roboto-Thin;
	margin:25px;
}
.btn {
	width:150px;
	height:32px;
	border:none;
	border-radius:4px;
	font-family:Roboto-Light;
	font-size:14px;
	color:#FFF;
	transition:all 0.1s;
	background:#244658;
	opacity:0.85;
}
.btn:hover {background:#335c72;opacity:1;}
.btn:active {background:#244658;}
.t {
	padding:15px 0px;
	font-family:Roboto-Medium;
	font-size:22px;
}
.txt {
	width:250px;
	height:35px;
	margin-bottom:8px;
	border:1px solid #888;
	border-radius:4px;
	padding:2px 8px;
	font-family:Roboto-Light;
	font-size:15px;
	color:#333;
	background:rgba(255,255,255,0.75);
}
</style>
</head>
<body>

<?php

if(isset($_POST['usn'])) {
	$usn = $_POST['usn'];
	$psw = $_POST['psw'];
	if($psw==$password) {
		setcookie('admin', '1', time() + (86400 * 90 * 30), "/");
		echo '<script>location = "/admin";</script>';
	}
}

if(isset($_COOKIE['admin'])) {
	if($_COOKIE['admin']=='1') {echo '<script>location = "/admin";</script>';}
}


?>

<div class="t">Login to Admin Panel</div>

<form action="login.php" method="post" autocomplete="false">
<input class="txt" type="text" name="usn" value="EASY_BUY_ADMIN_001" placeholder="Admin Name"><br>
<input class="txt" type="password" name="psw" placeholder="Password"><br>
<input class="btn" type="submit" value="Login">
</form>