<?php if(!isset($_COOKIE['admin'])) {echo '<script>location = "/admin/login.php";</script>';} ?>
<style>
item {display:none;}
</style>


<div id="upd"></div>






<?php

if(isset($_POST['inf'])) {

	$servername = file_get_contents('../admin/tools/sql/svr.inf');
	$username = file_get_contents('../admin/tools/sql/usn.inf');
	$password = file_get_contents('../admin/tools/sql/psw.inf');

	$conn = new mysqli($servername, $username, $password);
	if ($conn->connect_error)		{echo "<script>alert('Connection Error');</script>";}
	$sql = "USE easy_buy";
	if ($conn->query($sql) === TRUE)	{}
	else					{echo "<script>alert('Database Error');</script>";}

	$icd = $_POST['icd'];
	$inm = $_POST['inm'];
	$typ = $_POST['typ'];
	$prc = $_POST['prc'];
	$inf = $_POST['inf'];

	$sql = "INSERT INTO item(icd,inm,typ,prc,inf,sli,sld) VALUES('".$icd."','".$inm."','".$typ."','".$prc."','".$inf."',0,0)";
	if(!$conn->query($sql)===TRUE) {echo "<script>alert('Update error!x');</script>";}
}




?>








<!doctype html>
<head>
<title>Store Update Panel</title>
<link rel="stylesheet" type="text/css" href="/_font/font.css">
<style>
body {
	font-family:Roboto-Light;
}
table {
}
.tblbox {
	float:right;
	height:450px;
	overflow-y:scroll;
}
tr {
	background:rgba(0,0,0,0.05);
}
td {
	padding:5px;
	font-size:12px;
}
.r {
	text-align:right;
}
.t {
	padding:15px 0px;
	font-family:Roboto-Medium;
	font-size:22px;
}
.drop {
	height:35px;
	margin-bottom:8px;
	border:1px solid #888;
	border-radius:4px;
	padding:2px 5px;
	font-family:Roboto-Light;
	font-size:11px;
	color:#333;
	background:rgba(255,255,255,0.75);
	transition:all 0.1s;
}
.btn {
	width:150px;
	height:42px;
	border:none;
	border-radius:4px;
	font-family:Roboto-Light;
	font-size:16px;
	color:#FFF;
	transition:all 0.1s;
	background:#244658;
	opacity:0.85;
}
.btn:hover {background:#335c72;opacity:1;}
.btn:active {background:#244658;}
.d {
	font-family:Roboto-Medium;
	margin-bottom:15px;
}
</style>
</head>
<body>
<div class="t">Update Store</div>

<div class="tblbox"><table border="0" id="tbl"></table></div>


<select class="drop" id="inm" onchange="stepFill();autoFill();"></select>
<select class="drop" id="typ" onchange="autoFill();"></select>

<form action="update.php" method="post">
<input type="hidden" name="icd" readonly>
<input type="hidden" name="inm" placeholder="Item Name">
<input type="hidden" name="typ" placeholder="Item Type">
<input type="hidden" name="inf" placeholder="Item Info">
<input type="hidden" name="prc" placeholder="Item Price">
<input class="btn" type="submit" value="Add to Database">
</from>

<br>



<img id="img" width="220">
<div class="d"></div>
<div class="d"></div>










<script>
function id(x) {return document.getElementById(x);}


var xhttp0 = new XMLHttpRequest();
xhttp0.open("GET", "/admin/dbs/updater.php", false);
xhttp0.send();
var x = xhttp0.responseText;
do {x = x.replace('`','\n');} while(x.indexOf('`')>-1);
id('upd').innerHTML = x;




function sd() {
	document.getElementsByClassName('d')[0].innerHTML = nm('inm').value + '<br><small>' + nm('inf').value + '</small>';
	document.getElementsByClassName('d')[1].innerHTML = '<big>Rs. ' + nm('prc').value + '.00</big>';
}



function nm(x) {
	var l = document.getElementsByTagName('input');
	for(i=0;i<l.length;++i) {if(l[i].name==x){return l[i];}}
}
function itm(x) {
	var l = document.getElementsByTagName('item');
	for(i=0;i<l.length;++i) {
		if(l[i].getAttribute('name')==x) {return l[i];}
	}
}



function setupItemNames() {
	var x = '';
	var l = document.getElementsByTagName('item');
	for(i=0;i<l.length;++i) {
		var nm = l[i].getAttribute('name');
		x += '<option value="'+nm+'">'+nm+'</option>';
	}
	id('inm').innerHTML = x;
}

setupItemNames();

function stepFill() {
	var x = '';
	var inm = id('inm').value;
	var l = itm(inm).innerHTML.split('\n');
	for(i=1;i<l.length-1;++i) {
		var lx  = l[i].split('|');
		var typ = lx[0];
		var siz = lx[1];
		var prc = lx[2];
		x += '<option value="'+typ+'" size="'+siz+'" price="'+prc+'">'+typ+'</option>';
	}
	id('typ').innerHTML = x;

	nm('inf').value = itm(id('inm').value).getAttribute('info');
}

var lastX = -1;

function autoFill() {
	lastX = -1;
	var x = '';
	var inm = id('inm').value;
	var l = itm(inm).innerHTML.split('\n');
	for(i=1;i<l.length-1;++i) {
		var lx  = l[i].split('|');
		var typ = lx[0];
		var siz = lx[1];
		var prc = lx[2];
		if(id('typ').value==typ) {
			nm('inm').value = id('inm').value;
			nm('typ').value = typ;
			nm('prc').value = prc;
			id('img').src = 'img/' + id('inm').value + '.jpg';
		}
		if(lastX==i) {return;}
		lastX = i;
	}
	sd();
}










function tg(x) {return document.getElementsByTagName(x);}

var xhttp = new XMLHttpRequest();
xhttp.open("GET", "full_store_ajax.php", false);
xhttp.send();
var l = xhttp.responseText.split('`');
var cid = l.length.toString();
do {cid = '0' + cid;} while(cid.length<10)
tg('input')[0].value = cid;

var x = '';
for(i=l.length-2;i>-1;--i) {
	var t = l[i].split('|');
	x += '<tr><td>'+t[0]+'</td><td>'+t[1]+'</td><td>'+t[2]+'</td><td class="r">'+t[3]+'.00</td><td>'+t[4]+'</td></tr>';
}

stepFill();autoFill();

if(l.length>1) {
	var t = l[l.length-2].split('|');
	nm('inm').value = t[1];
	nm('typ').value = t[2];
	nm('prc').value = t[3];
	nm('inf').value = t[4];
	id('img').src = 'img/' + nm('inm').value + '.jpg';


	for (var i = 0; i < id('inm').options.length; i++) {
		if (id('inm').options[i].text===t[1]) {id('inm').selectedIndex = i;break;}
	}
	stepFill();
	for (var i = 0; i < id('typ').options.length; i++) {
		if (id('typ').options[i].text===t[2]) {id('typ').selectedIndex = i;break;}
	}

}


id('tbl').innerHTML = x;
sd();
</script>











