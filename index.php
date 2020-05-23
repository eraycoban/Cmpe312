<?php

include "config.php";

if(isset($_SESSION["user_id"])){
    
    $user_id=$_SESSION["user_id"];
    
    $location=(int)($user_id/10000000);
    
    switch($location){
        case 1: header("Location:student/student.php"); break;
        case 2: header("Location:advisor/advisor.php"); break;
        case 3: header("Location:viceChair/vice_chair.php"); break;
        case 4: header("Location:viceDean/vice_dean.php"); break;
        case 5: header("Location:admin/admin.php"); break;
    }
    
}

else header("Location:login_page.php?error=$login_error");

?>