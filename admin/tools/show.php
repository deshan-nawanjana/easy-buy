<?php if(!isset($_COOKIE['admin'])) {echo '<script>location = "/admin/login.php";</script>';} ?>
<head><title>Show Table</title></head>
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
th, td {
	padding:10px;
	font-family:consolas;
}
img {
	height:60px;
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
.t {
	padding:15px 0px;
	font-family:Roboto-Medium;
	font-size:22px;
}
.tbx {
	height:350px;
	overflow-y:scroll;
}
</style>
<script>
function show(x) {location = x;}
</script>
<body>

<div class="t">Database System</div>

<input type="button" class="btn" onclick="show('?name=customer')" value="CUSTOMER">
<input type="button" class="btn" onclick="show('?name=item')" value="ITEM">

<br><br>

<?php


	$servername = file_get_contents('sql/svr.inf');
	$username = file_get_contents('sql/usn.inf');
	$password = file_get_contents('sql/psw.inf');


$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error)		{echo '<div class="l e">'.$conn->connect_error.'</div>';}


$sql = "USE easy_buy";
if ($conn->query($sql) === TRUE)	{}
else					{echo '<div class="l e">'.$conn->error.'</div>';}


$tbl_name = $_GET['name'];


$sql = 'select * from '.$tbl_name;
$tbl = $conn->query($sql);

if($tbl_name=='customer') {
	$html = '<div class="tbx"><table border="0">';
	$html .= '<tr>
	<th>nic</th>
	<th>fnm</th>
	<th>lnm</th>
	<th>adr</th>
	<th>mob</th>
	<th>psw</th>
	<th>act</th>
	<th>pay</th>
	</tr>';
	if ($tbl->num_rows > 0) {
   	 while($row = $tbl->fetch_assoc()) {
		$html .= '<tr>';
		$html .= '<td>'. $row["nic"] .'</td>';
		$html .= '<td>'. $row["fnm"] .'</td>';
		$html .= '<td>'. $row["lnm"] .'</td>';
		$html .= '<td>'. $row["adr"] .'</td>';
		$html .= '<td>'. $row["mob"] .'</td>';
		$html .= '<td>'. $row["psw"] .'</td>';
		$html .= '<td>'. $row["act"] .'</td>';
		$html .= '<td>'. $row["pay"] .'</td>';
	    }
		echo $html . '</table></div>';
	}
	else {echo "CUSTOMER Table is Empty";}
}


if($tbl_name=='item') {
	$html = '<div class="tbx"><table border="0">';
	$html .= '<tr>
	<th>icd</th>
	<th>inm</th>
	<th>typ</th>
	<th>prc</th>
	<th>inf</th>
	<th>sli</th>
	<th>sld</th>
	</tr>';
	if ($tbl->num_rows > 0) {
   	 while($row = $tbl->fetch_assoc()) {
		$html .= '<tr>';
		$html .= '<td>'. $row["icd"] .'</td>';
		$html .= '<td>'. $row["inm"] .'</td>';
		$html .= '<td>'. $row["typ"] .'</td>';
		$html .= '<td>'. $row["prc"] .'</td>';
		$html .= '<td>'. $row["inf"] .'</td>';
		$html .= '<td>'. $row["sli"] .'</td>';
		$html .= '<td>'. $row["sld"] .'</td>';
	    }
		echo $html . '</table></div>';
	}
	else {echo "ITEM Table is Empty";}
}


$conn->close();

?>