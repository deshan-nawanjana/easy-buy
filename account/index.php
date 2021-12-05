<?php

if(isset($_COOKIE['nic'])) {
	$servername = file_get_contents('../admin/tools/sql/svr.inf');
	$username = file_get_contents('../admin/tools/sql/usn.inf');
	$password = file_get_contents('../admin/tools/sql/psw.inf');
	$conn = new mysqli($servername, $username, $password);
	if ($conn->connect_error)		{echo "<script>isSyser = true;</script>";}
	$sql = "USE easy_buy";
	if ($conn->query($sql) === TRUE)	{}
	else					{echo "<script>isSyser = true;</script>";}
	$sql = "SELECT * from CUSTOMER WHERE nic='".$_COOKIE['nic']."';";
	$tbl = $conn->query($sql);
	if($tbl->num_rows==0) {echo '<script>location = "/account/login.php";</script>';}
}
else {echo '<script>location = "/account/login.php";</script>';}

?>


<!doctype html>
<head>
<title>EasyBuy Account</title>




<?php




$nic = '';

function check_availabe($nic) {

	$servername = file_get_contents('../admin/tools/sql/svr.inf');
	$username = file_get_contents('../admin/tools/sql/usn.inf');
	$password = file_get_contents('../admin/tools/sql/psw.inf');


	$conn = new mysqli($servername, $username, $password);
	if ($conn->connect_error)		{echo "<script>alert('Connection Error');</script>";}
	$sql = "USE easy_buy";
	if ($conn->query($sql) === TRUE)	{}
	else					{echo "<script>alert('Database Error');</script>";}
	$sql = "SELECT * from CUSTOMER WHERE nic='".$nic."';";
	$tbl = $conn->query($sql);
	if($tbl->num_rows==0) {return 1;}
	else {return 0;}
}

// ##############################################################################################################

if(!isset($_COOKIE['nic'])) {echo "<script>location='login.php';</script>";return;}
else {
	if($_COOKIE['nic']=='null')
	{echo "<script>location='login.php';</script>";return;}
}

// ##############################################################################################################

function get_account_data($nic,$dat) {

	$servername = file_get_contents('../admin/tools/sql/svr.inf');
	$username = file_get_contents('../admin/tools/sql/usn.inf');
	$password = file_get_contents('../admin/tools/sql/psw.inf');

	$conn = new mysqli($servername, $username, $password);
	if ($conn->connect_error)		{echo "<script>alert('Connection Error');</script>";}
	$sql = "USE easy_buy";
	if ($conn->query($sql) === TRUE)	{}
	else					{echo "<script>alert('Database Error');</script>";}
	$sql = "SELECT * from CUSTOMER WHERE nic='".$nic."';";
	$tbl = $conn->query($sql);
	while($row = $tbl->fetch_assoc()) {
		return $row[$dat];
	}
}

$nic = $_COOKIE['nic'];
$fnm = get_account_data($nic,'fnm');
$lnm = get_account_data($nic,'lnm');
$adr = get_account_data($nic,'adr');
$mob = get_account_data($nic,'mob');
$fln = $fnm .' '. $lnm;

?>


<link rel="stylesheet" type="text/css" href="/_font/font.css">
<style>
body {
	margin:0px;
	font-family:Roboto-Thin;
	background:url('/_src/account_bg.png') fixed;
}

.upper {
	height:80px;
	background:#1e3c62;
}
.logo {
	height:80px;
	font-size:35px;
	line-height:80px;
	padding:0px 20px;
	color:#FFF;
	background:#18314e;
	float:left;
	cursor:pointer;
}
.lg_1 {font-family:Roboto-Thin;}
.lg_2 {font-family:Roboto-MediumItalic;}
.title {
	height:80px;
	font-size:35px;
	line-height:80px;
	font-family:Roboto-Thin;
	padding:0px 20px;
	color:#FFF;
	float:left;
	width:300px;
}
p {
	font-family:Roboto-Light;
	margin:30px;
}
.lin {
	width:340px;
	margin:30px;
	line-height:30px;
}
.lbl {
	font-family:Roboto-Light;
	float:left;
	width:120px;
}
.itm {
	float:left;
	font-family:Roboto-Medium;
	width:220px;
}
.lbx {
	height:120px;
}
.nobuy {
	font-family:Roboto-Medium;
	margin:30px;
}
.bal {
	font-family:Roboto-Medium;
	font-size:30px;
	margin:10px 25px;
	display:inline-block;
	height:62px;
	line-height:62px;
	padding:0px 15px;
	border:none;
	border-radius:4px;
	color:#FFF;
	transition:all 0.1s;
	opacity:0.85;
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
	margin:25px;
}
.btn:hover {background:#335c72;opacity:1;}
.btn:active {background:#244658;}
.tab {
	height:80px;
	font-size:22px;
	line-height:80px;
	font-family:Roboto-Thin;
	padding:0px 20px;
	color:#FFF;
	float:left;
	width:120px;
	text-align:center;
	transition:all 0.1s;
	cursor:pointer;
}
.tab:hover {
	background:#18314e;
}
.on {background:#12253b !important;}
.info {
	width:50%;
	float:left;
	margin-right:35px;
}
table {
	width:100%;
}
tr {
	background:rgba(0,0,0,0.1);
}
td {
	padding:5px 10px;
	font-family:Roboto-Light;
	color:#333;
	font-size:13px;
}
th {
	padding:8px 10px;
	font-family:Roboto-Medium;
	font-weight:inherit;
	text-align:left;
	background:rgba(0,0,0,0.05);
}
.vi {
	text-decoration:none;
	cursor:pointer;
}
.vi:hover {
	text-decoration:underline;
}
.tr {text-align:right;}

.tbox {
	width:40%;
	height:350px;
	float:left;
	overflow-y:scroll;
	overflow-x:hidden;
}
.tibox {
	width:40%;
	float:left;
}
.tc1 {width:220px;}
.tc2 {width:70px;}
.tc3 {width:80px;}
</style>




</head>
<body>

<div class="upper">
<div class="logo" onclick="store()"><span class="lg_1">easy</span><span class="lg_2">Buy</span></div>
<div class="title"></div>

<div class="tab" onclick="visit(1)">Store</div>
<div class="tab" onclick="visit(2)">Cart</div>
<div class="tab on" onclick="visit(3)">My Account</div>
</div>

<div class="info">

<p align="justify">
Welcome to your account page, <?php echo $fln ?>. You'll able to see your personal information and your perchase list down below.
If you have any issue about your perchase or other details, please contact us.
</p>

<p>
<div class="lbx">
<div class="lin"><div class="lbl">Full Name :</div><div class="itm"><?php echo $fln ?></div></div>
<div class="lin"><div class="lbl">Address :</div><div class="itm"><?php echo $adr ?></div></div>
<div class="lin"><div class="lbl">NIC No. :</div><div class="itm"><?php echo $nic ?></div></div>
<div class="lin"><div class="lbl">Mobile :</div><div class="itm"><?php echo $mob ?></div></div>
</div>
</p>

<div class="bal" id="bb">Balance: Rs. <span id="bal"></span>.00</div>

<form action="logout.php" method="post">
<input class="btn" type="submit" value="Logout" onmousedown="logout()">
</form>

</div>

<p align="justify">
You can see your perchase list here. Click on the item names to view them on store for more information.
</p>

<span class="nobuy" id="nb">You have not buy anything yet.</span>
<div id="buy"></div>









<script>
function id(x) {return document.getElementById(x);}

var xhttp = new XMLHttpRequest();
xhttp.open("GET", "/admin/account_ajax.php", false);
xhttp.send();
var l = xhttp.responseText.split('`');
var cid = l.length.toString();
do {cid = '0' + cid;} while(cid.length<10);

for(i=0;i<l.length;++i) {l[i] = l[i].split('|');}

var x = '';

for(i=l.length-2;i>-1;--i) {
	var inm = l[i][1];
	var itp = l[i][2];
	var ipr = l[i][3];
	var dat = l[i][4];
	x += '<tr><td class="tc1"><span class="vi" onclick="vi(this)">'+inm+'</span></td><td class="tc2">'+itp+'</td><td class="tr tc3">'+ipr+'.00</td><td class="tc4">'+dat+'</td></tr>';
}
if(x!='') {id('nb').outerHTML = '<div class="tibox"><table><tr><th class="tc1">Item Name</th><th class="tc2">Type</th><th class="tc3">Price (Rs.)</th><th class="tc4">Date</th></tr></table></div>';}
else {id('buy').outerHTML = '';}

if(x!='') {id('buy').innerHTML = '<div class="tbox"><table>'+x+'</table></div>';}



var xhttp0 = new XMLHttpRequest();
xhttp0.open("GET", "/admin/balance_ajax.php", false);
xhttp0.send();

id('bal').innerHTML = xhttp0.responseText;







function store() {location='/';}
function visit(x) {
	if(x==1) {location='/store';}
	if(x==2) {location='/store/cart.php';}
	if(x==3) {location='/account';}
}

function logout() {
	document.cookie = 'cart=';
}


var bl = parseInt(id('bal').innerHTML);
if(bl!=0) {id('bb').style.background = 'red';}
else {id('bb').style.background = '#244658';}

function vi(obj) {
	location = '/store/item.php?name=' + obj.innerHTML;
}	



</script>





