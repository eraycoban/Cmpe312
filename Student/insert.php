<?php

include "../config.php";

$user_id=$_SESSION["user_id"];

//update student's schedule
$periods=$_POST["combinedStr"];
$classeroom=$_POST["classes"];
$course_code=$_POST["course_code"];
$sql = "UPDATE schedule SET periods=?, classroom=?, course_code=?  WHERE s_id=?";
$db->prepare($sql)->execute([$periods, $classroom, $course_code, $user_id]);

$group_id=$_POST["group_id"];
$course_code=$_POST["course_code"];
$course_name=$_POST["course_name"];
$db->prepare("INSERT INTO takes(s_id, course_code, course_name, group_id) VALUES (?,?,?,?)")->execute([$user_id, $course_code, $course_name, $group_id]);
?>
