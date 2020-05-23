<?php

include "../config.php";

//how to get student id from vd_students
//tried using the post method


$user_id=$_GET['id'];
//echo $user_id;

$users=$db->query("SELECT * FROM users WHERE user_id=$user_id")->fetchAll(PDO::FETCH_ASSOC);




 ?>

<html>

<head>
<title> User Information </title>
<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="/css/vice_dean.css" rel="stylesheet" type="text/css">
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
				<div class="col-md-4">
					<img src="https://stdportal.emu.edu.tr/ogrresimgetir2.aspx?img=17330110&RESIM=OGR" class="bg-muted rounded mx-auto my-2 img-thumbnail" style="height:200px;width:150px;">
				</div>
				<div class="col-md-8 my-2">
					<div>
						<h5><?php echo $users[0]["name"]." ".$users[0]["surname"]; ?></h></h5>
						<h6><?php echo $users[0]["role"] ?></h6>
					</div>
					<div>
						<div>
							<div class="row mt-4">
								<div class="col-md-12">
									<strong>Role Id : </strong><a><?php echo $users[0]["user_id"]; ?></a>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<strong>Email : </strong><a><?php echo $users[0]["email"]; ?></a>
								</div>
								<div class="col-md-6">
									<strong>Phone : </strong><a><?php echo $users[0]["phone_number"]; ?></a>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<strong>Country : </strong><a><?php echo $users[0]["country"]; ?></a>
								</div>
								<div class="col-md-6">
									<strong>Faculty : </strong><a><?php echo $users[0]["faculty"]; ?></a>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<strong>Department : </strong><a><?php echo $users[0]["department"]; ?></a>
								</div>
								<div class="col-md-6">
									<strong>Program : </strong><a><?php echo $users[0]["program"]; ?></a>
								</div>
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
