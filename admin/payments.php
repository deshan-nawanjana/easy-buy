<?php if(!isset($_COOKIE['admin'])) {echo '<script>location = "/admin/login.php";</script>';} ?>
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
	font-family:Roboto-Light;
}
th {
	padding:5px 10px;
	font-weight:inherit;
	font-family:Roboto-Medium;
	font-size:14px;
}
td {
	padding:5px 10px;
	font-size:12px;
}
img {
	height:60px;
}
.btn {
	width:150px;
	height:32px;
	border:none;
	border-radius:4px;
	font-family:Roboto-Light;
	font-size:14px;
	color:#FFF;
	transition:all 0.1s;
	background:#244658;
	opacity:0.85;
}
.btn:hover {background:#335c72;opacity:1;}
.btn:active {background:#244658;}
.t {
	padding:15px 0px;
	font-family:Roboto-Medium;
	font-size:22px;
}
</style>
<link rel="stylesheet" type="text/css" href="/_font/font.css">


<div class="t">Payments</div>

<?php










	$servername = file_get_contents('../admin/tools/sql/svr.inf');
	$username = file_get_contents('../admin/tools/sql/usn.inf');
	$password = file_get_contents('../admin/tools/sql/psw.inf');


$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error)		{echo '<div class="l e">'.$conn->connect_error.'</div>';}


$sql = "USE easy_buy";
if ($conn->query($sql) === TRUE)	{}
else					{echo '<div class="l e">'.$conn->error.'</div>';}


if(isset($_POST['nic'])) {
	$nic = $_POST['nic'];
	$pay = $_POST['pay'];
	$sql = 'UPDATE customer SET pay='.$pay.' WHERE nic="'.$nic.'";';
	if($conn->query($sql)===TRUE) {}
}





$sql = 'select * from customer';
$tbl = $conn->query($sql);

	$html = '<table border="0">';
	$html .= '<tr>
	<th>NIC No.</th>
	<th>Name</th>
	<th>mob</th>
	<th>Total Brought</th>
	<th>Total Pay</th>
	<th>Balance</th>
	<th>set</th>
	</tr>';
	if ($tbl->num_rows > 0) {
   	 while($row = $tbl->fetch_assoc()) {

		$sql0 = 'SELECT * FROM item WHERE sli="'.$row["nic"].'"';
		$tbl0 = $conn->query($sql0);
		$prc = 0;
		if ($tbl0->num_rows > 0) {while($row0 = $tbl0->fetch_assoc()) {$prc += $row0["prc"];}}



		$html .= '<tr>';
		$html .= '<td>'. $row["nic"] .'</td>';
		$html .= '<td>'. $row["fnm"] .' '. $row["lnm"] .'</td>';
		$html .= '<td>'. $row["mob"] .'</td>';
		$html .= '<td>'. $prc .'</td>';
		$html .= '<td>'. $row["pay"] .'</td>';
		$html .= '<td>'. ((int)$prc - (int)$row["pay"]) .'</td>';
		$html .= '<td><form action="payments.php" method="post"><input type="hidden" name="nic" value="'.$row["nic"].'"><input type="hidden" name="pay" value="'.$prc.'"><input class="btn" type="submit" value="Settle"></form></td>';
	    }
		echo $html . '</table>';
	}
	else {echo "Table is Empty";}




$conn->close();

?>








