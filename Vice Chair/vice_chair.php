<?php

include "../config.php";

// logout and go to login page
if(isset($_GET["operation"]) && $_GET["operation"] == "logout") {
	session_destroy();
	header("Location: ../index.php");
}

$user_id=$_SESSION["user_id"];
$user=$db->query("SELECT * FROM users WHERE user_id=$user_id")->fetchAll(PDO::FETCH_ASSOC);
$username=$user[0]["name"];
$faculty_id=$user[0]['faculty_id'];
$department_id=$user[0]['department_id'];

$advisors=$db->query("SELECT * FROM users WHERE role='advisor' AND faculty_id=$faculty_id AND department_id=$department_id")->fetchAll(PDO::FETCH_ASSOC);

?>
<html>
<head>
<title> Vice Chair </title>
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
  var table, rows, switching, i, x, y,x2,y2,x3,y3,x4,y4, shouldSwitch;
  table = document.getElementById("std-table-s");
  switching = true;

  while (switching) {
    switching = false;
    rows = table.rows;
    for (i = 1; i < (rows.length - 1); i++) {
      shouldSwitch = false;
      x = rows[i].getElementsByTagName("TD")[3];
      y = rows[i + 1].getElementsByTagName("TD")[3];
	  x2 = rows[i].getElementsByTagName("TD")[2];
	  y2 = rows[i + 1].getElementsByTagName("TD")[2];
	  x3 = rows[i].getElementsByTagName("TD")[1];
	  y3 = rows[i + 1].getElementsByTagName("TD")[1];
	  x4 = rows[i].getElementsByTagName("TD")[0];
	  y4 = rows[i + 1].getElementsByTagName("TD")[0];
	  if(status=="ns"){
		  if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
			shouldSwitch = true;
			break;
		  }
	  }else if (status=="s"){
		if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
			shouldSwitch = true;
			break;
		  }
	  }else if (status=="d"){
		if (x2.innerHTML.toLowerCase() > y2.innerHTML.toLowerCase()) {
			shouldSwitch = true;
			break;
		  }
	  }else if (status=="f"){
		if (x3.innerHTML.toLowerCase() > y3.innerHTML.toLowerCase()) {
			shouldSwitch = true;
			break;
		  }
	  }else if (status=="a"){
		if (x4.innerHTML.toLowerCase() > y4.innerHTML.toLowerCase()) {
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
                <nav class="navbar navbar-expand-xl justify-content-start navbar-dark ">
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
				<input class="form-control" id="std-search" type="text" placeholder="Search from table.."> <!--********************** Search *********************-->
				<br>
				<div class="row">
					<div class="col-3 "><h4>Advisors</h4></div>
					<div class=" col-6"></div>
					<div class=" col-3 form-group">
					  <select  onChange="sortTable(this.value);" class="form-control" id="sel1">
						<option disabled selected>Order</option>
						<option value="a">A-Z Advisor Name</option>
						<option value="f">A-Z Faculty</option>
						<option value="d">A-Z Department</option>
						<option value="s">Least student first</option>
						<option value="ns">Most student first</option>
					  </select>
					</div>
				</div>
				<table id="std-table-s" class="table table-striped "> <!--********************** Advisor Tabel *********************-->
					<thead>
						<tr>
							<th>Advisor Name</th>
							<th>Faculty</th>
							<th>Department</th>
							<th># of student</th>
							<th></th>
							<th>Assign Student</th>
						</tr>
					</thead>
					<tbody id="std-table">
                        <?php for($i=0;$i<count($advisors);$i++) { ?>
						<tr >
							<td><?php echo $advisors[$i]['name']." ".$advisors[$i]['surname'] ?></td>

							<td><?php $faculty_id=$advisors[$i]['faculty_id'];
                            $register=$db->query("SELECT * FROM faculties WHERE faculty_id=$faculty_id")->fetchAll(PDO::FETCH_ASSOC);
                            $faculty=$register[0]['faculty'];
                            echo $faculty; ?></td>

				            <td><?php $department_id=$advisors[$i]['department_id'];
                            $register=$db->query("SELECT * FROM departments WHERE department_id=$department_id")->fetchAll(PDO::FETCH_ASSOC);
                            $department=$register[0]['department'];
                            echo $department; ?></td>

							<td> <?php
                                $advisor_id=$advisors[$i]['user_id'];
                                $student=$db->query("SELECT * FROM student WHERE advisor_id=$advisor_id")->fetchAll(PDO::FETCH_ASSOC);
                                echo count($student); ?> </td>

                            <td align="center"><button type="button" class="btn btn-sm btn-primary ml-1" href="user_information.php" onclick="window.open('user_information.php?user_id=<?php echo $advisors[$i]['user_id'] ?>', 'newwindow', 'width=820, height=242'); return false;">More Information</button></td>
							<td align="center" ><button type="button" onclick="location.href='vc_manage_student.php?user_id=<?php echo $advisors[$i]['user_id'] ?>'" class="btn btn-sm btn-success" style="width:140px">Manage Students</button></td>
						</tr>
                        <?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
</body>

</html>
