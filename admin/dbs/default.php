<?php if(!isset($_COOKIE['admin'])) {echo '<script>location = "/admin/login.php";</script>';} ?>
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

<?php

	$servername = file_get_contents('../tools/sql/svr.inf');
	$username = file_get_contents('../tools/sql/usn.inf');
	$password = file_get_contents('../tools/sql/psw.inf');

$conn = new mysqli($servername, $username, $password);
$sql = "USE easy_buy";
if ($conn->query($sql) === TRUE) {}

$sql = "DROP TABLE customer";
if ($conn->query($sql) === TRUE) {}

$sql = "DROP TABLE item";
if ($conn->query($sql) === TRUE) {}

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

if($conn->query($sql) === TRUE)	{}

$sql = "CREATE TABLE item (
icd VARCHAR(10) PRIMARY KEY NOT NULL,
inm VARCHAR(20) NOT NULL,
typ VARCHAR(15) NOT NULL,
prc INT(5) NOT NULL,
inf VARCHAR(200) NOT NULL,
sli VARCHAR(10) NOT NULL,
sld VARCHAR(10) NOT NULL
)";

if($conn->query($sql) === TRUE)	{}










$xml = simplexml_load_file("items.xml") or die("XML ERROR!");

$z = 1;

$x = 0;
while($x < $xml->item->count()) {

	$inm = $xml->item[$x]['name'];
	$inf = $xml->item[$x]['info'];
	$y = 0;
	while($y < $xml->item[$x]->type->count()) {
		$typ = $xml->item[$x]->type[$y]['name'];
		$prc = $xml->item[$x]->type[$y]['price'];


		$icd = (string)$z;
		while(strlen($icd)<10) {$icd = '0' . $icd;} 
		$sql = "INSERT INTO item(icd,inm,typ,prc,inf,sli,sld) VALUES('".$icd."','".$inm."','".$typ."','".$prc."','".$inf."',0,0)";
		if(!$conn->query($sql)===TRUE) {echo $conn->error . '<hr>';}
		$z++;

		$icd = (string)$z;
		while(strlen($icd)<10) {$icd = '0' . $icd;} 
		$sql = "INSERT INTO item(icd,inm,typ,prc,inf,sli,sld) VALUES('".$icd."','".$inm."','".$typ."','".$prc."','".$inf."',0,0)";
		if(!$conn->query($sql)===TRUE) {echo $conn->error . '<hr>';}
		$z++;

		$icd = (string)$z;
		while(strlen($icd)<10) {$icd = '0' . $icd;} 
		$sql = "INSERT INTO item(icd,inm,typ,prc,inf,sli,sld) VALUES('".$icd."','".$inm."','".$typ."','".$prc."','".$inf."',0,0)";
		if(!$conn->query($sql)===TRUE) {echo $conn->error . '<hr>';}
		$z++;


		$y++;
	}

	$x++;
}

echo '<div class="t">Default Store Database Set!</div>';

?>