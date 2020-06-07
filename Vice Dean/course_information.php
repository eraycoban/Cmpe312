<?php
include "../config.php";

$course_id=$_GET['id'];
$course=$db->query("SELECT * FROM course WHERE course_id=$course_id")->fetchAll(PDO::FETCH_ASSOC);
$course_code="'".$course[0]['course_code']."'";
$group=$db->query("SELECT * FROM course_group WHERE course_code=$course_code")->fetchAll(PDO::FETCH_ASSOC);
$count = count($group);


 ?>

<html>

<head>
<title> User Information </title>
<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

<style>

</style>

</head>

<body>

<div class="main">
	<div class="container-fluid  bg-light border rounded">
		<form>
			<div class="row">
				<div class="col-md-12 my-2">
					<div>
						<h5><?php echo $course[0]["course_code"]?></h5>
						<h6><?php echo $course[0]["course_name"]?></h6>
					</div>
					<div>
						<div>

							<div class="row mt-1">

								<div class="col-md-6">
									<strong>Course Semester : </strong><a><?php echo $course[0]["sem_id"];?></a>
								</div>
							</div>
							<div> <!-- ***************************SAMPLE GROUP INFORMATION*************************** -->
								<div class="row mt-2">
									<div class="col-md-12">

                    <?php
                    $i=0;
                    while($i<$count){
                      ?>

										<strong>Group <?php echo $group[$i]["group_id"]; ?> : </strong>
									</div>
								</div>
								<div class="border rounded bg-white">
									<div class="row mt-1 mx-2 ">
										<div class="col-md-6">
                      <strong>Lecturer : </strong><a type="button" class="btn btn-sm text-primary my-1" href="user_information.html" onclick="window.open('user_information.html?instructor=<?php echo $group[$i]["instructor_name"];?>', 'newwindow', 'width=820, height=242'); return false;"><?php echo $group[$i]["instructor_name"];?></a>
										</div>
										<div class="col-md-4">
											<strong>Quota : </strong><a><?php echo $group[$i]["quota"];?></a>
										</div>
									</div>

								</div>
                <?php
                $i++;}
                ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
</body>
</html>
