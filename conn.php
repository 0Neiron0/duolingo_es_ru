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
 <p><a href="make.php">Regenerate</a></p>
<?php

function ins_word($p_id,$p_es,$p_ru){
	global $mysqli;
	$sql="insert into words values(".$p_id.",".$p_es.",".$p_ru.");";
	$res = $mysqli->query($sql,MYSQLI_USE_RESULT);
	if (!$res) {echo "sql INSERT query error"; $mysqli->close();  exit(0);}
	
}

$host="localhost";
$dbuser="root";
$dbpass="";
$db="epiz_33567965_es";

echo "start</br>";

global $mysqli = new mysqli($host,$dbuser,$dbpass,$db) or die ("mysql error!");
$mysqli->set_charset("utf8");
//ins_word(2,"e","r");
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
