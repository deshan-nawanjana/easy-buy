function nm(x) {
	var l = document.getElementsByTagName('input');
	for(i=0;i<l.length;++i) {if(l[i].name==x){return l[i];}}
}


nm('nic').value = "123456789V";
nm('fnm').value = "Sarath";
nm('lnm').value = "Kumara";
nm('adr').value = "Baththuluoya";
nm('mob').value = "0777123456";
nm('psw').value = "1234";
nm('rpw').value = "1234";


nm('l_nic').value = "123456789V";
nm('l_psw').value = "1234";