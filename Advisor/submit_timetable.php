<?php

include "../config.php";



//update student's schedule and confirm it
$s_id=$_POST["s_id"];
$confirmed=1;

$sql = "UPDATE schedule SET confirmed=?  WHERE s_id=?";
$db->prepare($sql)->execute([$confirmed, $s_id]);



?>
