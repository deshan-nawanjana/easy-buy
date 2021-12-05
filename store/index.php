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
<title>EasyBuy Store</title>
<script src="item_builder.js"></script>
<link rel="stylesheet" type="text/css" href="/_font/font.css">
<style>
body {
	margin:0px;
	font-family:Roboto-Thin;
	background:url('/_src/store_bg.png') fixed;
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
#cart_box {
	float:left;
	width:400px;
	background:#333;
	height:520px;
	position:fixed;
	margin-top:20px;
	left:-350px;
	transition:all 0.2s;
}
#cart_box:hover {
	left:0px;
}
.cartout {
	width:340px;
	height:460px;
	overflow:hidden;
}
#cart {
	width:360px;
	height:460px;
	margin:8px 0px 8px 8px;
	overflow-y:scroll;
}
.itm {
	float:left;
	width:110px;
	height:110px;
	overflow:hidden;
	background-size:110px 110px;
	margin:0px 2px 2px 0px;
	cursor:default;
}
.ifn {
	width:110px;
	height:110px;
	opacity:0;
	transition:all 0.1s;
	background:rgba(0,0,0,0.7);
}
.ifn:hover {
	opacity:1;
}
.rem {
	width:25px;
	height:25px;
	background:url(/_src/close.png) center no-repeat;
	background-size:15px 15px;
	float:right;
	cursor:pointer;
}
.itp {
	color:#FFF;
	font-size:8px;
	font-family:Roboto-Light;
	padding:8px;
}
.inm {
	color:#FFF;
	font-size:10px;
	font-family:Roboto-Light;
	padding:0px 8px;
	height:65px;
}
.ipr {
	color:#FFF;
	font-size:10px;
	font-family:Roboto-Light;
	padding:0px 8px;
	text-align:right;
}
.sli {
	float:right;
	width:50px;
	text-align:center;
	height:520px;
	background:#111 url(/_src/cart.png) center no-repeat;
}
.ptc {
	float:right;
	margin:15px 10px 0px 10px;
	border-radius:3px;
	font-family:Roboto-Light;
	font-size:17px;
	color:#FFF;
	transition:all 0.1s;
	background:#244658;
	opacity:0.85;
	border:none;
	padding:8px;
}
.ptc:hover {background:#335c72;opacity:1;}
.ptc:active {background:#244658;}
#fprc {
	color:#FFF;
	font-family:Roboto-Regular;
	font-size:17px;
	padding-top:20px;
	padding-left:25px;
	box-shadow:inset 0px 8px #333;
}
.cfo {
	background:rgba(0,0,0,0.5);
}
</style>
</head>
<body>

<div class="upper">
<div class="logo" onclick="store()"><span class="lg_1">easy</span><span class="lg_2">Buy</span></div>
<div class="title"></div>

<div class="tab on" onclick="visit(1)">Store</div>
<div class="tab" onclick="visit(2)">Cart</div>
<div class="tab" onclick="visit(3)">My Account</div>
</div>

<div id="cart_box">
<div class="sli"></div>
<div class="cartout"><div id="cart"></div></div>
<div class="cfo">
<input class="ptc" type="button" value="Proceed to Cart" onclick="proceedCart()">
<div id="fprc"></div>
</div>
</div>














<div id="store"></div>




<style>
#store {
	padding:20px 0px 60px 80px;
}
.item {
	width:200px;
	height:270px;
	display:inline-block;
	overflow:hidden;
	margin:0px 20px 20px 0px;
	transition:all 0.1s;
	box-shadow:2px 2px 10px rgba(0,0,0,0.09);
}
.item:hover {box-shadow:2px 2px 10px rgba(0,0,0,0.2);}
.item_image {
	width:200px;
	height:200px;
	background-size:200px 200px;
}
.item_name {
	color:#FFF;
	background:rgba(0,0,0,0.4);
	padding:8px;
	font-family:Roboto-Light;
	font-size:13px;
	background:#999999;
}
.item_types {
	color:#555;
	padding:12px;
	font-family:Roboto-Light;
	font-size:13px;
	text-align:right;
	background:#f7f7f7;
}
</style>

<script>
var x = '';
for(i=0;i<l.length;++i) {
	x += '<a href="item.php?name='+l[i][0]+'">';
	x += '<div class="item">';
	x += '<div class="item_name">'+l[i][0]+'</div>';
	x += '<div class="item_image" style="background-image:url('+"'"+'/admin/img/'+l[i][0]+'.jpg'+"'"+')"></div>';
	x += '<div class="item_types">'+l[i][1].length+' TYPE(S)</div>';
	x += '</div>';
	x += '</a>';
}

id('store').innerHTML = x;

function id(x) {return document.getElementById(x);}


function visit(x) {
	if(x==1) {location='/store';}
	if(x==2) {location='/store/cart.php';}
	if(x==3) {location='/account';}
}


function store() {location='/';}
</script>

<script src="cart.js"></script>

