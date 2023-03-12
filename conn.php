<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<title>Page Title</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="stylesheet" href="">

<style>
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: white;
}

li {
  float: left;
  font-size: 30px;
}

li a {
	background-color: grey;
  display: block;
  color: blue;
  text-align: center;
  padding: 20px 30px;
  text-decoration: none;
}

li a:hover {
  background-color: green;
}
</style>


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
</script>





<body>
 <ul>
  <li><a href="index.php">Home</a></li>
  <li><a href="conn.php">Show table</a></li>
  <li><a href="conn.php?act=clr">Clear tabl</a></li>
  <li><a href="conn.php?act=ins&es=ES&ru=RU">Ins table</a></li>
</ul> 


<!--<img src="img_la.jpg" alt="LA" style="width:100%">
!-->
<div class="">
 <!--<p><a href="index.php">Home</a>    <a href="conn.php?act=clr">Clear table</a> <a href="conn.php">Show table</a> <a href="conn.php?act=ins&es=ES&ru=RU">Ins table</a></p>
!-->
<?php



function clr_tbl(){
	global $mysqli;
	$res = $mysqli->query("delete from words;",MYSQLI_USE_RESULT);
}

function ins_word($p_es,$p_ru,$p_id=null){
	global $mysqli;
	if ($p_id) $sql="insert into words values(".$p_id.",'".$p_es."','".$p_ru."');";
	else $sql="insert into words values(null,'".$p_es."','".$p_ru."');";
	$res = $mysqli->query($sql,MYSQLI_USE_RESULT);
	if (!$res) {echo "sql INSERT query error:".$sql; $mysqli->close();  exit(0);}
}

function del_word($p_es,$p_ru){
	global $mysqli;
	$sql="delete from words where es_name='".$p_es."' and ru_name='".$p_ru."'";;
	$res = $mysqli->query($sql);
	if (!$res) {echo "sql DELETE query error:".$sql; $mysqli->close();  exit(0);}
	return $sql;
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
		echo ">>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>".del_word($es,$ru);
		
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
	."<td>".$est_c."</td>"
	;
	echo "</tr>";
	

}

$mysqli->close();
//echo "end</br>";

?> 
</table>
 
 
</div>

</body>
</html> 
