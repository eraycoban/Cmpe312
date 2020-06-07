<?php

include "../config.php";

// logout and go to login page
if(isset($_GET["operation"]) && $_GET["operation"] == "logout") {
	session_destroy();
	header("Location: ../index.php");
}

$advisor_id=$_GET['user_id'];

$advisor=$db->query("SELECT * FROM users WHERE user_id=$advisor_id")->fetchAll(PDO::FETCH_ASSOC);
$advisor_faculty_id=$advisor[0]['faculty_id'];
$advisor_department_id=$advisor[0]['department_id'];



if(isset($_POST['as_student'])){
    $as_students=$_POST;
    foreach($as_students as $key=>$value){
    $student_id=(int)$value;
    $register=$db->query("UPDATE student SET reg_status=0 WHERE s_id=$student_id");
    $register=$db->query("UPDATE student SET advisor_id=NULL WHERE s_id=$student_id");
    }
}

if(isset($_POST['us_student'])){
    $us_students=$_POST;
    foreach($us_students as $key=>$value){
    $student_id=(int)$value;
    $register=$db->query("UPDATE student SET reg_status=0 WHERE s_id=$student_id");
    $register=$db->query("UPDATE student SET advisor_id=$advisor_id WHERE s_id=$student_id");
    }
}

?>
<html>
<head>
<title> Manage Student </title>
<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="/css/vice_chair.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <!-- Script for search student -->

<script>
$(document).ready(function(){
  $("#assigned-std-search").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#assigned-std-table tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
  <script>
$(document).ready(function(){
  $("#unassigned-std-search").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#unassigned-std-table tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>

<script> <!-- Script for Order by status -->
function sortTable(status) {
  var table, rows, switching, i, x, y, shouldSwitch;
  table = document.getElementById("std-table-s");
  switching = true;

  while (switching) {
    switching = false;
    rows = table.rows;
    for (i = 1; i < (rows.length - 1); i++) {
      shouldSwitch = false;
      x = rows[i].getElementsByTagName("TD")[4];
      y = rows[i + 1].getElementsByTagName("TD")[4];
	  if(status=="ns"){
		  if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
			shouldSwitch = true;
			break;
		  }
	  }else if (status=="s"){
		if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
			shouldSwitch = true;
			break;
		  }
	  }
	}
    if (shouldSwitch) {
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
    }
  }
}
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
a.peginatin_tc{
	text-color:#429ef5;
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

	<div class="mainnav row no-gutter shadow-lg">
            <div class="col-2">
                <nav class="navbar navbar-expand-xl justify-content-start navbar-dark ">
                    <a class="nav-link text-light ml-5" href="vice_chair.php" color="white">HOME</a>
                </nav>
            </div>
            <div class="col-3">
                <nav class="navbar navbar-expand-xl justify-content navbar-dark ">
                    <a class="nav-link text-light ml-5" href="vc_courses.php" color="white">COURSE</a>
                </nav>
            </div>
            <div class="col-7">
                <nav class="navbar navbar-expand-xl justify-content-end navbar-dark">
                    <a class="nav-link text-light mr-5 active" href="?operation=logout" color="white">LOGOUT</a>
                </nav>
            </div>
        </div>
	<div class="container-fluid my-3">
		<div class="container-fluid">

			<div class="container-fluid my-3">
				<div class="row">
					<div class="col-12 ">

							<table class="table table-bordered shadow-sm"> <!--********************** Advisor Info Panel *********************-->
								<thead>
									<tr>
										<th rowspan="2"><img style="height:100px;display: block;margin-left: auto;margin-right: auto;" alt="PP"></th>
										<th class="text-primary">Name: <a class="text-dark"><?php echo $advisor[0]['name']." ".$advisor[0]['surname'] ?></a></th>
										<th class="text-primary">Number of Students: <a class="text-dark"> <?php $student=$db->query("SELECT * FROM student WHERE advisor_id=$advisor_id ")->fetchAll(PDO::FETCH_ASSOC);
                                            echo count($student);
                                            ?> </a></th>
									</tr>
									<tr>
										<th class="text-primary">Department: <a class="text-dark"><?php $department_id=$advisor[0]['department_id'];
                                        $register=$db->query("SELECT * FROM departments WHERE department_id=$department_id")->fetchAll(PDO::FETCH_ASSOC);
                                        $department=$register[0]['department'];
                                        echo $department; ?></a></th>
										<th class="text-primary">Avg student per advisor: <a class="text-dark"> ## </a></th>
									</tr>
								</thead>
							</table>

					</div>
				</div>
				<input class="form-control" id="assigned-std-search" type="text" placeholder="Search from assigned student table..">
				<br>
				<div class="row">
					<div class="col-3 "><h4>Assigned Students</h4></div> <!--********************** Assigned Students List *********************-->
					<div class=" col-6"></div>
					<div class=" col-3 form-group">
					  <select  onChange="sortTable(this.value);" class="form-control" id="sel1">
						<option disabled selected>Order</option>
						<option value="s">Submited student first</option>
						<option value="ns">Unsubmited student first</option>
					  </select>
					</div>
				</div>

                <form method="post" action="vc_manage_student.php?user_id=<?php echo $advisor_id ?>">
				  <table id="std-table-s" class="table table-striped">
					<thead>
						<tr>
							<th>Student ID</th>
							<th>Student Name</th>
							<th>Semester</th>
							<th></th>
							<th>Registration Status</th>
							<td align="center"><button type="submit" name="as_student" class="btn btn-sm w-75 btn-primary">Unassign Students</button></td>
						</tr>
					</thead>
					<tbody id="assigned-std-table">
                        <?php
                        $as_students=$db->query("SELECT * FROM student WHERE advisor_id=$advisor_id")->fetchAll(PDO::FETCH_ASSOC);
                        ?>
                        <?php for($i=0;$i<count($as_students);$i++) {
                        if($as_students[$i]['reg_status']==1){
                        ?>
						<tr >
							<td><?php echo $as_students[$i]['s_id'] ?></td>
							<td><?php
                            $student_id=$as_students[$i]['s_id'];
                            $student=$db->query("SELECT * FROM users WHERE user_id=$student_id")->fetchAll(PDO::FETCH_ASSOC);
                            echo $student[0]['name']." ".$student[0]['surname'];
                            ?></td>
							<td>z</td>
                            <td align="center"><button type="button" class="btn btn-sm btn-primary ml-1" href="user_information.php" onclick="window.open('user_information.php?user_id=<?php echo $student[0]['s_id'] ?>', 'newwindow', 'width=820, height=242'); return false;">More Information</button></td>
							<td align="center" ><button type="button" class="btn btn-sm w-50 btn-success">Submited</button></td>
							<td align="center" ><input name="<?php echo $i ?>" value="<?php echo $student[0]['s_id'] ?>" type="checkbox" class="form-check-input" id="exampleCheck1"></td>
						</tr>
                        <?php }else { ?>
						<tr>
							<td><?php echo $as_students[$i]['s_id'] ?></td>
							<td><?php
                            $student_id=$as_students[$i]['s_id'];
                            $student=$db->query("SELECT * FROM users WHERE user_id=$student_id")->fetchAll(PDO::FETCH_ASSOC);
                            echo $student[0]['name']." ".$student[0]['surname'];
                            ?></td>
							<td>b</td>
							<td align="center"><button type="button" class="btn btn-sm btn-primary ml-1" href="user_information.php" onclick="window.open('user_information.php?user_id=<?php echo $student[0]['user_id'] ?>', 'newwindow', 'width=820, height=242'); return false;">More Information</button></td>
							<td align="center" ><button type="button" onclick="location.href='vice_chair_submit_tt.php?user_id=<?php echo $student[0]['user_id']?>'" class="btn btn-sm w-50 btn-primary">View Timetable</button></td>
							<td align="center" ><input name="<?php echo $i ?>" value="<?php echo $student[0]['user_id'] ?>"  type="checkbox" class="form-check-input" id="exampleCheck1"></td>
						</tr>
                        <?php } }?>
					</tbody>
				  </table>
				</form>

				<hr>
				<input class="form-control" id="unassigned-std-search" type="text" placeholder="Search from unassigned student table..">
				<br>
				<div class="row">
					<div class="col-3 mb-2"><h4>Unassigned Students</h4></div> <!--********************** Unassigned Students List *********************-->
					<div class=" col-6"></div>
					<div class=" col-3 form-group">
				<!--	  <select  onChange="sortTable(this.value);" class="form-control" id="sel1">
						<option disabled selected>Order</option>
						<option value="s">Least student first</option>
						<option value="ns">Most student first</option>
					  </select> -->
					</div>
				</div>

                <form method="post" action="vc_manage_student.php?user_id=<?php echo $advisor_id ?>">
				  <table id="std-table-s" class="table table-striped">
					<thead>
					  <tr>
						<th>Student ID</th>
						<th>Student Name</th>
						<th>Semester</th>
                          <th></th>
						<td align="center"><button name="us_student" type="submit" class="btn btn-sm w-50 btn-primary">Assign Students</button></td>
					  </tr>
					</thead>
					<tbody id="unassigned-std-table">
                    <?php $us_students=$db->query("SELECT * FROM student WHERE advisor_id IS NULL AND s_id IN (SELECT user_id FROM users WHERE faculty_id=$advisor_faculty_id AND department_id=$advisor_department_id);")->fetchAll(PDO::FETCH_ASSOC);
                      for($i=0;$i<count($us_students);$i++) { ?>
					  <tr >
						<td><?php echo $us_students[$i]['s_id'] ?></td>
						<td><?php
                            $student_id=$us_students[$i]['s_id'];
                            $student=$db->query("SELECT * FROM users WHERE user_id=$student_id")->fetchAll(PDO::FETCH_ASSOC);
                            echo $student[0]['name']." ".$student[0]['surname'];
                            ?></td>
						<td>z</td>
						<td align="center"><button type="button" class="btn btn-sm btn-primary ml-1" href="user_information.php" onclick="window.open('user_information.php?user_id=<?php echo $student[0]['user_id'] ?>', 'newwindow', 'width=820, height=242'); return false;">More Information</button></td>
						<td align="center" ><input name="<?php echo $i ?>" value="<?php echo $student[0]['s_id'] ?>"  type="checkbox" class="form-check-input" id="exampleCheck1"></td>
					  </tr>
                        <?php } ?>
					</tbody>
				  </table>
                </form>

			</div>

		</div>
	</div>
</div>
</body>

</html>
