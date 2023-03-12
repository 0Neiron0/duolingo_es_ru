<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<title>Page Title</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="stylesheet" href="">
<style>
</style>
<script src=""></script>
<body>

<!--<img src="img_la.jpg" alt="LA" style="width:100%">
!-->
<div class="">
 <h1>This is a Heading</h1>
 <p><a href="index.php">Home</a>    <a href="conn.php?act=del">Clear table</a> <a href="conn.php">Show table</a> <a href="conn.php?act=ins&es=ES&ru=RU">Ins table</a></p>
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
	echo '<p>you want to ' . $act . '!</p>';

	if ($act == 'del') clr_tbl();
	
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
echo "start</br>";




$res = $mysqli->query("select * from words",MYSQLI_USE_RESULT);
if (!$res) {echo "sql query error"; $mysqli->close();  exit(0);}
While($row = $res->fetch_assoc()) {	
	print_r($row);

}

$mysqli->close();
echo "end</br>";

?> 

 
 
</div>

</body>
</html> 

<?php

$mysqli = new mysqli($host,$dbuser,$dbpass,$db);
$mysqli->set_charset("utf8");



?>