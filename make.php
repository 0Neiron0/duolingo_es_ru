<!DOCTYPE html>
<html>
<body>
<?php
echo "start</br>";
function replace_string_in_file($filename, $string_to_replace, $replace_with){
    $content=file_get_contents($filename);
    $content_chunks=explode($string_to_replace, $content);
    $content=implode($replace_with, $content_chunks);
    file_put_contents("index.php", $content);
}


$filename="words.html";
$string_to_replace='<<<insert_dict>>>';
$replace_with=file_get_contents("dict.db");;
replace_string_in_file($filename, $string_to_replace, $replace_with);
echo 'all good</br><a href="./index.php">Go!</a>';

?>
<script>
window.location.replace("index.php");
</script>
</body>
</html> 