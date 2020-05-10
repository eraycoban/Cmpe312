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
$takes=$db->query("SELECT * FROM takes JOIN course WHERE s_id=$user_id")->fetchAll(PDO::FETCH_ASSOC);
$group=$db->query("SELECT * FROM groupst JOIN course ON groupst.course_code = course.course_code")->fetchAll(PDO::FETCH_ASSOC);
$var=$group[0]["i_id"];
$groupst=$db->query("SELECT * FROM instructor WHERE i_id=$var")->fetchAll(PDO::FETCH_ASSOC);


function displaySemCourses($sem_id){
	$db = new PDO("mysql:host=localhost;dbname=emu_register", "root", "");
	$course=$db->query("SELECT * FROM course WHERE sem_id=$sem_id")->fetchAll(PDO::FETCH_ASSOC);
	return $course;
}




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

					<div class="col-12">
						<table class="table table-sm tt shadow-lg">  <!--Timetable-->
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
								<td class="ts-3 clush">CMPE312 / CMPE137<br>CMPE312 / CMPE137</td>
								<td class="ts-3">CMPE312 / CMPE137</td>
								<td class="ts-3">CMPE312 / CMPE137</td>
								<td></td>
								<td></td>
							  </tr>
							  <tr class="ts-2" style="height:30px">
								<td>09:30-10:20</td>
								<td></td>
								<td class="ts-3">CMPE312 / CMPE137</td>
								<td class="ts-3">CMPE312 / CMPE137</td>
								<td class="ts-3">CMPE312 / CMPE137</td>
								<td class="ts-3">CMPE312 / CMPE137</td>
								<td></td>
							  </tr>
							  <tr class="ts-1" style="height:30px">
								<td>10:30-11:20</td>
								<td class="ts-3">CMPE312 / CMPE137</td>
								<td class="ts-3">CMPE312 / CMPE137</td>
								<td></td>
								<td></td>
								<td class="ts-3">CMPE312 / CMPE137</td>
								<td></td>
							  </tr>
							  <tr class="ts-2" style="height:30px">
								<td>11:30-12:20</td>
								<td class="ts-3">CMPE312 / CMPE137</td>
								<td class="ts-3">CMPE312 / CMPE137</td>
								<td></td>
								<td></td>
								<td class="ts-3">CMPE312 / CMPE137</td>
								<td></td>
							  </tr>
							  <tr class="ts-1" style="height:30px">
								<td>12:30-13:20</td>
								<td></td>
								<td></td>
								<td class="ts-3">CMPE312 / CMPE137</td>
								<td class="ts-3">CMPE312 / CMPE137</td>
								<td></td>
								<td></td>
							  </tr>
							  <tr class="ts-2" style="height:30px">
								<td>13:30-14:20</td>
								<td></td>
								<td></td>
								<td class="ts-3">CMPE312 / CMPE137</td>
								<td class="ts-3">CMPE312 / CMPE137</td>
								<td></td>
								<td></td>
							  </tr>
							  <tr class="ts-1" style="height:30px">
								<td>14:30-15:20</td>
								<td class="ts-3">CMPE312 / CMPE137</td>
								<td class="ts-3">CMPE312 / CMPE137</td>
								<td class="ts-3">CMPE312 / CMPE137</td>
								<td class="ts-3 text-success">CMPE312 / CMPE137</td>
								<td></td>
								<td></td>
							  </tr>
							  <tr class="ts-2" style="height:30px">
								<td>15:30-16:20</td>
								<td class="ts-3">CMPE312 / CMPE137</td>
								<td class="ts-3">CMPE312 / CMPE137</td>
								<td class="ts-3">CMPE312 / CMPE137</td>
								<td class="ts-3">CMPE312 / CMPE137</td>
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
								<th class="pl-4" colspan="4">Selected Courses</th>
							  </thead>
							<tbody>
							  <tr>
								<td>Group #</td>
								<td>CMPE 101</td>
								<td>COURSE NAME</td>
								<td align="right"><button type="button" class="btn btn-primary btn-sm" >Drop Course</button></td>
							  </tr>
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
				<?php
				$count=0;
				while($count < 8){
					$count++;
					$c=displaySemCourses($count);
				?>
				<div id="accordion">
					<div class="card">
						<div class="card-header">
							<a class="collapsed card-link" data-toggle="collapse" aria-expanded="true" href="#collapseOne">
								Semester <?php echo $count?> <i class="fa fa-check-square text-success" data-toggle="tooltip" title="All courses are taken in this semester!"></i>
							</a>
						</div>
						<div id="collapseOne" class="collapse" data-parent="#accordion"> <?php foreach ($c as $crs) { ?>

							<div class="bb btn-group btn-block" role="group" aria-label="Basic example">  <button type="button" href="#course3" class="bb btn-md btn btn-basic btn-block border-top pt-2 "  data-toggle="collapse">
								<?php echo $crs['course_code']."-----".$crs['course_name']; $course_code =$crs['course_code']; ?>
								 <i class="fa fa-caret-down"></i> </button>
								<form action="course_group.php" method="post">
								    <input type="submit" class="btn btn-light btn-secondary border-primary rounded-right" name="select" value="select" />
										<input type="hidden" name="course_code" value="<?php echo $course_code; ?>"/>
								</form>

									 <!-- <button type="button" name="select" value="select" class="btn btn-light btn-secondary border-primary rounded-right"> Select </button> </form></div> -->
							<div id="course1" class="collapse pl-3 border-top bg-light"><a>Group 1 -  MEHMET BODUR <a> <br> <a>Group 2 - TBH</a></div> <br>

							<!-- <div class="bb btn-group btn-block" role="group" aria-label="Basic example"> <button type="button" href="#course1" class="bb btn-md btn btn-basic btn-block border-top pt-2 "  data-toggle="collapse" disabled></button> <i class="fa fa-check-square text-success" data-toggle="tooltip" title="This course is already taken!"></i> </button> <button type="button" class="btn btn-light btn-secondary border-primary rounded-right" disabled>Select</button> </div>
							<div id="course1" class="collapse pl-3 border-top bg-light"><a>Group 1 -  MEHMET BODUR <a> <br> <a>Group 2 - TBH</a></div> <br>
							<div class="bb btn-group btn-block" role="group" aria-label="Basic example"> <button type="button" href="#course2" class="bb btn-md btn btn-basic btn-block border-top" data-toggle="collapse" disabled>MATH163 - Long Course Name <i class="fa fa-check-square text-success" data-toggle="tooltip" title="This course is already taken!"></i></button> <button type="button" class="btn btn-light btn-secondary border-primary" disabled>Select</button> </div>
							<div id="course2" class="collapse pl-3 border-top bg-light"><a>Group 1 - TBH</a> <br> <a>Group 2 - TBH</a></div> <br>
							<div class="bb btn-group btn-block" role="group" aria-label="Basic example"> <button type="button" href="#course3" class="bb btn-md btn btn-basic btn-block border-top pt-2 "  data-toggle="collapse">ENGL 191 - Long Course Name <i class="fa fa-caret-down"></i> </button> <button type="button" class="btn btn-light btn-secondary border-primary rounded-right">Select</button> </div>
							<div id="course3" class="collapse pl-3 border-top bg-light"><a>Group 1 -  MEHMET BODUR <a> <br> <a>Group 2 - TBH</a></div> <br>
							<div class="bb btn-group btn-block" role="group" aria-label="Basic example"> <button type="button" href="#course4" class="bb btn-md btn btn-basic btn-block border-top" data-toggle="collapse">ENGL 181 - Long Course Name <i class="fa fa-caret-down"></i></button> <button type="button" class="btn btn-light btn-secondary border-primary">Select</button> </div>
							<div id="course4" class="collapse pl-3 border-top bg-light"><a>Group 1 - TBH</a> <br> <a>Group 2 - TBH</a></div> <br>
							<div class="bb btn-group btn-block" role="group" aria-label="Basic example"> <button type="button" href="#course5" class="bb btn-md btn btn-basic btn-block border-top pt-2 "  data-toggle="collapse">MATH151 - Long Course Name <i class="fa fa-caret-down"></i> </button> <button type="button" class="btn btn-light btn-secondary border-primary rounded-right">Select</button> </div>
							<div id="course5" class="collapse pl-3 border-top bg-light"><a>Group 1 -  MEHMET BODUR <a> <br> <a>Group 2 - TBH</a></div> <br>
							<div class="bb btn-group btn-block" role="group" aria-label="Basic example"> <button type="button" href="#course6" class="bb btn-md btn btn-basic btn-block border-top" data-toggle="collapse">PHYS101 - Long Course Name <i class="fa fa-caret-down"></i></button> <button type="button" class="btn btn-light btn-secondary border-primary">Select</button> </div>
							<div id="course6" class="collapse pl-3 border-top bg-light"><a>Group 1 - TBH</a> <br> <a>Group 2 - TBH</a></div> <br> -->
						</div>
					</div>
				<?php }} ?>

						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>
</body>


	<script>
function myCreateFunction() {
  var table = document.getElementById("selected-c");
  var row = table.insertRow(1);
  var cell1 = row.insertCell(0);
  var cell2 = row.insertCell(1);
  var cell3 = row.insertCell(2);
  cell1.innerHTML = "CMPE CODE";
  cell2.innerHTML = "COURSE NAME"
  cell3.innerHTML = '<button type="button" class="btn btn-sm">Basic</button>';
}

function myDeleteFunction() {
  document.getElementById("selected-c").deleteRow(1);
}
</script>

</div>
</html>
