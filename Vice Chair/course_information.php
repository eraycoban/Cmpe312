<?php

include "../config.php";

$course_id=$_GET['course_id'];

$course=$db->query("SELECT * FROM course WHERE course_id=$course_id")->fetchAll(PDO::FETCH_ASSOC);


$program_ids=[];
$programs=[];
$program_ids=explode(', ',$course[0]['programs']);

foreach($program_ids as $key => $value){
$try=$db->query("SELECT program FROM programs WHERE program_id='$value'")->fetchAll(PDO::FETCH_ASSOC);
$programs=array_merge($try,$programs); }

$department_ids=[];
$departments=[];
$department_ids=explode(', ',$course[0]['departments']);

foreach($department_ids as $key => $value){
$try=$db->query("SELECT department FROM departments WHERE department_id='$value'")->fetchAll(PDO::FETCH_ASSOC);
$departments=array_merge($try,$departments); }

$faculty_ids=[];
$faculties=[];
$faculty_ids=explode(', ',$course[0]['faculties']);

foreach($faculty_ids as $key => $value){
$try=$db->query("SELECT faculty FROM faculties WHERE faculty_id='$value'")->fetchAll(PDO::FETCH_ASSOC);
$faculties=array_merge($try,$faculties); }

$group_names=explode(', ',$course[0]['group_names']);
$groups=[];

foreach($group_names as $key => $value){
$try=$db->query("SELECT * FROM course_group WHERE group_names='$value'")->fetchAll(PDO::FETCH_ASSOC);
$groups=array_merge($try,$groups); }



?>


<html>
<head>
<title> User Information </title>
<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="/css/vice_chair.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

<style>

</style>

</head>

<body>

<div class="main">
	<div class="container-fluid  bg-light border rounded">
		<form>
			<div class="row">
				<div class="col-md-12 my-2">
					<div>
						<h5><?=$course[0]['course_code']?></h5>
						<h6><?=$course[0]['course_name']?></h6>
					</div>
					<div>
						<div>
							<div class="row mt-4">
								<div class="col-md-6">
									<strong>Course Faculties : </strong><br><div class="border rounded bg-white"><?php for($i=0;$i<count($faculties);$i++){ ?><a><?=$faculties[$i]['faculty']?></a><br><?php } ?></div>
								</div>
								<div class="col-md-6">
									<strong>Course Departments : </strong><br><div class="border rounded bg-white"><?php for($i=0;$i<count($departments);$i++){ ?><a><?=$departments[$i]['department']?></a><br><?php } ?></div>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<strong>Programs : </strong><br><div class="border rounded bg-white"><?php for($i=0;$i<count($programs);$i++){ ?><a><?=$programs[$i]['program']?></a><br><?php } ?></div>
								</div>
								<div class="col-md-6">
									<strong>Course Semester : </strong><a><?=$course[0]['sem_id']?></a>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-12">
									<strong>Description : </strong><br><div class="border rounded bg-white"><p><?=$course[0]['description']?></p></div>
								</div>
							</div>

                            <?php for($i=0;$i<count($groups);$i++){ ?>
							<div> <!-- ***************************SAMPLE GROUP INFORMATION*************************** -->
								<div class="row mt-2">
									<div class="col-md-12">
										<strong>Group <?=$groups[$i]['group_names']?> : </strong>
									</div>
								</div>
								<div class="border rounded bg-white">
									<div class="row mt-1 mx-2 ">
										<div class="col-md-4">
											<strong>Lecture Hour(s) : </strong><br>
                                            <?php
                                                            $group_name=$groups[$i]['group_names'];

                                                                   $group=$db->query("SELECT * FROM course_group WHERE group_names='$group_name'")->fetchAll(PDO::FETCH_ASSOC);
                                                                   $days=$group[0]['lecture_days'];
                                                                   $days=explode(", ",$days);
                                                                   $hours=$group[0]['lecture_hours'];
                                                                   $hours=explode(", ",$hours);
                                                                   $classes=$group[0]['lecture_classes'];
                                                                   $classes=explode(", ",$classes);
                                                                   for($j=0;$j<count($days);$j++){
                                            ?>
                                            <br><a><?=$days[$j]?> : <?=$hours[$j]?> </a><br><a> <?=$classes[$j]?></a><br>
                                            <?php } ?>
										</div>
										<div class="col-md-4">
											<strong>Lecturer : </strong><a type="button" class="btn btn-sm text-primary my-1" href="user_information.html" onclick="window.open('user_information.php?user_id=<?=$groups[$i]['lecturer_id']?>', 'newwindow', 'width=820, height=242'); return false;"><?php $lecturer_id=$groups[$i]['lecturer_id'];
                                                                   $lecturer=$db->query("SELECT * FROM users WHERE user_id=$lecturer_id")->fetchAll(PDO::FETCH_ASSOC);
                                                                   echo $lecturer[0]['name']." ".$lecturer[0]['surname'];
                                            ?></a>
										</div>
										<div class="col-md-4">
											<strong>Quota : </strong><a><?=$groups[$i]['quota']?></a>
										</div>
									</div>
									<div class="row mt-1 mx-2">

									</div>
								</div>
							</div>

                            <?php } ?>

						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
</body>

</html>
