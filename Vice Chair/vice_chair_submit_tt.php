<?php
include "../config.php";


$user_id=$_GET["user_id"];

echo $user_id;

//$user=$db->query("SELECT * FROM users WHERE user_id=$user_id")->fetchAll(PDO::FETCH_ASSOC);
$student=$db->query("SELECT * FROM student WHERE s_id=$user_id")->fetchAll(PDO::FETCH_ASSOC);
$advisor=$db->query("SELECT * FROM advises JOIN instructor ON advises.s_id=$user_id AND advises.i_id=instructor.i_id")->fetchAll(PDO::FETCH_ASSOC);
$group=$db->query("SELECT * FROM course_group JOIN course ON course_group.course_code = course.course_code")->fetchAll(PDO::FETCH_ASSOC);
$var=$group[0]["i_id"];
$groupst=$db->query("SELECT * FROM instructor WHERE i_id=$var")->fetchAll(PDO::FETCH_ASSOC);

$default_schedule=$db->query("SELECT * FROM schedule WHERE s_id=$user_id")->fetchAll(PDO::FETCH_ASSOC);
$default_p=$default_schedule[0]["periods"];
$default_c=$default_schedule[0]["classroom"];
$default_cc=$default_schedule[0]["course_code"];




//SELECT DISTINCT * FROM course LEFT OUTER JOIN transcript ON course.course_code=transcript.course_code ORDER BY sem_id ASC
$allCourses=$db->query("SELECT DISTINCT * FROM course ORDER BY sem_id ASC")->fetchAll(PDO::FETCH_ASSOC);
$numAllCourses = count($allCourses);
//echo $numAllCourses;

//all courses either withdrawn or failed
$first_priority = $db->query("SELECT * FROM course c1 LEFT JOIN transcript t1 ON c1.course_code=t1.course_code_t WHERE t1.s_id=$user_id AND t1.grade IN ('W', 'F', 'D-')")->fetchAll(PDO::FETCH_ASSOC);
//echo $first_priority[0]["course_code"]." and this is what I failed ".$first_priority[0]["grade"];

//count number of failed courses that student must take
$failedNum = count($first_priority);


//example two failed courses, can only select three more
$max=5-$failedNum;

//courses student are meant to take according to the semester they're about to start
$next_sem=$student[0]["current_sem"]+1;
$second_priority=$db->query("SELECT * FROM course WHERE sem_id=$next_sem")->fetchAll(PDO::FETCH_ASSOC);

//courses that student has already passed and can't select again for which the select button will be disabled
$third_priority = $db->query("SELECT * FROM course c1 LEFT JOIN transcript t1 ON c1.course_code=t1.course_code_t WHERE t1.s_id=$user_id AND t1.grade NOT IN ('W', 'F', 'D-')")->fetchAll(PDO::FETCH_ASSOC);
$passedNum=count($third_priority);
//$remaining=$passedNum-$max;

//$remaining=$db->query("SELECT * FROM course WHERE course_code NOT IN $first_priority")->fetchAll(PDO::FETCH_ASSOC);
//echo "should give 30 something".count($remaining);

$grade_icons = array(
		"W" => "<span class='badge badge-secondary pull-right'>W</span>",
		"F" => '<span class="badge badge-danger pull-right">F</span>',
		"D-" => '<span class="badge badge-primary pull-right">D-</span>',
		"C" => '<span class="badge badge-primary pull-right">C</span>',
		"B" => '<span class="badge badge-primary pull-right">B</span>',
		"A" => '<span class="badge badge-primary pull-right" float="right">A</span>'

);



	// $passedGroup=$_GET["group_id"];
	// echo "THIS IS WHAT HAPPENS WHEN WE PASS ".$passedGroup." should be one";

$takenCourses=$db->query("SELECT DISTINCT course_code, course_name, group_id FROM `takes` WHERE s_id=$user_id")->fetchAll(PDO::FETCH_ASSOC);
$takenNum = count($takenCourses);

//echo print_r($takes[0]["course_code"]);
function displaySemCourses($sem_id){
	$db = new PDO("mysql:host=localhost;dbname=emu_register", "root", "");
	$course=$db->query("SELECT DISTINCT * FROM course LEFT OUTER JOIN transcript ON course.course_code=transcript.course_code_t WHERE sem_id=$sem_id ORDER BY sem_id ASC")->fetchAll(PDO::FETCH_ASSOC);
	return $course;
}

function displayCourseGroup($crs_code){
	$db = new PDO("mysql:host=localhost;dbname=emu_register", "root", "");
	$str="'".$crs_code."'";
	$g=$db->query("SELECT * FROM course JOIN course_group ON course.course_code=course_group.course_code WHERE course_group.course_code=$str")->fetchAll(PDO::FETCH_ASSOC);
	return $g;
}



function subArraysToString($ar, $sep = ', ') {
    $str = '';
    foreach ($ar as $val) {
        $str .= implode($sep, $val);
        $str .= $sep; // add separator between sub-arrays
    }
    $str = rtrim($str, $sep); // remove last separator
    return $str;
}

echo "<a href='?operation=logout'>LOGOUT</a>";

?>


<html>
<head>
<title> EMU PORTAL </title>
<link rel="icon" href="https://upload.wikimedia.org/wikipedia/tr/a/ae/Emu-dau-logo.png">
<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="/css/advisor.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
</script>


<style>
table.tt td{
font-size:11px;
text-align:center;
}

table,thead{
  border: 1px solid #8e8b8b;
}
th, td  {

  border: 1px dashed #8e8b8b;
}
tr.ts-1 {
background-color :#c2d8f9;
}
tr.ts-2 {
background-color :#e1f1ff;
}
td.ts-3 {
border: 1px solid #8e8b8b;
}
div ,button.bb{
border-bottom: 1px solid #0000;
text-align:left;
}
button.btn:focus,.btn:active {
   outline: none !important;
   box-shadow: none;
}
.row.no-gutters {
  margin-right: 0;
  margin-left: 0;

  & > [class^="col-"],
  & > [class*=" col-"] {
    padding-right: 0;
    padding-left: 0;
  }
}
td.clush{
color:red;
}
</style>

</head>

<body>

<div class="main">
	<div class="clearfix bg-light" >
		<div class="container-fluid  ">
		<div class="py-2 px-5 float-left ">
		<a href="#"><img src="https://upload.wikimedia.org/wikipedia/tr/a/ae/Emu-dau-logo.png" alt="Logo" style="width:40px;"></a>
			</div>

		</div>
	</div>
	<div class="">
		<div class="mainnav" >
			<nav class="navbar navbar-expand-xl  navbar-dark shadow-lg">
				<a class="nav-link text-light active" href="#" color="white">HOME</a>

			</nav>
		</div>
	</div>

  	<div class="row no-gutters" > <!-- MAIN ROW -->
  		<div class="col-7">

  			<div class="mt-3 container-fluid">
  				<div class="row">
  					<div class="col-12 ">

  						<!--Student information panel-->

  						<table class="table table-sm table-borderless shadow" style="background-color:#e1f1ff">
  						<tbody>
  							<tr>
  							<td rowspan="2" ><img src="#" alt="PP"></td>
  							<td><?php echo $student[0]["name"]." ".$student[0]["surname"];?></td></td></td>
  							<td style="text-align:right"><b>ID :</b></td>
  							<td><?php echo $student[0]["s_id"];?></td>
  							</tr>
  							<tr>

  							<td><?php echo $student[0]["department"];?></td>
  							<td style="text-align:right "><b>GPA :</b></td>
  							<td><?php echo $student[0]["GPA"];?></td>
  							</tr>
  							<tr>
  							<td style="text-align:right"><b>Advisor :</b></td>
  							<td><?php echo $advisor[0]["name"];?></td>
  							<td style="text-align:right"><b>CGPA :</b></td>
  							<td><?php echo $student[0]["CGPA"];?></td>
  							</tr>
  							<tr>
  							<td></td>
  							<td><?php echo $advisor[0]["email"];?></td>
  							<td colspan="2"></td>
  							</tr>
  						</tbody>
  						</table>


  					</div>
  				</div>
  			</div>
  			<div class="container-fluid">
  				<div class="row">

  <input type="hidden" id="default_periods" name="default_periods" value="<?php echo $default_p[0]["periods"];?>" >

  					<div class="col-12">
  						<table class="table table-sm tt shadow-lg" id="timetable">  <!--Timetable-->
  							<thead>
  							  <col width="%10">
  							  <col width="%15">
  							  <col width="%15">
  							  <col width="%15">
  							  <col width="%15">
  							  <col width="%15">
  							  <col width="%15">
  							  <tr>
  								<th>Period <br> Saat</th>
  								<th>Monday <br> Pazartesi</th>
  								<th>Tuesday <br> Sali</th>
  								<th>Wednesday <br> Carsamba</th>
  								<th>Thursday <br> Persembe</th>
  								<th>Friday <br> Cuma</th>
  								<th>Saturday <br> Cumartesi</th>
  							  </tr>
  							</thead>
  							<tbody>
  							  <tr class="ts-1" style="height:30px">
  								<td>08:30-09:20</td>
  								<td></td>
  								<td class="ts-3 clush"></td>
  								<td class="ts-3"></td>
  								<td class="ts-3"></td>
  								<td></td>
  								<td></td>
  							  </tr>
  							  <tr class="ts-2" style="height:30px">
  								<td>09:30-10:20</td>
  								<td></td>
  								<td class="ts-3"></td>
  								<td class="ts-3"></td>
  								<td class="ts-3"></td>
  								<td class="ts-3"></td>
  								<td></td>
  							  </tr>
  							  <tr class="ts-1" style="height:30px">
  								<td>10:30-11:20</td>
  								<td class="ts-3"></td>
  								<td class="ts-3"></td>
  								<td></td>
  								<td></td>
  								<td class="ts-3"></td>
  								<td></td>
  							  </tr>
  							  <tr class="ts-2" style="height:30px">
  								<td>11:30-12:20</td>
  								<td class="ts-3"></td>
  								<td class="ts-3"></td>
  								<td></td>
  								<td></td>
  								<td class="ts-3"></td>
  								<td></td>
  							  </tr>
  							  <tr class="ts-1" style="height:30px">
  								<td>12:30-13:20</td>
  								<td></td>
  								<td></td>
  								<td class="ts-3"></td>
  								<td class="ts-3"></td>
  								<td></td>
  								<td></td>
  							  </tr>
  							  <tr class="ts-2" style="height:30px">
  								<td>13:30-14:20</td>
  								<td></td>
  								<td></td>
  								<td class="ts-3"></td>
  								<td class="ts-3"></td>
  								<td></td>
  								<td></td>
  							  </tr>
  							  <tr class="ts-1" style="height:30px">
  								<td>14:30-15:20</td>
  								<td class="ts-3"></td>
  								<td class="ts-3"></td>
  								<td class="ts-3"></td>
  								<td class="ts-3 text-success"></td>
  								<td></td>
  								<td></td>
  							  </tr>
  							  <tr class="ts-2" style="height:30px">
  								<td>15:30-16:20</td>
  								<td class="ts-3"></td>
  								<td class="ts-3"></td>
  								<td class="ts-3"></td>
  								<td class="ts-3"></td>
  								<td></td>
  								<td></td>
  							  </tr>
  							  <tr class="ts-1" style="height:30px">
  								<td>16:30-17:20</td>
  								<td></td>
  								<td></td>
  								<td></td>
  								<td></td>
  								<td></td>
  								<td></td>
  							  </tr>
  							  <tr class="ts-2" style="height:30px">
  								<td>17:30-18:20</td>
  								<td></td>
  								<td></td>
  								<td></td>
  								<td></td>
  								<td></td>
  								<td></td>
  							  </tr>
  							  <tr class="ts-1" style="height:30px">
  								<td>18:30-19:20</td>
  								<td></td>
  								<td></td>
  								<td></td>
  								<td></td>
  								<td></td>
  								<td></td>
  							  </tr>
  							  <tr class="ts-2" style="height:30px">
  								<td>19:30-20:20</td>
  								<td></td>
  								<td></td>
  								<td></td>
  								<td></td>
  								<td></td>
  								<td></td>
  							  </tr>
  							  <tr class="ts-1" style="height:30px">
  								<td>20:30-21:20</td>
  								<td></td>
  								<td></td>
  								<td></td>
  								<td></td>
  								<td></td>
  								<td></td>
  							  </tr>
  							  <tr class="ts-2" style="height:30px">
  								<td>21:30-22:20</td>
  								<td></td>
  								<td></td>
  								<td></td>
  								<td></td>
  								<td></td>
  								<td></td>
  							  </tr>
  							  <tr class="ts-1"style="height:30px">
  								<td>22:30-23:20</td>
  								<td></td>
  								<td></td>
  								<td></td>
  								<td></td>
  								<td></td>
  								<td></td>
  							  </tr>
  							  <tr class="ts-2">

  							</tbody>
  						</table>
  					</div>
  				</div>
  			</div>
  			<!-- Selected Courses -->
  			<div class="mt-3 container-fluid">
  				<div class="row">
  					<div class="col-12 ">

  						  <table id="selected-c" class="table table-sm table-borderless shadow" style="background-color:#e1f1ff">
  							<thead class="thead-light">
  									<th class="pl-4 align="center"">Group #</th>
  									<th class="pl-4 align="center"">Course Code</th>
  									<th class="pl-4 align="center"">Course Name</th>
  									<th></th>
  									</thead>
  								<tbody id="tbody">
  								 <!--insert courses here-->
  								</tbody>
  								</table>

  					</div>
  				</div>
  			</div>
  		</div>
  		<div class="col-5">
  			<ul class="nav nav-tabs" role="tablist">
  				<li class="nav-item">
  					<a class="nav-link active" data-toggle="tab" href="#semester">Semester View</a>
  				</li>
  				<li class="nav-item">
  					<a class="nav-link" data-toggle="tab" href="#course">Course View</a>
  				</li>
  			</ul>
  			<div class="mx-1 card-header">
  				<div class="row">
  					<div class="col "><center><i class="fa fa-check-square text-success"></i> </center></div>
  					<div class="col "><center><i class="fa fa-exclamation text-danger"></i> </center></div>
  					<div class="col "><center><span class="badge badge-primary">A</span> </center></div>
  					<div class="col "><center><span class="badge badge-secondary">W</span> </center></div>
  					<!--<div class="col "><center><i class="fa fa-sitemap"></i> <a> Pre-Required Courses</a></center></div>-->
  				</div>
  				<div class="row">
  					<div class="col "><center><a> Course Taken</a></center></div>
  					<div class="col "><center><a> Must Course</a></center></div>
  					<div class="col "><center><a> Course Grade</a></center></div>
  					<div class="col "><center><a> Withdrawn </a></center></div>

  					<!--<div class="col "><center><span class="badge badge-primary">A</span> <a> Course Grade</a></center></div>
  					<div class="col "><center><span class="badge badge-secondary">W</span> <a> Withdrawn </a></center></div>
  				</div> -->
  			</div>
  			<div class="container tab-content"> <!--Semesters Panel-->
  				<div id="semester" class="container tab-pane active" >
  					<center><h2 class="display-4">Semesters</h2></center>
  					<div id="accordion">



  				<div class="card">

  					<?php
  					//checking the status of courses that student has taken, failed, has not yet taken



  					$i=0;
  					$allTaken=0;
  					while($i < 6){
  						$c=displaySemCourses(1);
  					?>

  						<div class="card-header">
  							<a class="collapsed card-link" data-toggle="collapse" aria-expanded="true" href="#collapseOne">
  								Semester 1
  								<?php if ($allTaken>5) {
  									echo '<i class="fa fa-check-square text-success" data-toggle="tooltip" title="try one!"></i>';
  								}?>
  							</a>
  						</div>


  						<div id="collapseOne" class="collapse" data-parent="#accordion">

  							<?php


  							foreach($c as $crs){
  								$arg=$crs["course_code"];
  								$until=$crs["group_number"];
  								$count2=0;

  								?>

  							<div class="bb btn-group btn-block" role="group" aria-label="Basic example">

  								<button type="button" href="#<?php echo $count2;?>" class="bb btn-md btn btn-basic btn-block border-top pt-2 " data-toggle="collapse" <?php if ($crs["grade"]) echo "disabled"; $allTaken++;?>>
  								<?php echo $crs["course_code"]." - ".$crs["course_name"];?>
  								<?php
  								if($crs["grade"]){
  								?>
  								<i class="fa fa-check-square text-success" data-toggle="tooltip" title="This course is already taken!" ></i> </button>
  								<?php
  								}
  								?>

  								<form action="course_group.php" method="post" >
  										<input type="submit" class="btn btn-light btn-secondary border-primary rounded-right" name="select" value="select" / <?php if ($crs["grade"]) echo "disabled";?>>
  										<input type="hidden" name="course_code" value="<?php echo $crs["course_code"]; ?>"/>
  								</form>
  							</div>
  								<!-- <button type="button" class="btn btn-light btn-secondary border-primary rounded-right" disabled>Select</button> </div> -->


  								<?php $i++;}}?>



  						</div>
  					</div>
  					<div class="card">
  						<?php
  						$i=0;
  						while($i < 5){
  							$c=displaySemCourses(2);
  						?>
  						<div class="card-header">
  							<a class="collapsed card-link" data-toggle="collapse" href="#collapseTwo">
  								Semester 2 <i class="fa fa-exclamation text-danger" data-toggle="tooltip" title="There is a must course this semester!"></i>
  							</a>
  						</div>
  						<div id="collapseTwo" class="collapse" data-parent="#accordion">
  							<?php
  							foreach($c as $crs){
  								$arg=$crs["course_code"];
  								$until=$crs["group_number"];
  								$count2=0;
  								?>
  							<div class="bb btn-group btn-block" role="group" aria-label="Basic example">

  								<button type="button" href="#<?php echo $count2;?>" class="bb btn-md btn btn-basic btn-block border-top pt-2 " data-toggle="collapse">
  								<?php echo $crs["course_code"]." - ".$crs["course_name"];?>
  								<i class="fa fa-check-square text-success" data-toggle="tooltip" title="This course is already taken!"></i> </button>
  								<form action="course_group.php" method="post">
  										<input type="submit" class="btn btn-light btn-secondary border-primary rounded-right" name="select" value="select" />
  										<input type="hidden" name="course_code" value="<?php echo $crs["course_code"]; ?>"/>
  								</form>
  							</div>
  								<!-- <button type="button" class="btn btn-light btn-secondary border-primary rounded-right" disabled>Select</button> </div> -->


  							<?php $i++;}}?>


  						</div>
  					</div>


  					<div class="card">
  						<?php
  						$i=0;
  						while($i < 5){
  							$c=displaySemCourses(3);

  						?>
  						<div class="card-header">
  							<a class="collapsed card-link" data-toggle="collapse" href="#collapseThree">
  								Semester 3
  							</a>
  						</div>
  						<div id="collapseThree" class="collapse" data-parent="#accordion">
  							<?php
  							foreach($c as $crs){
  								$arg=$crs["course_code"];
  								$until=$crs["group_number"];
  								$count2=0;
  								?>
  								<div class="bb btn-group btn-block" role="group" aria-label="Basic example">

  									<button type="button" href="#<?php echo $count2;?>" class="bb btn-md btn btn-basic btn-block border-top pt-2 " data-toggle="collapse">
  									<?php echo $crs["course_code"]." - ".$crs["course_name"];?>
  									<i class="fa fa-check-square text-success" data-toggle="tooltip" title="This course is already taken!"></i> </button>
  									<form action="course_group.php" method="post">
  											<input type="submit" class="btn btn-light btn-secondary border-primary rounded-right" name="select" value="select" />
  											<input type="hidden" name="course_code" value="<?php echo $crs["course_code"]; ?>"/>
  									</form>
  								</div>
  									<!-- <button type="button" class="btn btn-light btn-secondary border-primary rounded-right" disabled>Select</button> </div> -->


  								<?php $i++;}}?>
  						</div>
  					</div>

  					<div class="card">
  						<?php
  						$i=0;
  						while($i < 5){
  							$c=displaySemCourses(4);
  						?>
  						<div class="card-header">
  							<a class="collapsed card-link" data-toggle="collapse" href="#collapseFour">
  								Semester 4
  							</a>
  						</div>
  						<div id="collapseFour" class="collapse" data-parent="#accordion">
  							<?php
  							foreach($c as $crs){
  								$arg=$crs["course_code"];
  								$until=$crs["group_number"];
  								$count2=0;
  								?>
  								<div class="bb btn-group btn-block" role="group" aria-label="Basic example">

  									<button type="button" href="#<?php echo $count2;?>" class="bb btn-md btn btn-basic btn-block border-top pt-2 " data-toggle="collapse">
  									<?php echo $crs["course_code"]." - ".$crs["course_name"];?>
  									<i class="fa fa-check-square text-success" data-toggle="tooltip" title="This course is already taken!"></i> </button>
  									<form action="course_group.php" method="post">
  											<input type="submit" class="btn btn-light btn-secondary border-primary rounded-right" name="select" value="select" />
  											<input type="hidden" name="course_code" value="<?php echo $crs["course_code"]; ?>"/>
  									</form>
  								</div>
  									<!-- <button type="button" class="btn btn-light btn-secondary border-primary rounded-right" disabled>Select</button> </div> -->


  								<?php $i++;}}?>
  						</div>
  					</div>
  					<div class="card">
  						<?php
  						$i=0;
  						while($i < 5){
  							$c=displaySemCourses(5);
  						?>
  						<div class="card-header">
  							<a class="collapsed card-link" data-toggle="collapse" href="#collapseFive">
  								Semester 5
  							</a>
  						</div>
  						<div id="collapseFive" class="collapse" data-parent="#accordion">
  							<?php
  							foreach($c as $crs){
  								$arg=$crs["course_code"];
  								$until=$crs["group_number"];
  								$count2=0;
  								?>
  								<div class="bb btn-group btn-block" role="group" aria-label="Basic example">

  									<button type="button" href="#<?php echo $count2;?>" class="bb btn-md btn btn-basic btn-block border-top pt-2 " data-toggle="collapse">
  									<?php echo $crs["course_code"]." - ".$crs["course_name"];?>
  									<i class="fa fa-check-square text-success" data-toggle="tooltip" title="This course is already taken!"></i> </button>
  									<form action="course_group.php" method="post">
  											<input type="submit" class="btn btn-light btn-secondary border-primary rounded-right" name="select" value="select" />
  											<input type="hidden" name="course_code" value="<?php echo $crs["course_code"]; ?>"/>
  									</form>
  								</div>
  									<!-- <button type="button" class="btn btn-light btn-secondary border-primary rounded-right" disabled>Select</button> </div> -->


  								<?php $i++;}}?>
  						</div>
  					</div>
  					<div class="card">
  						<?php
  						$i=0;
  						while($i < 5){
  							$c=displaySemCourses(6);
  						?>
  						<div class="card-header">
  							<a class="collapsed card-link" data-toggle="collapse" href="#collapseSix">
  								Semester 6
  							</a>
  						</div>
  						<div id="collapseSix" class="collapse" data-parent="#accordion">
  							<?php
  							foreach($c as $crs){
  								$arg=$crs["course_code"];
  								$until=$crs["group_number"];
  								$count2=0;
  								?>
  								<div class="bb btn-group btn-block" role="group" aria-label="Basic example">

  									<button type="button" href="#<?php echo $count2;?>" class="bb btn-md btn btn-basic btn-block border-top pt-2 " data-toggle="collapse">
  									<?php echo $crs["course_code"]." - ".$crs["course_name"];?>
  									<i class="fa fa-check-square text-success" data-toggle="tooltip" title="This course is already taken!"></i> </button>
  									<form action="course_group.php" method="post">
  											<input type="submit" class="btn btn-light btn-secondary border-primary rounded-right" name="select" value="select" />
  											<input type="hidden" name="course_code" value="<?php echo $crs["course_code"]; ?>"/>
  									</form>
  								</div>
  									<!-- <button type="button" class="btn btn-light btn-secondary border-primary rounded-right" disabled>Select</button> </div> -->


  								<?php $i++;}}?>
  						</div>
  					</div>
  					<div class="card">
  						<?php
  						$i=0;
  						while($i < 5){
  							$c=displaySemCourses(7);
  						?>
  						<div class="card-header">
  							<a class="collapsed card-link" data-toggle="collapse" href="#collapseSeven">
  								Semester 7
  							</a>
  						</div>
  						<div id="collapseSeven" class="collapse" data-parent="#accordion">
  							<?php
  							foreach($c as $crs){
  								$arg=$crs["course_code"];
  								$until=$crs["group_number"];
  								$count2=0;
  								?>
  								<div class="bb btn-group btn-block" role="group" aria-label="Basic example">

  									<button type="button" href="#<?php echo $count2;?>" class="bb btn-md btn btn-basic btn-block border-top pt-2 " data-toggle="collapse">
  									<?php echo $crs["course_code"]." - ".$crs["course_name"];?>
  									<i class="fa fa-check-square text-success" data-toggle="tooltip" title="This course is already taken!"></i> </button>
  									<?php if($crs["is_elective"]){
  										?>
  										<form action="elective_courses.php" method="post">
  												<input type="submit" class="btn btn-light btn-secondary border-primary rounded-right" name="select" value="select" />
  												<input type="hidden" name="course_code" value="<?php echo $crs["course_code"]; ?>"/>
  										</form>
  									<?php } else{ ?>

  									<form action="course_group.php" method="post">
  											<input type="submit" class="btn btn-light btn-secondary border-primary rounded-right" name="select" value="select" />
  											<input type="hidden" name="course_code" value="<?php echo $crs["course_code"]; ?>"/>
  									</form>
  								<?php } ?>
  								</div>
  									<!-- <button type="button" class="btn btn-light btn-secondary border-primary rounded-right" disabled>Select</button> </div> -->


  								<?php $i++;}}?>
  						</div>
  					</div>
  					<div class="card">
  						<?php
  						$i=0;
  						while($i < 5){
  							$c=displaySemCourses(8);
  						?>
  						<div class="card-header">
  							<a class="collapsed card-link" data-toggle="collapse" href="#collapseEight">
  								Semester 8
  							</a>
  						</div>
  						<div id="collapseEight" class="collapse" data-parent="#accordion">
  							<?php
  							foreach($c as $crs){
  								$arg=$crs["course_code"];
  								$until=$crs["group_number"];
  								$count2=0;
  								?>
  								<div class="bb btn-group btn-block" role="group" aria-label="Basic example">

  									<button type="button" href="#<?php echo $count2;?>" class="bb btn-md btn btn-basic btn-block border-top pt-2 " data-toggle="collapse">
  									<?php echo $crs["course_code"]." - ".$crs["course_name"];?>
  									<i class="fa fa-check-square text-success" data-toggle="tooltip" title="This course is already taken!"></i> </button>
  									<form action="course_group.php" method="post">
  											<input type="submit" class="btn btn-light btn-secondary border-primary rounded-right" name="select" value="select" />
  											<input type="hidden" name="course_code" value="<?php echo $crs["course_code"]; ?>"/>
  									</form>
  								</div>
  									<!-- <button type="button" class="btn btn-light btn-secondary border-primary rounded-right" disabled>Select</button> </div> -->


  								<?php $i++;}}?>
  						</div>
  					</div>
  				</div>
  				</div>
          <div class="container mt-3"><center><button type="button" onclick="location.href='vice_chair.php'" class="submitButton btn btn-primary btn-lg " id="submit_btn" >Submit This Timetable</button></center></div>


  				<div id="course" class="container tab-pane" >
  					<center><h2 class="display-4">Courses</h2></center>
  					<?php

  					$failedIndex=0;
  					if ($failedNum){
  						while($failedIndex<$failedNum){

  							?>

  							<div class="bb btn-group btn-block border border-right-0 border-bottom-0 border-top-0" role="group" aria-label="Basic example">
  								<button type="button" href="#course2" class="bb btn-md btn btn-basic btn-block border-top" data-toggle="collapse">


  								  <?php
  								//	echo $grade_icons[$first_priority[$failedIndex]["grade"]];


  									 echo $first_priority[$failedIndex]["course_code"]." - ".$first_priority[$failedIndex]["course_name"].$grade_icons[$first_priority[$failedIndex]["grade"]];?>

  								</button>
  								<form action="course_group.php" method="post">
  										<input type="submit" class="btn btn-light btn-secondary border-primary rounded-right" name="select" value="select" />
  										<input type="hidden" name="course_code" value="<?php echo $first_priority[$failedIndex]["course_code"]; ?>"/>
  								</form>
  							</div>
  							<!--</div>-->


  							<?php $failedIndex++;}

  						}

  						$currentIndex = 0;
  						while($currentIndex<$max){
  						?>

  						<!-- <div class="bb btn-group btn-block border border-right-0 border-bottom-0 border-top-0" role="group" aria-label="Basic example"> <button type="button" href="#course1" class="bb btn-md btn btn-basic btn-block border-top pt-2 "  data-toggle="collapse" disabled>CMPE107 - Long Course Name <i class="fa fa-check-square text-success" data-toggle="tooltip" title="This course is already taken!"></i> </button> <button type="button" class="btn btn-light btn-secondary border-primary rounded-right" disabled>Select</button> </div>
  						<div id="course1" class="collapse pl-3 border-top bg-light"><a>Group 1 -  MEHMET BODUR <a> <br> <a>Group 2 - TBH</a></div> <br> -->
  						<div class="bb btn-group btn-block border border-right-0 border-bottom-0 border-top-0" role="group" aria-label="Basic example">
  							<button type="button" href="#course2" class="bb btn-md btn btn-basic btn-block border-top" data-toggle="collapse">
  									<i class="fa fa-exclamation text-danger"></i>
  							  <?php echo $second_priority[$currentIndex]["course_code"]." - ".$second_priority[$currentIndex]["course_name"];?>

  							</button>
  							<form action="course_group.php" method="post">
  									<input type="submit" class="btn btn-light btn-secondary border-primary rounded-right" name="select" value="select" />
  									<input type="hidden" name="course_code" value="<?php echo $second_priority[$currentIndex]["course_code"]; ?>"/>
  							</form>
  						</div>
  						<!--</div>-->
  						<?php $currentIndex++;}

  						$passedIndex=0;
  						while($passedIndex<$passedNum){

  							?>

  							<div class="bb btn-group btn-block border border-right-0 border-bottom-0 border-top-0" role="group" aria-label="Basic example">
  								<button type="button" href="#course2" class="bb btn-md btn btn-basic btn-block border-top" data-toggle="collapse" disabled>
  									<i class="fa fa-check-square text-success"></i>

  									<?php echo $third_priority[$passedIndex]["course_code"]." - ".$third_priority[$passedIndex]["course_name"].$grade_icons[$third_priority[$passedIndex]["grade"]];?>

  								</button>
  								<form action="course_group.php" method="post">
  										<input type="submit" class="btn btn-light btn-secondary border-primary rounded-right" name="select" value="select" />
  										<input type="hidden" name="course_code" value="<?php echo $third_priority[$passedIndex]["course_code"]; ?>"/>
  								</form>
  							</div>
  							<!--</div>-->


  							<?php $passedIndex++;}
  							?>


  							<br>



  				</div>

  			</div>
  						</div>
  					</div>
  				</div>
  			</div>



  <?php
  $loopSelected=0;
  while($loopSelected<$takenNum){
   ?>
  <input type="hidden" id="<?php echo 'cc'.$loopSelected?>" name="taken" value="<?php echo $takenCourses[$loopSelected]["course_code"];?>" >
  <input type="hidden" id="<?php echo 'cn'.$loopSelected?>" name="taken" value="<?php echo $takenCourses[$loopSelected]["course_name"];?>" >
  <input type="hidden" id="<?php echo 'g'.$loopSelected?>" name="taken" value="<?php echo $takenCourses[$loopSelected]["group_id"];?>" >

  <input type="hidden" id="count" name="count" value="<?php echo $takenNum;?>" >








  <?php $loopSelected++;}?>


  	<input type="hidden" id="default_p" name="default_p" value="<?php echo $default_p;?>" >
  	<input type="hidden" id="default_c" name="default_c" value="<?php echo $default_c;?>" >
  	<input type="hidden" id="default_cc" name="default_cc" value="<?php echo $default_cc;?>" >
  	<input type="hidden" id="count" name="count" value="<?php echo $takenNum;?>" >
  	<input type="hidden" id="student_identifier" name="student_identifier" value="<?php echo $user_id;?>" >

  	</form>

  	</body>


  		<script>
  		//declaring global variables
  		console.log("inside script");
  		var rIndex, cIndex, td, split_p, split_c, slot, table_index, output, matched, c, r, col_id, row_id, mid, res_arr, displayed, display_btn, select_btn, drop_btn;
  		var slash="/";
  		//retrieve main timetable by ID
  		var table = document.getElementById("timetable");
  		var s_id=document.getElementById('student_identifier').value;


  		//retrieve periods, classroom, course_code of schedule table
  		var default_p=document.getElementById('default_p').value;
  		var default_c=document.getElementById('default_c').value;
  		var default_cc=document.getElementById('default_cc').value;

  		console.log("this that variable i'm looking for: "+default_c);

  		//display database values
  		displayDefaultSelectedCourses();
  		if(default_cc){
  		displayDefaultTimetable();
  	}

  		function displayDefaultSelectedCourses(){
  				//number of iterations equals number of courses that have been selected
  				var cnt = document.getElementById('count').value;
  				for(var i=0; i<parseInt(cnt); i++){
  							var cc_id=("cc"+i).toString();
  							var cn_id=("cn"+i).toString();
  							var g_id=("g"+i).toString();

  							var taken_cc = document.getElementById(cc_id).value;
  							var taken_cn = document.getElementById(cn_id).value;
  							var taken_g = document.getElementById(g_id).value;
  							console.log("I'm in");
  							//append each selected course to bottom table
  							var string='<tr id='+i+'>';
  							string+='<td align="center">'+taken_g+'</td>';
  							string+='<td align="center">'+taken_cc+'</td>';
  							string+='<td>'+taken_cn+'</td>';
  							string+='<td><button type="button" class="dropCourse btn btn-primary btn-sm" data-grp="'+taken_g+'" data-cc="'+taken_cc+'" data-cn="'+taken_cn+'" data-id='+i+' id="drop_btn'+i+'"> Drop Course</button></td></tr>';
  							$("#tbody").prepend(string);
  							}
  		}

  		$('.dropCourse').click(function (){
  			var btn_id=$(this).data("id"); //$id of button
  			var group_id=$(this).data("grp");
  			var course_code=$(this).data("cc");
  			var course_name=$(this).data("cn");
  			drop_btn=document.getElementById("drop_btn"+btn_id);
  		//	var group_number=$(this).data("id");
  			//var group_id=document.getElementById('group_num'+btn_id).value;
  			//$("#tbody").prepend(string);

  			$.ajax({
  				type: 'POST',
  				url: 'drop_course.php',
  				data: {group_id: group_id,
  							course_code: course_code,
  							course_name: course_name,
  							default_p: default_p,
  							default_c: default_c,
  							default_cc: default_cc},
  				success: function(data){
  					console.log("in ajax: "+group_id);
  					// if(group_id){
  					// 	var html='<tr>';
  					// 	html+='<td align="center">'+group_id+'</td>';
  					// 	html+='<td align="center">'+course_code+'</td>';
  					// 	html+='<td>'+course_name+'</td>';
  					// 	html+='<td><button type="button" class="btn btn-primary btn-sm" >Drop Course</button></td></tr>';
  					// 	$("#tbody").prepend(html);
  					// }
  				}
  			});

  			$("#tbody tr#"+btn_id).remove();

  			location.reload();


  		});

  		$('.submitButton').click(function(){
  		    $.ajax({
  					type: 'POST',
  					url: 'submit_timetable.php',
  					data: {s_id: s_id},
  					success: function(data){
  						console.log("in ajax: ");
  		      }
  					});
  				});

  		function display(str1, str2, course_code){
  			split_p=parse(str1);
  			split_c=parse(str2);
  			split_cc=parse(course_code);



  			//for each element of period
  				for(var i=0; i<split_p.length; i++){
  						//convert period number into index of 2D Matrix that represents timetable
  						slot = generateIndices(split_p[i]);
  						//match generated index with timetable index, finding correct day and lecture hour
  						table_index = match(slot);
  						//insert course code and period into appropriate day and lecture hour (matching table cell)
  						displayed=insert(table_index, split_cc[i], split_c[i]);
  					}
  		}


  			function displayDefaultTimetable(){

  				display(default_p.toString(), default_c.toString(), default_cc.toString());

  	}


  			function parse(s){
  				res_arr=s.split(",");
  				return res_arr;
  		}


  				//algorithm to calculate row index and column index, returned as a tuple
  			function generateIndices(p){
  					//algorithm to calculate row index and column index, returned as a tuple
  					c=p%10;
  					col_id=c+1;
  					r=parseInt(p/10);
  					row_id=r+1;
  					return [row_id, col_id];
  		}



  			function duplicate(arr){
  				var current = null;
  				var count=0;
  				var clashPeriod="";
  				var conflict;
  				for (var i=0; i < arr.length; i++) {
  		        if (arr[i] != current) {
  		            if (count>1) {
  										clashPeriod+=current+" ";
  		            }
  		            current = arr[i];
  		            count = 1;
  		        }
  						else {
  		            count++;
  		        }
  		  	}
  				return clashPeriod;
  		}


  			function match(timeSlot){
  						//timeSlot[0] is the row_id, timeSlot[1] is the col_id
  						console.log("inside match");
  						var matchedIndex;
  						matched=0;
  						if(!matched){
  						for(var i=0; i<table.rows.length; i++){
  							//row cells td
  							for(var j=0; j<table.rows[i].cells.length; j++){
  								// td is the box
  								td = table.rows[i].cells[j];
  								if (td.parentElement.rowIndex==timeSlot[0] && td.cellIndex==timeSlot[1]){
  									matched=1;
  									//store the conditions that matched as this is the result needed
  									rIndex=td.parentElement.rowIndex;
  									cIndex=td.cellIndex;
  									matchedIndex = [rIndex, cIndex];
  									break;
  								}
  							}
  						}
  						console.log("this is my row: "+rIndex+" and this is my column: "+cIndex);
  						return matchedIndex;
  					}
  		}


  			function insert(i, cc, c){
  					//i is index of matching table index generated from match function
  					console.log("inside insert and these are my indices: ");
  					output=table.rows[i[0]].cells[i[1]];
  					//var htmlstring = output.innerHTML;
  					output.innerHTML="";
  					output.innerHTML+=
  									"<a class='text-primary pt-4 '><br>"+cc+slash+c+"</a>";

  					return output;
  		}



  	</script>

  	</div>
  	</html>
