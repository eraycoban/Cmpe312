<?php

include "../config.php";

// logout and go to login page
if(isset($_GET["operation"]) && $_GET["operation"] == "logout") {
	session_destroy();
	header("Location: ../index.php");
}



$student=$db->query("SELECT * FROM student JOIN departments ON student.department=departments.department")->fetchAll(PDO::FETCH_ASSOC);
$numOfStudents=count($student);

?>

<html>

<head>
<title> Vice Dean </title>
<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <!-- Script for search student -->
  <script>
$(document).ready(function(){
  $("#department-std-search").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#department-std-table tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
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

</style>

</head>

<body>

	<div class="main h-100">
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
					<div class="nav-item dropdown">
						<a class="nav-link text-light dropdown-toggle ml-5" data-toggle="dropdown" href="#" color="white">Departmants</a>
						<div class="dropdown-menu ml-5">
							<a class="dropdown-item" href="#">Link 1</a>
							<a class="dropdown-item" href="#">Link 2</a>
							<a class="dropdown-item" href="#">Link 3</a>
						</div>
					</div>
					<a class="nav-link text-light active" href="#" color="white">All</a>
				</nav>
			</div>
		</div>
		<div class="container my-3 h-100">
			<div class="row pb-2 h-100 ">
				<div class="col-12">
					<ul class="nav nav-tabs nav-justified">
						<li class="nav-item">
							<a class="nav-link bg-light " href="location.href='vd_courses.php?program=<?php echo $program_id?>" >Courses</a>
						</li>
						<li class="nav-item ">
							<a class="nav-link bg-light border border-primary border-bottom-0" href="#" >Students</a>
						</li>
					</ul>
					<div class="container-fluid overflow-auto bg-light rounded border pt-3 h-100">
						<div class="row">
							<div class="col-6 pb-2"><h4>Department Students</h4></div> <!--********************** Assigned Students List *********************-->
							<div class=" col-6"><input class="form-control" id="department-std-search" type="text" placeholder="Search ..."></div>
						</div>
						  <table id="std-table-s" class="table table-striped">
							<thead>
								<tr>
									<th>Student ID</th>
									<th>Student Name</th>
									<th>Semester</th>
									<th>GPA/CGPA</th>
									<th>Program</th>
									<th></th>
								</tr>
							</thead>
							<tbody id="department-std-table">
								<?php

								$i=0;
								while($i<$numOfStudents){
									$id=$student[$i]['s_id'];
									$studentProgram=$db->query("SELECT * FROM users WHERE user_id=$id")->fetchAll(PDO::FETCH_ASSOC);

								?>
								<tr >
									<td><?php echo $student[$i]["s_id"];?></td>
									<td><?php echo $student[$i]["name"]." ".$student[$i]["surname"];?></td>
									<td><?php echo $student[$i]["current_sem"];?></td>
									<td><?php echo $student[$i]["GPA"]."/".$student[$i]["CGPA"];?></td>
									<td><?php echo $studentProgram[0]["program"];?></td>
									<td align="center"><button type="button" class="btn btn-sm btn-primary ml-1" href="user_information.php" onclick="window.open('user_information.php?id=<?php echo $student[$i]["s_id"];?>', 'newwindow', 'width=820, height=242'); return false;">Show More</button>
								</tr>
								<?php $i++;}?>
							</tbody>
						  </table>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>
</body>
</html>
<script>
function myFunction() {
  // Declare variables
  var input, filter, table, selected, td, td1, i, txtValue;
  input = document.getElementById('std-search');
  filter = input.value.toUpperCase();
  table = document.getElementById("std-table-s");
  tr = table.getElementsByTagName('tr');

  // Loop through all list items, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    txtValue = td.textContent || td.innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1 ) {
      tr[i].style.display = "";
    } else {
      tr[i].style.display = "none";
    }
  }
}
</script>
