<?php if(!isset($_COOKIE['admin'])) {echo '<script>location = "/admin/login.php";</script>';} ?>

<?php


	$servername = file_get_contents('../admin/tools/sql/svr.inf');
	$username = file_get_contents('../admin/tools/sql/usn.inf');
	$password = file_get_contents('../admin/tools/sql/psw.inf');

$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error)		{echo '<div class="l e">'.$conn->connect_error.'</div>';}
$sql = "USE easy_buy";
if ($conn->query($sql) === TRUE)	{}
else					{echo '<div class="l e">'.$conn->error.'</div>';}


if(isset($_POST['cnf'])) {
	$sql = "UPDATE customer SET act='y' WHERE nic='".$_POST['cnf']."';";
	if($conn->query($sql)===TRUE) {}
	else {echo '<div class="l e">'.$conn->error.'</div>';}
}
if(isset($_POST['dlr'])) {
	$sql = "DELETE FROM customer WHERE nic='".$_POST['dlr']."';";
	if($conn->query($sql)===TRUE) {}
}

?>













<!doctype html>
<head>
<title>Confirm or Declare Account</title>
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
.itm {
	background:rgba(0,0,0,0.1);
	width:600px;
	padding:15px;
	border-radius:4px;
	margin-bottom:15px;
	height:195px;
}
.i {
	height:30px;
}
.l {
	width:120px;
	float:left;
	height:30px;
	font-family:Roboto-Medium;
}
.d {
	width:280px;
	float:right;
	height:30px;
}
.ni {
	float:left;
	width:130px;
	height:135px;
	margin-right:15px;
	border-radius:4px;
	background-size:130px 135px;
	cursor:pointer;
	overflow:hidden;
}
.nf {
	width:130px;
	height:135px;
	line-height:135px;
	text-align:center;
	background:rgba(0,0,0,0.7);
	font-family:Roboto-Light;
	color:#FFF;
	transition:all 0.1s;
}
.nf:hover {background:rgba(0,0,0,0.8);}
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
	float:right;
	margin-left:15px;
}
.btn:hover {background:#335c72;opacity:1;}
.btn:active {background:#244658;}
.bx {
	width:670px;
	height:450px;
	overflow-y:scroll;
}
</style>
</head>
<body>
<div class="t">Account Confirmations</div>

<?php


$sql = 'select * from customer';
$tbl = $conn->query($sql);

$html = '';
if ($tbl->num_rows > 0) {
	while($row = $tbl->fetch_assoc()) {
		if($row["act"]=='n') {
			$html .= '<div class="itm"><div lang="/account/pic/'.$row["nic"].'.jpg" class="ni" style="background-image:url(/account/pic/'.$row["nic"].'.jpg)" onclick="viewIMG(this.lang)"><div class="nf">View Image</div></div>';
			$html .= '<div class="i"><div class="l">NIC No.</div><div class="d">'.		$row["nic"] .'</div></div>';
			$html .= '<div class="i"><div class="l">First Name</div><div class="d">'.	$row["fnm"] .'</div></div>';
			$html .= '<div class="i"><div class="l">Last Name</div><div class="d">'.	$row["lnm"] .'</div></div>';
			$html .= '<div class="i"><div class="l">Address</div><div class="d">'.		$row["adr"] .'</div></div>';
			$html .= '<div class="i"><div class="l">Mobile</div><div class="d">'.		$row["mob"] .'</div></div>';


			$html .= '<form action="confirm.php" method="post">';
			$html .= '<input type="hidden" name="cnf" value="'.$row["nic"].'">';
			$html .= '<input class="btn" type="submit" value="Confirm"></form>';

			$html .= '<form action="confirm.php" method="post">';
			$html .= '<input type="hidden" name="dlr" value="'.$row["nic"].'">';
			$html .= '<input class="btn" type="submit" value="Declare"></form>';
			$html .= '</div>';
		}
	}
	echo '<div class="bx">' . $html . '</div>';
}


?>


<script>
function viewIMG(x) {window.open(x);}
</script>
