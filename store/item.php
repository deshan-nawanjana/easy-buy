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
<title><?php echo $_GET['name'] ?></title>
<script src="item_builder.js"></script>
<script>var inm = '<?php echo $_GET['name'] ?>';</script>
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
#cart_box {
	float:right;
	width:400px;
}
#cart_box {
	float:left;
	width:400px;
	background:#333;
	height:520px;
	position:fixed;
	margin-top:20px;
	left:0px;
	transition:all 0.2s;
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
.item_box {
	padding:22px 0px 80px 430px;
}
.btn {
	width:200px;
	height:52px;
	border:none;
	border-radius:4px;
	font-family:Roboto-Light;
	font-size:20px;
	color:#FFF;
	transition:all 0.1s;
	background:#244658;
	opacity:0.85;
}
.btn:hover {background:#335c72;opacity:1;}
.btn:active {background:#244658;}
</style>
</head>
<body>

<div class="upper">
<div class="logo" onclick="store()"><span class="lg_1">easy</span><span class="lg_2">Buy</span></div>
<div class="title"></div>
<div class="tab" onclick="visit(1)">Store</div>
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

<div class="item_box">

<div class="itmx">
<div class="itm_title" id="nm"><?php echo $_GET['name'] ?></div>
<div class="itm_img" id="img"></div>
</div>

<div class="slct">Select the type you want</div>

<select id="typ" class="drop" onchange="setQTY();setInfo();" onclick="setQTY();setInfo();"></select>

<div class="lbi">
<div class="lbt">Size</div>
<div class="lbd" id="lb1"></div>
</div>
<div class="lbi">
<div class="lbt">Price</div>
<div class="lbd" id="lb2"></div>
</div>

<br>

<div class="avb">Available : <span id="max"></span> Pieces<br></div>
<input class="btn" type="button" value="+ Add to Cart" onclick="addCartStep();">

</div>

<style>
.lbi {
	width:260px;
	overflow:hidden;
	padding:8px 8px 0px 0px;
}
.lbt {
	font-family:Roboto-Light;
	width:80px;
	overflow:hidden;
	display:inline-block;
}
.lbd {
	font-family:Roboto-Medium;
	width:120px;
	overflow:hidden;
	display:inline-block;
}
.avb {
	font-family:Roboto-Medium;
	margin-bottom:20px;
}
.itmx {
	width:350px;
	height:450px;
	box-shadow:2px 2px 10px rgba(0,0,0,0.2);
	padding:20px;
	margin-right:30px;
	float:left;
	background:#FFF;
}
.slct {
	font-family:Roboto-Medium;
	font-size:20px;
	margin:20px 0px;
}
.itm_title {
	color:#333;
	font-family:Roboto-Regular;
	font-size:23px;
}
.itm_img {
	float:left;
	width:350px;
	height:420px;
	background-size:350px 350px;
	background-repeat:no-repeat;
	background-position:center;
}
.drop {
	width:300px;
	height:55px;
	margin-bottom:8px;
	border:1px solid #888;
	border-radius:4px;
	padding:8px 15px;
	font-family:Roboto-Light;
	font-size:20px;
	color:#333;
	background:rgba(255,255,255,0.75);
	transition:all 0.1s;
}
</style>

<script>

function setInfo() {
	var sz = getInfoX('size');
	console.log(sz);
	id('lb1').innerHTML = sz;
	id('lb2').innerHTML = 'Rs. ' + getInfoX('price') + '.00';
}





function id(x) {return document.getElementById(x);}

id('img').style.backgroundImage = "url('/admin/img/"+id('nm').innerHTML+".jpg')";

var lx = [];

for(i=0;i<l.length;++i) {
	if(l[i][0]==inm) {lx.push(l[i]);}
}

lj = lx[0][1];
var x = '';
for(i=0;i<lj.length;++i) {
	x += '<option>'+lj[i]+'</option>';
}
id('typ').innerHTML = x;



function setQTY() {
	setInfo();
	var q = 0;
	var t = id('typ').value;
	for(i=0;i<lz.length;++i) {if(lz[i][2]==t) {q+=1;}}
	id('max').innerHTML = q;
}
setQTY();


function addCartStep() {
	addCart(id('typ').value);
}



function visit(x) {
	if(x==1) {location='/store';}
	if(x==2) {location='/store/cart.php';}
	if(x==3) {location='/account';}
}

var rr = 1;

function getInfoX(x) {
	var xhttp1 = new XMLHttpRequest();
	xhttp1.open("GET", '/admin/dbs/reader.php?name=' + document.title + '&type=' + id('typ').value + '&data=' + x + '&r=' + rr, false);
	xhttp1.send();
	console.log('http://localhost/admin/dbs/reader.php?name=' + document.title + '&type=' + id('typ').value + '&data=' + x + '&r=' + rr);
	return (xhttp1.responseText);
}


function store() {location='/';}
setInfo();
</script>




<script src="cart.js"></script>
