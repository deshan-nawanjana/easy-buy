<?php setcookie('nic', 'null', time() + (86400 * 90 * 30), "/"); ?>
<!doctype html>
<head>
<title>EasyBuy - Login or Sign Up</title>
<link rel="stylesheet" type="text/css" href="/_css/main.css">
<link rel="stylesheet" type="text/css" href="/_font/font.css">
<script>
var isSyser = false;
var isExist = false;
var isUperr = false;
var isNoAcc = false;
var isInPsw = false;
var isEmpty = false;
var isNotCn = false;
var isWait  = false;
var isPswnm = false;
</script><?php

setcookie('cart', '', time() + (86400 * 30), "/");

if(isset($_COOKIE['nic'])) {
	if($_COOKIE['nic']!='null' && !check_availabe($_COOKIE['nic'])) {echo "<script>location='/store';</script>";return;}
}

// ##############################################################################################################

if(isset($_POST['nic'])) {create_account();}
if(isset($_POST['l_nic'])) {login_account();}

// ##############################################################################################################

function check_availabe($nic) {
	$servername = file_get_contents('../admin/tools/sql/svr.inf');
	$username = file_get_contents('../admin/tools/sql/usn.inf');
	$password = file_get_contents('../admin/tools/sql/psw.inf');
	$conn = new mysqli($servername, $username, $password);
	if ($conn->connect_error)		{echo "<script>isSyser = true;</script>";}
	$sql = "USE easy_buy";
	if ($conn->query($sql) === TRUE)	{}
	else					{echo "<script>isSyser = true;</script>";}
	$sql = "SELECT * from CUSTOMER WHERE nic='".$nic."';";
	$tbl = $conn->query($sql);
	if($tbl->num_rows==0) {return 1;}
	else {return 0;}
}

// ##############################################################################################################

function get_account_data($nic,$dat) {

	$servername = file_get_contents('../admin/tools/sql/svr.inf');
	$username = file_get_contents('../admin/tools/sql/usn.inf');
	$password = file_get_contents('../admin/tools/sql/psw.inf');

	$conn = new mysqli($servername, $username, $password);
	if ($conn->connect_error)		{echo "<script>isSyser = true;</script>";}
	$sql = "USE easy_buy";
	if ($conn->query($sql) === TRUE)	{}
	else					{echo "<script>isSyser = true;</script>";}
	$sql = "SELECT * from CUSTOMER WHERE nic='".$nic."';";
	$tbl = $conn->query($sql);
	while($row = $tbl->fetch_assoc()) {
		return $row[$dat];
	}
}

// ##############################################################################################################

function create_account() {
	$nic = $_POST['nic'];
	$fnm = $_POST['fnm'];
	$lnm = $_POST['lnm'];
	$adr = $_POST['adr'];
	$mob = $_POST['mob'];
	$psw = $_POST['psw'];
	$rpw = $_POST['rpw'];

	if($nic=='' || $fnm=='' || $lnm=='' || $adr=='' || $mob=='' || $psw=='' || $rpw=='') {echo "<script>isEmpty = true;</script>";return;}
	if($psw!=$rpw) {echo "<script>isPswnm = true;</script>";return;}

	if(check_availabe($nic)==0) {echo "<script>isExist = true;</script>";}
	else {update_account();}
}

function update_account() {
	$nic = $_POST['nic'];
	$fnm = $_POST['fnm'];
	$lnm = $_POST['lnm'];
	$adr = $_POST['adr'];
	$mob = $_POST['mob'];
	$psw = $_POST['psw'];
	$rpw = $_POST['rpw'];

	if(upload_pic()==0) {echo "<script>isUperr = true;</script>";return;}


	$servername = file_get_contents('../admin/tools/sql/svr.inf');
	$username = file_get_contents('../admin/tools/sql/usn.inf');
	$password = file_get_contents('../admin/tools/sql/psw.inf');

	$conn = new mysqli($servername, $username, $password);

	if ($conn->connect_error) {echo "<script>isExist = true;</script>";}
	$sql = "USE easy_buy";
	if ($conn->query($sql)===TRUE) {}
	else {echo "<script>isExist = true;</script>";}

	$sql = "INSERT INTO customer(nic,fnm,lnm,adr,mob,psw,act) VALUES('".$nic."','".$fnm."','".$lnm."','".$adr."','".$mob."','".$psw."','n')";
	if($conn->query($sql)===TRUE) {echo "<script>isWait = true;</script>";}
	else {echo "<script>alert('We cannot create your account!');</script>"; echo $conn->error;}

	$conn->close();
}

function upload_pic() {
	$target_dir = "pic/";
	$target_file = $target_dir . $_POST['nic'] . '.jpg';
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

	if(isset($_POST["submit"])) {
		$check = getimagesize($_FILES["pic"]["tmp_name"]);
		if($check !== false) {$uploadOk = 1;}
		else { return 0;$uploadOk = 0;}
	}

	if (file_exists($target_file)) {return 1; $uploadOk = 0;}

	if($_FILES["pic"]["size"] > 500000) {return 0; $uploadOk = 0;}

	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {return 0;$uploadOk = 0;}

	if($uploadOk == 0) {return 0;}
	else {
		if(move_uploaded_file($_FILES["pic"]["tmp_name"], $target_file)) {return 1;}
		else {return 0;}
	}
}

// ##############################################################################################################

function login_account() {
	$nic = $_POST['l_nic'];
	$psw = $_POST['l_psw'];

	if(check_availabe($nic)==1) {echo "<script>isNoAcc = true;</script>";return;}

	$cpw = get_account_data($nic,'psw');
	$act = get_account_data($nic,'act');

	if($psw!=$cpw) {echo "<script>isInPsw = true;</script>";return;}
	else {
		if($act=='n') {echo "<script>isNotCn = true;</script>";return;}
		else {
			setcookie('nic', $nic, time() + (86400 * 30 * 92), "/");
			echo "<script>location='/store';</script>";
		}
	}
}




?>
<style>
.caption {
	font-size:35px;
	font-family:Roboto-Thin;
	color:#FFF;
	padding-top:15px;
	text-shadow:3px 3px 2px rgba(0,0,0,0.3);
	padding-bottom:35px;
}
.left {text-align:left;}
.right {text-align:right;}
.lg {
	font-size:75px;
	font-family:Roboto-Thin;
	color:#FFF;
	padding-top:55px;
	padding-bottom:65px;
	text-shadow:3px 3px 2px rgba(0,0,0,0.3);
}
.lg_1 {font-family:Roboto-Thin;}
.lg_2 {font-family:Roboto-MediumItalic;}
.sp {
	width:3px;
	height:400px;
	background:rgba(255,255,255,0.8);
	border-radius:2px;
	box-shadow:3px 3px 2px rgba(0,0,0,0.1);
}
.lower {
	background:#1a3655;
	padding-bottom:55px;
	margin-top:55px;
}
.dl {padding:45px 45px 0px 45px;}
.dt {
	font-size:35px;
	font-family:Roboto-Light;
	color:rgba(255,255,255,0.7);
	padding-top:15px;
	padding-bottom:10px;
}
.dd {
	color:rgba(255,255,255,0.6);
	font-size:20px;
	width:80%;
	text-align:justify;
}
.tbl {
	width:100%;
	height:400px;
}
.tbox {
	width:400px;
	height:600px;
	padding:20px;
}
.text {
	width:300px;
	height:35px;
	margin-bottom:8px;
	border:none;
	border-radius:4px;
	padding:8px 15px;
	font-family:Roboto-Light;
	font-size:20px;
	color:#333;
	background:rgba(255,255,255,0.75);
	transition:all 0.1s;
}
.text:focus {
	background:rgba(255,255,255,1);
}
.btn {
	width:100px;
	height:52px;
	border:none;
	border-radius:4px;
	font-family:Roboto-Light;
	font-size:20px;
	color:#FFF;
	transition:all 0.1s;
	background:#244658;
	opacity:0.85;
	margin-left:230px;
}
.btn:hover {background:#335c72;opacity:1;}
.btn:active {background:#244658;}
.fil {
	opacity:0;
	float:right;
	height:51px;
	width:300px;
	position:absolute;
	padding-left:15px;
}
.nic {
	overflow:hidden;
	width:300px;
	line-height:51px;
	height:51px;
	margin-bottom:8px;
	border:none;
	border-radius:4px;
	font-family:Roboto-Light;
	font-size:20px;
	color:#333;
	padding:0px 15px;
	background:rgba(255,255,255,0.75);
	transition:all 0.1s;
}
.nic:hover {background:rgba(255,255,255,1);}
#msg {
	float:right;
	position:fixed;
	width:100%;
	display:none;
}
.msgbox {
	height:60px;
	background:#335c72;
	border-radius:4px;
	float:right;
	margin:20px;
	transition:all 0.1s;
	opacity:0.8;
}
.msgbox:hover {opacity:1;}
#msd {
	width:270px;
	line-height:60px;
	color:#FFF;
	font-family:Roboto-Light;
	padding:0px 25px;
}
.cls {
	width:60px;
	height:60px;
	background:url(/_src/close.png) center no-repeat;
	background-size:20px 20px;
	float:right;
	cursor:pointer;
}
</style>
</head>
<body bgcolor="#739eb0">

<div id="msg">
<div class="msgbox">
<div class="cls" onclick="close_msg()"></div>
<div id="msd"></div>
</div>
</div>

<center>
<div class="lg"><span class="lg_1">easy</span><span class="lg_2">Buy</span></div>
</center>





<center>
<table border="0" class="tbl">
<tr>
<td>

<div class="tbox" style="float:right;">
<div class="caption">Login to your account</div>
<form action="login.php" method="post" enctype="multipart/form-data" autocomplete="off">
<input class="text" type="text" name="l_nic" value="" placeholder="NIC No."><br>
<input class="text" type="password" name="l_psw" value="" placeholder="Password"><br>
<input class="btn" type="submit" value="Login"><br>
</form>
</div>

</td>
<td width="10px"><div class="sp"></div></td>
<td>

<div class="tbox" style="float:left;padding-left:60px;">
<div class="caption">Create a new account</div>
<form action="login.php" method="post" enctype="multipart/form-data" autocomplete="off">
<input class="text" type="text" name="nic" value="" placeholder="Your NIC No."><br>
<input class="text" type="text" name="fnm" value="" placeholder="First Name"><br>
<input class="text" type="text" name="lnm" value="" placeholder="Last Name"><br>
<input class="text" type="text" name="adr" value="" placeholder="Address"><br>
<input class="text" type="text" name="mob" value="" placeholder="Mobile No."><br>
<input class="text" type="password" name="psw" value="" placeholder="New Password"><br>
<input class="text" type="password" name="rpw" value="" placeholder="Repeat Password"><br>
<div class="nic"><input class="fil" type="file" name="pic" id="pic">Upload NIC Scaned Image</span></div><br>
<input class="btn" type="submit"  value="Sign Up"><br>
</form>
</div>

</td>
</tr>
</table>
</center>











<div class="lower">
<div class="dl">
<div class="dt">Any problem with Login or Sign Up?</div>
<div class="dd">
admin@easybuy.lk<br>
+94777 12 34 56<br>
+94112 12 34 56
</div>
</div>
</div>








<script>
function id(x) {return document.getElementById(x);}

function show_msg() {
	id('msg').style.display = 'inherit';
}

function close_msg() {
	id('msg').style.display = 'none';
}

if(isSyser) {id('msd').innerHTML = 'Somthings not right!';show_msg();}
if(isExist) {id('msd').innerHTML = 'Account is already exist!';show_msg();}
if(isUperr) {id('msd').innerHTML = 'Cannot upload NIC image!';show_msg();}
if(isNoAcc) {id('msd').innerHTML = 'We cannot find your account!';show_msg();}
if(isInPsw) {id('msd').innerHTML = 'Password is incorrect!';show_msg();}
if(isEmpty) {id('msd').innerHTML = 'Fill the all blanks!';show_msg();}
if(isNotCn) {id('msd').innerHTML = 'Your account not confirmed yet!';show_msg();}
if(isWait)  {id('msd').innerHTML = 'Your account will confirm later!';show_msg();}
if(isPswnm) {id('msd').innerHTML = 'Password not macthing!';show_msg();}
</script>







