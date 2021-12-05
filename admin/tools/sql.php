<?php if(!isset($_COOKIE['admin'])) {echo '<script>location = "/admin/login.php";</script>';} ?>
<?php

if(isset($_POST['usn'])) {
	$usn = $_POST['usn'];
	$psw = $_POST['psw'];
	$svr = $_POST['svr'];

	$myfileu = fopen("sql\usn.inf", "w") or die("Unable to open file!");
	fwrite($myfileu, $usn);
	fclose($myfileu);

	$myfilep = fopen("sql\psw.inf", "w") or die("Unable to open file!");
	fwrite($myfilep, $psw);
	fclose($myfilep);

	$myfiles = fopen("sql\svr.inf", "w") or die("Unable to open file!");
	fwrite($myfiles, $svr);
	fclose($myfiles);
}


?>
<head>
<link rel="stylesheet" type="text/css" href="/_font/font.css">
<style>
body {
	font-family:Roboto-Thin;
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

<div class="t">MySQL Settings</div>

<form action="sql.php" method="post" autocomplete="off">
<input class="txt" type="text" name="svr" placeholder="Server Name" value="<?php echo file_get_contents('sql\svr.inf'); ?>"><br>
<input class="txt" type="text" name="usn" placeholder="User Name" value="<?php echo file_get_contents('sql\usn.inf'); ?>"><br>
<input class="txt" type="text" name="psw" placeholder="Password" value="<?php echo file_get_contents('sql\psw.inf'); ?>"><br>
<input class="btn" type="submit" value="Save Settings">
</form>




