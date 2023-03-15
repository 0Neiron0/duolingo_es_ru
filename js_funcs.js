
// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}

//---------------------------------------httpGet--------------------------------------         
 function httpGet(theUrl)
{
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open( "GET", theUrl, false ); // false for synchronous request
    xmlHttp.send( null );
    return xmlHttp.responseText;
}
//---------------------------------------add_word--------------------------------------      
function add_word(par,ch) {
	//alert($(this).val());
	const a = par.split(";");
	//alert(ch);
	if (ch == true ) {
		url = 'conn.php?act=ins&es='+a[0]+'&ru='+a[1];
	} else {
		url = 'conn.php?act=del&es='+a[0]+'&ru='+a[1];
	}
	r=httpGet(url);
	//alert(r);
	//alert(url);
	//var val = $(this).val(); 
    //console.log("got:"+par);
	//console.log( par.text() );
	//console.log(par.target.value);
}  