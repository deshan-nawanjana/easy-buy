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
	setcookie('nic', 'null', time() + (86400 * 30), "/");
	if(isset($_COOKIE['cart'])) {setcookie('cart', '', time() + (86400 * 30), "/");}
?>
<script>location='login.php';</script>