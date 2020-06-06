<?php

include "../config.php";

// logout and go to login page
if(isset($_GET["operation"]) && $_GET["operation"] == "logout") {
	session_destroy();
	header("Location: ../index.php");
}

$user_id=$_SESSION["user_id"];
$student=$db->query("SELECT * FROM users JOIN student ON users.user_id=student.s_id WHERE users.role='student'")->fetchAll(PDO::FETCH_ASSOC);
$numStudents=count($student);
echo $numStudents;

?>
<html>

<head>
<title> advisor </title>
<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="/css/advisor.css" rel="stylesheet" type="text/css">
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
				<a class="nav-link text-light active" href='?operation=logout' color="white">LOGOUT</a>
			</nav>
		</div>
	</div>
	<div class="container-fluid my-3">
		<div class="container-fluid">

			<div class="container-fluid my-3">
				<input class="form-control" id="std-search" type="text" placeholder="Search from table..">
				<br>
				<div class="row">
					<div class="col-3 "><h4>Number of Student : <?php echo $numStudents; ?></h4></div>
					<div class=" col-6"></div>
					<div class=" col-3 form-group">
					  <select  onChange="sortTable(this.value);" class="form-control" id="sel1">
						<option disabled selected>Order</option>
						<option value="s">Submited Student First</option>
						<option value="ns">Not Submited Student First</option>
					  </select>
					</div>
				</div>
			  <table id="std-table-s" class="table table-striped">
				<thead>
				  <tr>
					<th>Student ID</th>
					<th>Student Name</th>
					<th>Semester</th>
					<th></th>
					<th>Registration Status</th>
				  </tr>
				</thead>
				<tbody id="std-table">

					<?php
					$i=0;
					while($i<$numStudents){
					?>

				  <tr >
					<td><?php echo $student[$i]["user_id"];?></td>
					<td><?php echo $student[$i]["name"].' '.$student[$i]["surname"];?></td>
					<td><?php echo $student[$i]["current_sem"]?></td>
					<td align="center"><button type="button" class="btn btn-sm btn-primary ml-1" href="user_information.php" onclick="window.open('user_information.php?id=<?php echo $student[$i]["user_id"]?>', 'newwindow', 'width=820, height=242'); return false;">More Information</button></td>
					<td align="center" >
						<?php
						$s_id=$student[$i]["user_id"];
						$student_schedule=$db->query("SELECT * FROM schedule WHERE s_id=$s_id")->fetchAll(PDO::FETCH_ASSOC);
						if($student_schedule[0]["confirmed"]){
						?>
						<button type="button" class="btn btn-sm w-50 btn-success">Submited</button></td>
					<?php } else{?>
						<form action="advisor_submit_tt.php" method="post">
								<input type="submit" class="btn btn-sm w-50 btn-warning" name="select" value="Click to submit" />
								<input type="hidden" name="student_id" value="<?php echo $s_id; ?>"/>
						</form>
						<?php
					}
					?>
				  </tr>

					<?php
					$i++;}?>
				  <!-- <tr> -->
					<!-- <td>17700283</td>
					<td>Amina Ait Ben Ouissaden</td>
					<td>b</td>
					<td align="center"><button type="button" class="btn btn-sm btn-primary ml-1" href="user_information.php" onclick="window.open('user_information.php', 'newwindow', 'width=820, height=242'); return false;">More Information</button></td>
					<td align="center" ><button type="button" onclick="location.href='advisor_submit_tt.php'" class="btn btn-sm w-50 btn-primary">View Timetable</button></td>
				  </tr> -->
				</tbody>
			  </table>
			</div>
		</div>
	</div>
</div>
</body>

</html>
