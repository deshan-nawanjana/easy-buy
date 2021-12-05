<?php if(!isset($_COOKIE['admin'])) {echo '<script>location = "/admin/login.php";</script>';} ?>
<head><title>Reset Database</title></head>
<link rel="stylesheet" type="text/css" href="/_font/font.css">
<style>
body {
	font-family:Roboto-Light;
}
.t {
	padding:15px 0px;
	font-family:Roboto-Medium;
	font-size:22px;
}
</style>
<body>

<?php


	$servername = file_get_contents('sql/svr.inf');
	$username = file_get_contents('sql/usn.inf');
	$password = file_get_contents('sql/psw.inf');


$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error)		{}
else					{}

$sql = "CREATE DATABASE easy_buy";
if ($conn->query($sql) === TRUE)	{}
else					{}

$sql = "USE easy_buy";
if ($conn->query($sql) === TRUE)	{}
else					{}

$sql = "DROP TABLE customer";
if ($conn->query($sql) === TRUE)	{}
else					{}

$sql = "DROP TABLE item";
if ($conn->query($sql) === TRUE)	{}
else					{}

$tbl_cnt = 0;

$sql = "CREATE TABLE customer (
nic VARCHAR(10) PRIMARY KEY NOT NULL,
fnm VARCHAR(30) NOT NULL,
lnm VARCHAR(30) NOT NULL,
adr VARCHAR(200) NOT NULL,
mob VARCHAR(10) NOT NULL,
psw VARCHAR(20) NOT NULL,
act CHAR(1) NOT NULL,
pay INT(10) NOT NULL
)";

if($conn->query($sql) === TRUE)		{}
else					{}

$sql = "CREATE TABLE item (
icd VARCHAR(10) PRIMARY KEY NOT NULL,
inm VARCHAR(20) NOT NULL,
typ VARCHAR(15) NOT NULL,
prc INT(5) NOT NULL,
inf VARCHAR(200) NOT NULL,
sli VARCHAR(10) NOT NULL,
sld VARCHAR(10) NOT NULL
)";

if($conn->query($sql) === TRUE)		{}
else					{}

echo '<div class="t">Rest Complete!</div>';




$conn->close();




?> 