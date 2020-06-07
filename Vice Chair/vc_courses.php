<?php

include "../config.php";

// logout and go to login page
if(isset($_GET["operation"]) && $_GET["operation"] == "logout") {
	session_destroy();
	header("Location: ../index.php");
}

if(isset($_GET['course_id'])) {
    $course_id=$_GET['course_id'];
    $course=$db->query("SELECT * FROM course WHERE course_id=$course_id")->fetchAll(PDO::FETCH_ASSOC);
    $group_names=explode(", ",$course[0]['group_names']);

    $delete=$db->query("DELETE FROM course WHERE course_id=$course_id");
    foreach($group_names as $key => $value){
        $delete=$db->query("DELETE FROM course_group WHERE group_name='$value'");
    }

    header("Location: vc_courses.php");
}

$user_id=$_SESSION["user_id"];
$user=$db->query("SELECT * FROM users WHERE user_id=$user_id")->fetchAll(PDO::FETCH_ASSOC);
$department_id=$user[0]['department_id'];

$courses=$db->query("SELECT * FROM course")->fetchAll(PDO::FETCH_ASSOC);

$vc_department_ids=[];
$vc_courses=[];

for($i=0;$i<count($courses);$i++){
    $departments=explode(", ",$courses[$i]['departments']);
    for($k=0;$k<count($departments);$k++){
        if($departments[$k]==$department_id){
            $vc_department_ids[$i]=$courses[$i]['course_id'];
            break;
        }
    }

}

foreach($vc_department_ids as $key => $value){
    $try=$db->query("SELECT * FROM course WHERE course_id='$value'")->fetchAll(PDO::FETCH_ASSOC);
    $vc_courses=array_merge($try,$vc_courses);
}


?>
<html>
<head>
<title> VC Courses </title>
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
  $("#std-search").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#std-table tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>

<script> <!-- Script for Order by status -->
function sortTable(status) {
  var table, rows, switching, i, x, y, x2, y2, shouldSwitch;
  table = document.getElementById("std-table-s");
  switching = true;

  while (switching) {
    switching = false;
    rows = table.rows;
    for (i = 1; i < (rows.length - 1); i++) {
      shouldSwitch = false;
      x = rows[i].getElementsByTagName("TD")[0];
      y = rows[i + 1].getElementsByTagName("TD")[0];
	  x1 = rows[i].getElementsByTagName("TD")[3];
      y1 = rows[i + 1].getElementsByTagName("TD")[3];
	  if(status=="a"){
		  if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
			shouldSwitch = true;
			break;
		  }
	  }else if (status=="d"){
		if (x1.innerHTML.toLowerCase() < y1.innerHTML.toLowerCase()) {
			shouldSwitch = true;
			break;
		  }
	  }else if (status=="i"){
		if (x1.innerHTML.toLowerCase() > y1.innerHTML.toLowerCase()) {
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
                <nav class="navbar navbar-expand-xl justify-content-start navbar-dark ">
                    <a class="nav-link text-light ml-5" href="#" color="white">COURSE</a>
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
				<input class="form-control" id="std-search" type="text" placeholder="Search from table..">
				<br>
				<div class="row">
					<div class="col-6 "><h4>Department Name Courses:</h4></div>
					<div class=" col-3"></div>
					<div class=" col-3 form-group">
						<select  onChange="sortTable(this.value);" class="form-control" id="sel1">
							<option disabled selected>Order By</option>
							<option value="a">Course Code</option>
							<option value="i">Increasing Semester</option>
							<option value="d">Decreasing Semester</option>
						</select>
					</div>
				</div>
				<table id="std-table-s" class="table table-striped "> <!--********************** Course List *********************-->
					<col>
					<col>
					<col>
					<col>
					<col>
					<thead>
						<tr>
							<th>Course Code</th>
							<th>Course Name</th>
							<th>Course Program</th>
							<th>Course Semester</th>
							<td align="center"><button style="width:130px" onclick="location.href='vc_new_course.php'" type="button" class="btn btn-sm mx-1 btn-success">Add New Course</button></td>
						</tr>
					</thead>
					<tbody id="std-table">
                        <?php for($i=0;$i<count($vc_courses);$i++){ ?>

                        <?php
                            $program_ids=[];
                            $programs=[];
                            $program_ids=explode(', ',$vc_courses[$i]['programs']);
                            foreach($program_ids as $key => $value){
                            $try=$db->query("SELECT program FROM programs WHERE program_id='$value'")->fetchAll(PDO::FETCH_ASSOC);
                            $programs=array_merge($try,$programs); }


                        ?>

						<tr >
							<td><div class="overflow-auto" style="max-height:80px"><?= $vc_courses[$i]['course_code'] ?></div></td>
							<td><?= $vc_courses[$i]['course_name'] ?></td>
                            <td><?php for($j=0;$j<count($programs);$j++){ echo $programs[$j]['program']."</br>";} ?></td>
							<td><?= $vc_courses[$i]['sem_id'] ?></td> <!--********************** Under this line, there are 3 button first more info:opens a window "course_information.html, second Edit : it same with add new course but text box will be filled , thir delete" *********************-->
							<td align="center" ><button style="width:140px" type="button" class="btn btn-sm btn-primary ml-1" href="course_information.php" onclick="window.open('course_information.php?course_id=<?= $vc_courses[$i]['course_id'] ?>', 'newwindow', 'width=820, height=400'); return false;">More Information</button><button style="width:60px" onclick="location.href='vc_new_course.php?course_id=<?= $vc_courses[$i]['course_id'] ?>'" type="button" class="btn btn-sm mx-1 btn-primary">Edit</button><button style="width:60px" data-id="<?= $vc_courses[$i]['course_id'] ?>" data-name="<?= $vc_courses[$i]['course_name'] ?>" type="button" class="delete_course btn btn-sm mx-1 btn-danger">Delete</button></td>
						</tr>
                        <?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
    <!-- The Modal for Delete -->
						<div class="modal" id="deleteModal">
						  <div class="modal-dialog">
							<div class="modal-content">

							  <!-- Modal Header -->
							  <div class="modal-header">
								<h4 class="modal-title">Delete Course</h4>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							  </div>
							  <!-- Modal body -->
                            <form class="my_form" method="get" action="vc_courses.php">
                                <input  type="hidden" name='course_id' value="">
							  <div class="modal-body">
									<h5 id='username'>Name</h5><br>
                                    <a class="font-weight-bold">Are you sure you want to delete ?</a>

							  </div>

							  <!-- Modal footer -->
							  <div class="modal-footer">
								<button type="submit" class="btn btn-danger" >Delete</button>
							  </div>
                            </form>

							</div>
						  </div>
						</div>
    <script>
        $('.delete_course').click(function () {
            var course_id=$(this).data("id");
            var name=$(this).data("name");
            $('#username').html(name);
            $("input[name='course_id']").val(course_id);
            $('#deleteModal').modal();

        })
    </script>
</body>

</html>
