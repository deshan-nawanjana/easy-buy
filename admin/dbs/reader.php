<?php

$nm = $_GET['name'];
$tp = $_GET['type'];
$dt = $_GET['data'];


$xml = simplexml_load_file("items.xml") or die("XML ERROR!");

$x = 0;
while($x < $xml->item->count()) {
	$t_nm = $xml->item[$x]['name'];
	if($t_nm == $nm) {
		$y = 0;
		while($y < $xml->item[$x]->type->count()) {
			$t_tp = $xml->item[$x]->type[$y]['name'];
			if($t_tp == $tp) {
				echo $xml->item[$x]->type[$y][$dt];
			}
			$y++;
		}
	}
	$x++;
}

?>