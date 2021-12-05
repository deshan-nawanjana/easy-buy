

function addCart(typ) {
	for(i=0;i<lz.length;++i) {
		var ityp = lz[i][2];
		if(ityp==typ) {
			var icd = lz[i][0];
			var isOnCart = false;
			for(n=0;n<cart.length;++n) {
				if(cart[n]==icd) {isOnCart = true;}
			}
			if(!isOnCart) {
				cart.push(icd);
				cartToCookie();
				cartView();
				return;
			}
		}
	}
	

}


function cartToCookie() {
	var x = '';
	for(i=0;i<cart.length;++i) {
		x += cart[i] + '|'
	}
	document.cookie = 'cart=' + x.substr(0,x.length-1) + ';  path=/';
	console.clear()
	console.log(cart);

}

function cartView() {
	var x = '';
	var fprc = 0;
	for(i=0;i<cart.length;++i) {
		var k = getItemInfo(cart[i]);

		var i_nm = k[0];
		var i_cd = cart[i];
		var i_tp = k[1];
		var i_pr = k[2];

		fprc += parseInt(i_pr);

		x += '<div class="itm" style="background-image:url('+"'"+'/admin/img/'+i_nm+'.jpg'+"'"+')"><div class="ifn">';
		x += '<div class="rem" onclick="removeFromCart(this.lang)" lang="'+i_cd+'"></div>';
		x += '<span onclick="viewInStore(this.lang)" lang="'+i_nm+'">';
		x += '<div class="itp">'+ i_tp + '</div><div class="inm">'+ i_nm +'<br>'+getInfo(i_nm,i_tp,'size')+'</div><div class="ipr">'+'Rs. ' + i_pr + '.00</div></span>';
		x += '</div></div>';

	}
	id('cart').innerHTML = x;
	id('fprc').innerHTML = 'Rs. ' + fprc + '.00<br><br>';

}

function getItemInfo(icd) {
	for(j=0;j<lz.length;++j) {
		if(lz[j][0]==icd) {return [lz[j][1],lz[j][2],lz[j][3]];}
	}
}

function viewInStore(inm) {location = '/store/item.php?name='+inm;}

function removeFromCart(icd) {
	var newCart = []
	for(i=0;i<cart.length;++i) {
		if(cart[i]!=icd) {newCart.push(cart[i]);}
	}
	cart = newCart;
	cartToCookie();cartView();
}


function getInfo(inm,typ,siz) {
	var xhttp = new XMLHttpRequest();
	xhttp.open("GET", '/admin/dbs/reader.php?name=' + inm + '&type=' + typ + '&data=' + siz, false);
	xhttp.send();
	return xhttp.responseText;
}



function proceedCart() {
	location = '/store/cart.php';
}

function clearCart() {
	document.cookie = 'cart=; path=/';
	cart = [];
	cartView();
}

var cart = [];
var lc = document.cookie.split(';');
for(i=0;i<lc.length;++i) {
	if(lc[i].indexOf('cart=')>-1) {
		var x = lc[i];
		var a = lc[i].indexOf('cart=') + 5;
		x = x.substr(a,x.length-a).split('|');
		cart = x;
		if(cart[0]=='') {cart = [];}
	}
}
console.log(cart);
cartView();