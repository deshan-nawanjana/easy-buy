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

<?php

if(isset($_POST['ids'])) {
	$l = explode("|",$_POST['ids']);


	$nic = $_COOKIE['nic'];

	for ($x = 0; $x <= sizeof($l)-1; $x++) {
		$icd = $l[$x];
		$dat = date("Y.m.d");


	$servername = file_get_contents('../admin/tools/sql/svr.inf');
	$username = file_get_contents('../admin/tools/sql/usn.inf');
	$password = file_get_contents('../admin/tools/sql/psw.inf');

		$conn = new mysqli($servername, $username, $password);
		if ($conn->connect_error)		{echo "<script>alert('Connection Error');</script>";}
		$sql = "USE easy_buy";
		if ($conn->query($sql) === TRUE)	{}
		else					{echo "<script>alert('Database Error');</script>";}
		
		$sql = "UPDATE item SET sli='".$nic."' WHERE icd='".$icd."';";
		if(!$conn->query($sql)===TRUE) {echo "<script>alert('Update error 1!');</script>";}

		$sql = "UPDATE item SET sld='".$dat."' WHERE icd='".$icd."';";
		if(!$conn->query($sql)===TRUE) {echo "<script>alert('Update error 1!');</script>";}

	}

	echo "<script>document.cookie = 'cart=; path=/'; cart = [];location='/account/'</script>";
}










?>







<!doctype html>
<head>
<title>Your Cart</title>
<script src="item_builder.js"></script>
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
.l {
	width:690px;
	height:15px;
	font-family:Roboto-Light;
	padding:5px;
}
.inm {
	float:left;
	width:370px;
	font-size:14px;
}
.siz {
	float:left;
	width:170px;
	font-size:14px;
	text-align:right;
}
.prc {
	float:left;
	width:140px;
	font-size:14px;
	text-align:right;
}
#cart {
	margin:25px;
}
.b {
	font-family:Roboto-Medium; !important
}
.h {
	background:rgba(0,0,0,0);
	transition:all 0.1s;
}
.h:hover {background:rgba(0,0,0,0.07);}
.btn {
	height:52px;
	border:none;
	border-radius:4px;
	font-family:Roboto-Light;
	font-size:20px;
	color:#FFF;
	transition:all 0.1s;
	background:red;
	opacity:0.85;
	margin:25px;
}
.btn:hover {background:#cc0000;opacity:1;}
.btn:active {background:#990000;}
.inp {
	margin:30px;
	font-family:Roboto-Light;
	font-size:20px;
}
.t {
	margin:30px;
	font-family:Roboto-Medium;
	font-size:30px;
}
</style>
</head>
<body>

<div class="upper">
<div class="logo" onclick="store()"><span class="lg_1">easy</span><span class="lg_2">Buy</span></div>
<div class="title"></div>

<div class="tab" onclick="visit(1)">Store</div>
<div class="tab on" onclick="visit(2)">Cart</div>
<div class="tab" onclick="visit(3)">My Account</div>
</div>


<div class="t">Your Cart</div>

<div id="cart"></div>




<form action="cart.php" method="post" id="pb">
<input type="hidden" name="ids" value="" id="ids">
<input class="btn" type="submit" value="Purchase Cart">
</form>





<style>





</style>








<script>
function id(x) {return document.getElementById(x);}







function cartView() {
	var x = '';
	var y = '';
	var fprc = 0;
	for(i=0;i<cart.length;++i) {
		var k = getItemInfo(cart[i]);

		var i_nm = k[0];
		var i_cd = cart[i];
		var i_tp = k[1];
		var i_pr = k[2];

		fprc += parseInt(i_pr);
		y += i_cd + '|'

		x += '<div class="l h"><div class="inm">'+i_nm + ' ('+ i_tp +')</div><div class="siz">'+ getInfoX(i_nm,i_tp,'size') +'</div><div class="prc">' + i_pr + '.00</div></div>';

	}
	if(x=='') {id('pb').outerHTML = '<div class="inp">Your cart is empty.</div>';return;}
	x = '<div class="l b"><div class="inm">Item</div><div class="siz">Size</div><div class="prc">Price</div></div>' + x;
	id('cart').innerHTML = x + '<div class="l b"><div class="inm">Total</div><div class="siz"> </div><div class="prc"><div id="fprc"></div></div></div>';
	id('fprc').innerHTML = + fprc + '.00<br><br>';
	id('ids').value = y.substr(0,y.length-1);
}

function getItemInfo(icd) {
	for(j=0;j<lz.length;++j) {
		if(lz[j][0]==icd) {return [lz[j][1],lz[j][2],lz[j][3]];}
	}
}



var cart = [];
var lc = document.cookie.split(';');
for(i=0;i<lc.length;++i) {
	if(lc[i].indexOf('cart=')>-1) {
		var x = lc[i];
		var a = lc[i].indexOf('cart=') + 5;
		x = x.substr(a,x.length-a).split('|');
		cart = x;
		if(cart[0]=='') {cart = [];}
	}
}


function viewInStore(inm) {location = '/store/item.php?name='+inm;}

function removeFromCart(icd) {
	var newCart = []
	for(i=0;i<cart.length;++i) {
		if(cart[i]!=icd) {newCart.push(cart[i]);}
	}
	cart = newCart;
	cartToCookie();cartView();
}


function cartToCookie() {
	var x = '';
	for(i=0;i<cart.length;++i) {
		x += cart[i] + '|'
	}
	document.cookie = 'cart=' + x.substr(0,x.length-1) + '; path=/';
	console.log(document.cookie);
}

function visit(x) {
	if(x==1) {location='/store';}
	if(x==2) {location='/store/cart.php';}
	if(x==3) {location='/account';}
}

function store() {location='/';}

function getInfoX(inm,typ,dat) {
	var xhttp1 = new XMLHttpRequest();
	xhttp1.open("GET", '/admin/dbs/reader.php?name=' + inm + '&type=' + typ + '&data=' + dat, false);
	xhttp1.send();
	return (xhttp1.responseText);
}

cartView();
</script>




