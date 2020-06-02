<?php

include "../config.php";

// logout and go to login page
if(isset($_GET["operation"]) && $_GET["operation"] == "logout") {
	session_destroy();
	header("Location: ../index.php");
}



$user_id=$_SESSION["user_id"];
//
$user=$db->query("SELECT * FROM users WHERE user_id=$user_id")->fetchAll(PDO::FETCH_ASSOC);
$student=$db->query("SELECT * FROM student WHERE s_id=$user_id")->fetchAll(PDO::FETCH_ASSOC);
$advisor=$db->query("SELECT * FROM advises JOIN instructor WHERE s_id=$user_id")->fetchAll(PDO::FETCH_ASSOC);
$group=$db->query("SELECT * FROM course_group JOIN course ON course_group.course_code = course.course_code")->fetchAll(PDO::FETCH_ASSOC);
$var=$group[0]["i_id"];
$groupst=$db->query("SELECT * FROM instructor WHERE i_id=$var")->fetchAll(PDO::FETCH_ASSOC);


	// $passedGroup=$_GET["group_id"];
	// echo "THIS IS WHAT HAPPENS WHEN WE PASS ".$passedGroup." should be one";

$takenCourses=$db->query("SELECT DISTINCT course_code, course_name, group_id FROM `takes` WHERE s_id=$user_id")->fetchAll(PDO::FETCH_ASSOC);
$takenNum = count($takenCourses);

//echo print_r($takes[0]["course_code"]);
function displaySemCourses($sem_id){
	$db = new PDO("mysql:host=localhost;dbname=emu_register", "root", "");
	$course=$db->query("SELECT * FROM course WHERE sem_id=$sem_id")->fetchAll(PDO::FETCH_ASSOC);
	return $course;
}

function displayCourseGroup($crs_code){
	$db = new PDO("mysql:host=localhost;dbname=emu_register", "root", "");
	$str="'".$crs_code."'";
	$g=$db->query("SELECT * FROM course JOIN course_group ON course.course_code=course_group.course_code WHERE course_group.course_code=$str")->fetchAll(PDO::FETCH_ASSOC);
	return $g;
}

// $j=displaySemCourses(1);
// echo "this is the returned value: ".$j[]["course_name"];
//
// $b=displayCourseGroup("MATH163");
// echo "this is the returned value: ".$b[0]["course_name"];
// echo "this is the returned value: ".$b[0]["course_code"];
//



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
<link href="style.css" rel="stylesheet" type="text/css">
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
<?php
					if(isset($_POST["select_btn"])){
						echo "I SELECTED FROM PREVIOUS PAGE";
						$group_id=$_POST['group_num'];
						$course_code=$_POST['course_code'];
						$course_name=$_POST['course_name'];
						$db = new PDO("mysql:host=localhost;dbname=emu_register", "root", "");
						$default_p=$db->query("SELECT * FROM schedule WHERE s_id=$user_id")->fetchAll(PDO::FETCH_ASSOC);
						//echo $default_p[0]["periods"];
					//	echo print_r($schedule_p);
						//$dp=subArraysToString($default_p);
						//$default_p=preg_split("/[\s,]+/", $dp);
						//echo print_r($default_p);;

					//	echo $group_id."oooo".$course_code."eeee".$course_name;


?>
<input type="hidden" id="default_p" name="default_p" value="<?php echo $default_p[0]["periods"];?>" >
<?php
}
?>
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
			<div class="container">

				<!--Semesters Panel-->



				<center><h2 class="display-4">Semesters</h2></center>
				<div id="accordion">


				<div class="card">
					<?php
					$i=0;
					while($i < 5){
						$c=displaySemCourses(1);
					?>
						<div class="card-header">
							<a class="collapsed card-link" data-toggle="collapse" aria-expanded="true" href="#collapseOne">
								Semester 1 <i class="fa fa-check-square text-success" data-toggle="tooltip" title="All courses are taken in this semester!"></i>
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
								<button type="button" href="#<?php echo $count2;?>" class="bb btn-md btn btn-basic btn-block border-top pt-2 " data-toggle="collapse">
								<?php echo $crs["course_code"]."---".$crs["course_name"];?>
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
								<?php echo $crs["course_code"]."---".$crs["course_name"];?>
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
									<?php echo $crs["course_code"]."---".$crs["course_name"];?>
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
									<?php echo $crs["course_code"]."---".$crs["course_name"];?>
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
									<?php echo $crs["course_code"]."---".$crs["course_name"];?>
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
									<?php echo $crs["course_code"]."---".$crs["course_name"];?>
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
									<?php echo $crs["course_code"]."---".$crs["course_name"];?>
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
									<?php echo $crs["course_code"]."---".$crs["course_name"];?>
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
		</div>
	</div>
</div>
<?php
if(isset($_POST["select_btn"])){
	$group_id=$_POST['group_num'];
	$course_code=$_POST['course_code'];
	$course_name=$_POST['course_name'];
	$group_tt=$_POST['group_tt'];
	$classes=$_POST['classes'];
//	echo $group_id."oooo".$course_code."eeee".$course_name;
?>

<form name="passing" >
	<input type="hidden" id="g_i" name="g_i" value="<?php echo $group_id;?>" >
	<input type="hidden" id="c_c" name="c_c" value="<?php echo $course_code; ?>" >
	<input type="hidden" id="c_n" name="c_n" value="<?php echo $course_name;?>" >
	<input type="hidden" id="group_tt" name="c_i" value="<?php echo $group_tt;?>" >
	<input type="hidden" id="classes" name="classes" value="<?php echo $classes;?>" >


<?php
}
?>
<?php
$loopSelected=0;
while($loopSelected<$takenNum){
 ?>
<input type="hidden" id="<?php echo 'cc'.$loopSelected?>" name="taken" value="<?php echo $takenCourses[$loopSelected]["course_code"];?>" >
<input type="hidden" id="<?php echo 'cn'.$loopSelected?>" name="taken" value="<?php echo $takenCourses[$loopSelected]["course_name"];?>" >
<input type="hidden" id="<?php echo 'g'.$loopSelected?>" name="taken" value="<?php echo $takenCourses[$loopSelected]["group_id"];?>" >

<input type="hidden" id="count" name="count" value="<?php echo $takenNum;?>" >
<input type="hidden" id="count" name="count" value="<?php echo $takenNum;?>" >


<?php $loopSelected++;}?>

</form>

</body>


	<script>




	displayDefaultSelectedCourses();

	var rIndex, cIndex, td, split_p, split_c, slot, table_index, output, matched, c, r, col_id, row_id, mid, res_arr, displayed, display_btn, select_btn;
	var default_p;
	//retrieve main timetable and "Selected Courses" table
	var table = document.getElementById("timetable");

//  var table = document.getElementById("tbody");
	var group_id=document.getElementById('g_i').value;
	var course_code=document.getElementById('c_c').value;
	var course_name=document.getElementById('c_n').value;
	var group_tt=document.getElementById('group_tt').value;
	var classes=document.getElementById('classes').value;
	//var takes=document.getElementById('takes').value;

	//console.log("these are the periods: "+group_tt);
	//console.log("these are the classes: "+classes);


	var d_p=document.getElementById('default_p').value;
	console.log("retrieving all periods from schedule timetable");
	if(d_p){
		console.log("Periods found! these are them: "+d_p);
		displayDefaultTimetable(d_p);
		console.log("finished displayDefaultTimetable");

	}

	function displayDefaultTimetable(d_p){
		console.log("inside default laying out timetable");
		display(d_p);
		console.log("finished normal display function sending only one parameter");
	}


	function displayDefaultSelectedCourses(){

	var cnt = document.getElementById('count').value;
	// console.log(cnt);
	for(var i=0; i<parseInt(cnt); i++){
		var cc_id=("cc"+i).toString();
		var cn_id=("cn"+i).toString();
		var g_id=("g"+i).toString();

		console.log("this is the cc: "+cc_id);
		console.log("this is the cn: "+cn_id);
		 console.log("this is the g: "+g_id);
		var taken_cc = document.getElementById(cc_id).value;
		var taken_cn = document.getElementById(cn_id).value;
		var taken_g = document.getElementById(g_id).value;

		console.log(taken_cc+" "+taken_cn+" "+taken_g);

	var string='<tr>';
	string+='<td align="center">'+taken_g+'</td>';
	string+='<td align="center">'+taken_cc+'</td>';
	string+='<td>'+taken_cn+'</td>';
	string+='<td><button type="button" class="btn btn-primary btn-sm" >Drop Course</button></td></tr>';
	$("#tbody").prepend(string);
	}
}

	// function displayDefaultSelectedCourses(periods){
	// 	default_p=parse(periods);
	// }

	function display(str1, str2, course_code){
		console.log("calling display");

		split_p=parse(str1);
		if(str2){
			split_c=parse(str2);
		}

					//for each element of period
		for(var i=0; i<split_p.length; i++){
				//convert period number into index of 2D Matrix that represents timetable
				slot = generateIndices(split_p[i]);
				//match generated index with timetable index, finding correct day and lecture hour
				table_index = match(slot);
				//insert course code and period into appropriate day and lecture hour (matching table cell)

				displayed=insert(table_index, course_code, split_c[i]);

		}
		}

		function parse(s){
			res_arr=s.split(", ");
			return res_arr;
		}

		function generateIndices(p){
			//algorithm to calculate row index and column index, returned as a tuple
			c=p%10;
	    var temp=c;
	    var temp2=c;
			if(c>5){
				col_id=(temp-5)%10+1;
			}else if(c<5){
	      col_id=temp2+1;
	    }else if(c=5){
				col_id=1;
	    }
			r=parseInt(p/10);
			if(r==0){
				if(p<5){row_id=1;}
				else if(p>=5){row_id=2;}
			}else if(r!=0){
				mid=((r*10)+((r+1)*10))/2;
				if(p<mid){
					row_id=r*2+1;
				}else if(p>=mid){
					row_id=r*2+2;
				}
			}
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
					return matchedIndex;
				}
			}


				function insert(i, cc=null, c=null){
					//i is index of matching table index generated from match function
					output=table.rows[i[0]].cells[i[1]];
					var htmlstring = output.innerHTML;
					//clash algorithm
					//if periods are repeated, count repetitions calling duplicate function
					//var clashPeriods = duplicate(combined).trim().split(" ");
					//how many repetitions (clashes)
					//var numOfClashes = clashPeriods.length;
				//	var isClash=0;
					//if there's no clash and cell is empty, mark color is transparent, no alarming design
				//if(!isClash && htmlstring==""){
				if(cc){
						output.innerHTML+=
									"<a class='text-primary pt-4 '><br><mark>"+cc+"/"+c+"</mark></a>";
								}
				else{
					output.innerHTML+=
								"<a class='text-primary pt-4 '><br><mark>GOTCHA</mark></a>";
								}
					//}
					///there is clash, highlight it in red
					// else{
					// 	var i=0;
					// 	output.innerHTML+="<a class='text-primary pt-4 bg-light'><br><mark>"+cc+"/"+c+"</mark></a>";
					// 	while(i<numOfClashes){
					// 		var val = generateIndices(clashPeriods[i]);
					// 		console.log("this is the generated index: "+val[0]+" and "+ val[1]);
					// 		//document.getElementById("thiscolor").style.background='#dc3545';
					// 		i++;
					// 	}
					// }
					return output;
				}



  // var row = table.insertRow(1);
  // var cell1 = row.insertCell(0);
  // var cell2 = row.insertCell(1);
  // var cell3 = row.insertCell(2);
	var html='<tr>';
	html+='<td align="center">'+group_id+'</td>';
	html+='<td align="center">'+course_code+'</td>';
	html+='<td>'+course_name+'</td>';
	html+='<td><button type="button" class="btn btn-primary btn-sm" >Drop Course</button></td></tr>';
	$("#tbody").prepend(html);
  // cell1.innerHTML = "CMPE CODE";
  // cell2.innerHTML = "COURSE NAME"
  // cell3.innerHTML = '<button type="button" class="btn btn-sm">Basic</button>';


function myDeleteFunction() {
  document.getElementById("selected-c").deleteRow(1);
}
</script>

</div>
</html>
