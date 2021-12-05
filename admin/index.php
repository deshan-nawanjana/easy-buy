<?php if(!isset($_COOKIE['admin'])) {echo '<script>location = "/admin/login.php";</script>';} ?>
<!doctype html>
<head>
<title>EasyBuy - Admin Panel</title>
<link rel="stylesheet" type="text/css" href="/_font/font.css">
<style>
body {
	font-family:Roboto-Light;
	margin:0px;
	overflow:hidden;
}
.lg_1 {font-family:Roboto-Thin;}
.lg_2 {font-family:Roboto-MediumItalic;}
.bar {
	padding:20px;
	font-size:35px;
	background:rgba(0,0,0,0.1);
}
.btn {
	width:200px;
	border:none;
	border-radius:4px;
	font-family:Roboto-Light;
	font-size:15px;
	color:#FFF;
	transition:all 0.1s;
	background:#244658;
	opacity:0.85;
	padding:15px;
	margin:10px 25px 10px 25px;
	cursor:pointer;
}
.panel {
	float:left;
	width:300px;
	padding-top:15px;
}
#iframe {
	width:800px;
	height:500px;
	border:none;
}
</style>
</head>
<body onload="rz()" onresize="rz()">
<div class="bar"><span class="lg_1">easy</span><span class="lg_2">Buy</span> - Admin Panel</div>

<div class="panel">
<div class="btn" onclick="visit('update.php')">Update Store</div>
<div class="btn" onclick="visit('confirm.php')">Account Confirmations</div>
<div class="btn" onclick="visit('payments.php')">Payments</div>
<div class="btn" onclick="visit('tools/show.php?name=customer')">Database System</div>
<div class="btn" onclick="visit('tools/sql.php')">MySQL Settings</div>
<div class="btn red" onclick="visit('tools/reset.html')">Reset Databases</div>
<div class="btn red" onclick="visit('dbs/default.html')">Default Database Set</div>
<div class="btn red" onclick="urlx('logout.php')">Logout Admin</div>


</div>

<iframe src="update.php" id="iframe"></iframe>

<script>
function id(x) {return document.getElementById(x);}

function visit(x) {id('iframe').src = x;}
function urlx(x) {location = x;}

function rz() {
	id('iframe').style.width = window.innerWidth - 350 + 'px';
	id('iframe').style.height = window.innerHeight - 100 + 'px';
}

</script>
