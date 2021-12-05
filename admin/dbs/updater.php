<?php

$xml = simplexml_load_file("items.xml") or die("XML ERROR!");

$z = '';

$x = 0;
while($x < $xml->item->count()) {

	$nm = $xml->item[$x]['name'];
	$in = $xml->item[$x]['info'];

	$z .= '<item name="'.$nm.'" info="'.$in.'">`';

	$y = 0;
	while($y < $xml->item[$x]->type->count()) {
		$ty = $xml->item[$x]->type[$y]['name'];
		$si = $xml->item[$x]->type[$y]['size'];
		$pr = $xml->item[$x]->type[$y]['price'];
		$z .= $ty.'|'.$si.'|'.$pr.'`';
		$y++;
	}
	$z .= '</item>`';
	$x++;
}

echo $z;

?>