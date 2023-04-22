<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<title>Words for learn</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="stylesheet" href="">
	<!-- ? my styles ? -->
	 <link rel="stylesheet" href="style.css" />

<style>
</style>
<script src=""></script>
<!-- ? Load CSS file for DataTables  -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/jquery.dataTables.min.css"
      integrity="sha512-1k7mWiTNoyx2XtmI96o+hdjP8nn0f3Z2N4oF/9ZZRgijyV4omsKOXEnqL1gKQNPy2MTSP9rIEWGcH/CInulptA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <!-- ? load jQuery ? -->
    <script
      src="https://code.jquery.com/jquery-3.6.0.min.js"
      integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
      crossorigin="anonymous"
    ></script>

    <!-- ? load DataTables ? -->
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"
      integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>
	<!-- ? my fucctions ? -->
    <script type="text/javascript"
      src="js_funcs.js"
    ></script>
<script>
let DEBUG=true;
//---------------------------------------check_grammar--------------------------------------      
function check_grammar() {
           //á ó ú ñ
			//onsole.log("d="+DEBUG);
			var s_in = document.activeElement.value;
			var s_org = document.activeElement.id;
            var s=s_org.toLowerCase();
			var s_sec="";
			if(DEBUG) { console.log("source="+s_org+"; input="+s_in); }
			s=s.replace(/á/gi,"a");
			s=s.replace(/ó/gi,"o");
			s=s.replace(/ñ/gi,"n");
			s=s.replace(/ú/gi,"u");
			s=s.replace(/í/gi,"i");
			s=s.replace(/é/gi,"e");
			s=s.replace("?","");
			s=s.replace("¿","");
			
			s_idx=s.indexOf(' ');
			if(s_idx==0) s=s.substr(1);
			if ( s_idx > 0) {
				//alert(s_in+" str="+s_idx+"comp="+s_in.substr(s_idx+1));
				s_sec=s.substr(s_idx+1);
			}
			//document.getElementById("rr").innerHTML = s+"Your answer is " + p;
			
			if (s==s_in.toLowerCase() || s_sec==s_in.toLowerCase() ) {
			//right
				document.activeElement.style.color='grey';
				//alert(document.activeElement.style.color);
			}
			else document.activeElement.style.color='red';
         }   
		 
//---------------------------------------END check_grammar--------------------------------------
//---------------------------------------httpGet--------------------------------------         
 function httpGet(theUrl)
{
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open( "GET", theUrl, false ); // false for synchronous request
    xmlHttp.send( null );
    return xmlHttp.responseText;
}

function rem_word(p_id) {
	//alert(p_id);
	//const a = par.split(";");
	url = 'conn.php?act=del_es&es='+p_id;
	//alert(url);
	r=httpGet(url);
	//alert(r);
	location.reload();
}	
</script>





<body>
 <h1 class="n"> Neiron&copy;  </h1>

 <ul>
  <li><a href="index.php">Home</a></li>
  <li><a href="conn.php">Show table</a></li>
  <li><a href="conn.php?act=ins&es=ES&ru=RU">Ins table</a></li>
  <li><a href="conn1.php">Show clone table</a></li>
  <li><a id ="cloneLink" href="conn.php?act=clone">Clone table</a></li>
  <li><a id="clearTableLink" style="background-color: red; color:#ffff03;" href="conn.php?act=clr">Clear table</a></li>
</ul> 

<button onclick="topFunction()" id="myBtn" title="Go to top" style="display:none">Top</button>
<!--<img src="img_la.jpg" alt="LA" style="width:100%">
!-->
<div class="">
 <!--<p><a href="index.php">Home</a>    <a href="conn.php?act=clr">Clear table</a> <a href="conn.php">Show table</a> <a href="conn.php?act=ins&es=ES&ru=RU">Ins table</a></p>
!-->
<?php

$word_table="words";
session_start(); 

function clr_tbl(){
	global $mysqli,$word_table;
	$res = $mysqli->query("delete from ".$word_table.";",MYSQLI_USE_RESULT);
}
function clone_tbl(){
	global $mysqli,$word_table;
	$res = $mysqli->query("drop table ".$word_table."_c;",MYSQLI_USE_RESULT);
	$res = $mysqli->query("create table ".$word_table."_c as select * from ".$word_table.";",MYSQLI_USE_RESULT);
}

function ins_word($p_es,$p_ru,$p_id=null){
	global $mysqli,$word_table;
	if ($p_id) $sql="insert into ".$word_table." values(".$p_id.",'".$p_es."','".$p_ru."');";
	else $sql="insert into ".$word_table." values(null,'".$p_es."','".$p_ru."');";
	$res = $mysqli->query($sql,MYSQLI_USE_RESULT);
	if (!$res) {echo "sql INSERT query error:".$sql; $mysqli->close();  exit(0);}
}

function del_word($p_es,$p_ru){
	global $mysqli,$word_table;
	$sql="delete from ".$word_table." where es_name='".$p_es."' and ru_name='".$p_ru."'";;
	$res = $mysqli->query($sql);
	if (!$res) {echo "sql DELETE query error:".$sql; $mysqli->close();  exit(0);}
	//return $sql;
}

function del_word_es($p_es){
	global $mysqli,$word_table;
	$sql="delete from ".$word_table." where es_name='".$p_es."'";
	$res = $mysqli->query($sql);
	if (!$res) {echo "sql DELETE ES query error:".$sql; $mysqli->close();  exit(0);}
	//return $sql;
}








include 'd.php';
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$mysqli = new mysqli($host,$dbuser,$dbpass,$db);
$mysqli->set_charset("utf8");
$act="";

if (isset ( $_GET["act"] ) ) {
	$act=htmlspecialchars($_GET["act"]);
	//echo '<p>you want to ' . $act . '!</p>';

	if ($act == 'clr') clr_tbl();
	
	if ($act == 'ins') {
		$es=htmlspecialchars($_GET["es"]);
		$ru=htmlspecialchars($_GET["ru"]);	
		ins_word($es,$ru);
	}	
	
	if ($act == 'del') {
		$es=htmlspecialchars($_GET["es"]);
		$ru=htmlspecialchars($_GET["ru"]);	
		del_word($es,$ru);
		//echo ">>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>";
		
	}	
	if ($act == 'del_es') {
		$es=htmlspecialchars($_GET["es"]);
		del_word_es($es);
		//echo ">>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>";
		
	}	
	if ($act == 'clone') {

		clone_tbl();
		//echo ">>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>";
		
	}		
}
//echo "start</br>";




$res = $mysqli->query("select * from words",MYSQLI_USE_RESULT);
if (!$res) {echo "sql query error"; $mysqli->close();  exit(0);}

echo "<table>";

While($row = $res->fetch_assoc()) {	
	//print_r($row);
	$est=$row["es_name"];
	$est_c='<input autocomplete="off" type = "text" value="" style="color: #FF0000; font-size:16px" id="'.$est.'" oninput="check_grammar()" >';
	echo "<tr>";
	echo '<td style="color: grey; font-size:16px">'.$est."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>".
	'<td style="font-size:18px">'.$row["ru_name"]."</td>"
	."<td>".$est_c.'<button class="button-8" id="'.$est.'" role="button"  onclick="rem_word(this.id)" >remove</button>'."</td>"
	;
	echo "</tr>";
	

}

$mysqli->close();
//echo "end</br>";

?> 
</table>
 
 
</div>




<script>
  const cloneLink = document.getElementById('cloneLink');
  const clearTableLink = document.getElementById('clearTableLink');

  cloneLink.addEventListener('click', (event) => {
    const confirmed = confirm('Are you sure you want to clone table?');
    if (!confirmed) {
      event.preventDefault();
    }
  });

  clearTableLink.addEventListener('click', (event) => {
    const confirmed = confirm('Are you sure you want to clear table?');
    if (!confirmed) {
      event.preventDefault();
    }
  });
</script>
</body>
</html> 
