var xhttp = new XMLHttpRequest();
xhttp.open("GET", "/admin/store_ajax.php", false);
xhttp.send();
var l = xhttp.responseText.split('`');

for(i=0;i<l.length;++i) {
	l[i] = l[i].split('|');
}

var lx = [];

for(i=0;i<l.length-1;++i) {
	var isAdded = false;
	for(n=0;n<lx.length;++n) {
		if(lx[n][0]==l[i][1]) {
			var isTypAdded = false;
			var ly = lx[n][1];
			for(z=0;z<ly.length;++z) {if(ly[z]==l[i][2]) {isTypAdded = true;}}
			if(!isTypAdded) {lx[n][1].push(l[i][2]);}
			isAdded=true;
		}
	}
	if(!isAdded) {lx.push([l[i][1],[l[i][2]]]);}
}

var lz = l;
l = lx;