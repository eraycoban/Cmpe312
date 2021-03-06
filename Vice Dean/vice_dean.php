<?php
//first page
include "../config.php";

// logout and go to login page
if(isset($_GET["operation"]) && $_GET["operation"] == "logout") {
	session_destroy();
	header("Location: ../index.php");
}

//id 6 is CMPE department
$dept=$db->query("SELECT * FROM programs WHERE department_id=6")->fetchAll(PDO::FETCH_ASSOC);
echo $dept[0]["program_id"];
$deptCount = count($dept); //total number of programs
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
  $("#std-search").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#std-table tr").filter(function() {
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
				<div class="col-12 h-100">
					<ul class="nav nav-tabs nav-justified">
						<li class="nav-item">
						  <a class="nav-link  bg-white" href="#" disabled>Courses</a>
						</li>
						<li class="nav-item ">
						  <a class="nav-link bg-white" href="vd_students.php" disabled>Students</a>
						</li>
					  </ul>
					<div class="container-fluid overflow-auto bg-light rounded border h-100" style="padding-top:25%;">
						<center><h4 class="text-muted" style="">Select a Department</h4> <br>

								<?php
								//loop through all available programs and list them
								$i=0;
								while ($i<$deptCount){
									?>
									<div class="container list-group" >
										<!--when clicked, sends selected program id to next page-->
								<a href="#" class="list-group-item list-group-item-action" onclick="location.href='vd_courses.php?program_id=<?php echo $dept[$i]["program_id"]?>'"><?php echo $dept[$i]["program"];?></a>
								</div>
							<?php $i++;} ?>

						</center>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>
</body>

</html>
