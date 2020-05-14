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


function listDept($fac_id){
	$db = new PDO("mysql:host=localhost;dbname=emu_register", "root", "");
	$dept=$db->query("SELECT * FROM faculties INNER JOIN departments ON departments.faculty_id=faculties.faculty_id WHERE faculties.faculty_id=$fac_id")->fetchAll(PDO::FETCH_ASSOC);
	return $dept;
}


?>
<html>
<head>
<title> Vice Dean </title>
<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="/css/vice_dean.css" rel="stylesheet" type="text/css">
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
					<a class="nav-link text-light active" href="#" color="white">FACULTIES </a>
					<a class="nav-link text-light active" href="#" color="white">STUDENTS </a>
                    <a class="nav-link text-light active" href='?operation=logout' color="white">LOGOUT</a>
				</nav>
			</div>
		</div>
		<div class="container-fluid my-3 h-100">
			<div class="row pb-2 h-100 ">
				<div class="col-4">
					<div class="container">
						<center><h2 class="display-4">Faculties</h2></center>

						<div id="accordion">
							<?php
							$count=0;
							$numOfFaculties=12;
							while($count<$numOfFaculties){
								$f=listDept($count+1);
								?>
							<div class="card">
								<div class="card-header">
									<a class="collapsed card-link" data-toggle="collapse" aria-expanded="true" href="#collapseOne">
										<?php echo $f[0]["faculty"];?>
									</a>
								</div>

								<div id="collapseOne" class="collapse" data-parent="#accordion">

									<ul class="list-group list-group-flush">
										<?php foreach ($f as $faculty){ ?>
										<li class="list-group-item">
											<form action="vd_courses.php" method="post">
												<button class="btn" onclick="location.href='vd_courses.php'">
													<input type="hidden" name="dept" value="<?php echo $faculty["department"];?>"/>
												<?php echo $faculty["department"];?>
												</button>
											</form>
										</li>
										<?php } ?>
									</ul>

								</div>
							</div>
						<?php $count++;} ?>




					</div>
					</div>
					</div>


				<div class="col-8 h-100">
					<ul class="nav nav-tabs nav-justified">
						<li class="nav-item">
						  <a class="nav-link  bg-white" onclick="location.href='vd_courses.php'" disabled>Courses</a>
						</li>
						<li class="nav-item ">
						  <a class="nav-link bg-white"onclick="location.href='vd_students.php'" disabled>Students</a>
						</li>
					  </ul>
					<div class="container-fluid overflow-auto bg-light rounded border" style="height:681px;padding-top:25%;">
						<center><h4 class="text-muted" style="">No Department Selected</h4></center>
					</div>
				</div>
			</div>

		</div>
	</div>
</body>

</html>
