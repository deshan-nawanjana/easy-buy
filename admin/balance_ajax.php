<?php

	$servername = file_get_contents('../admin/tools/sql/svr.inf');
	$username = file_get_contents('../admin/tools/sql/usn.inf');
	$password = file_get_contents('../admin/tools/sql/psw.inf');

$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error)		{echo '<div class="l e">'.$conn->connect_error.'</div>';}
$sql = "USE easy_buy";
if ($conn->query($sql) === TRUE)	{}
else					{echo '<div class="l e">'.$conn->error.'</div>';}
$tbl_name = 'item';

$sql = 'SELECT * FROM item WHERE sli="'.$_COOKIE['nic'].'"';
$tbl = $conn->query($sql);

echo $conn->error;

$prc = 0;

if ($tbl->num_rows > 0) {
while($row = $tbl->fetch_assoc()) {
	$prc += $row["prc"];
	}
}

$sql = 'SELECT * FROM customer WHERE nic="'.$_COOKIE['nic'].'"';
$tbl = $conn->query($sql);

$pay = 0;

if ($tbl->num_rows > 0) {
while($row = $tbl->fetch_assoc()) {
	$pay = $row["pay"];
	}
}




echo $prc - $pay;







?>