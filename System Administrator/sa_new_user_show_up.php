<?php

include "../config.php";

if(isset($_GET['old_user_role'])){

    $user_id=$_GET['user_id'];
    $old_user_id=$_GET['old_user_id'];
    $role=$_GET['user_role'];
    $old_user_role=$_GET['old_user_role'];

     if($old_user_role=="student"){
         $register=$db->query("DELETE FROM student WHERE user_id=$old_user_id;");
        }else if($old_user_role=="advisor"){
             $register=$db->query("DELETE FROM advisors WHERE user_id=$old_user_id;");
        }else if($old_user_role=="vice chair"){
             $register=$db->query("DELETE FROM vice_chairs WHERE user_id=$old_user_id;");
        }else if($old_user_role=="vice dean"){
             $register=$db->query("DELETE FROM vice_deans WHERE user_id=$old_user_id;");
        }else{
             $register=$db->query("DELETE FROM admins WHERE user_id=$old_user_id;");
        }

    if($role=='student'){
    $faculty_id=$_GET['faculty_id'];
    $department_id=$_GET['department_id'];
    $program_id=$_GET['program_id'];

    $register=$db->query("UPDATE users SET role='$role' WHERE user_id=$old_user_id");
    $register=$db->query("UPDATE users SET faculty_id=$faculty_id WHERE user_id=$old_user_id");
    $register=$db->query("UPDATE users SET department_id=$department_id WHERE user_id=$old_user_id");
    $register=$db->query("UPDATE users SET program_id=$program_id WHERE user_id=$old_user_id");
    $register=$db->query("UPDATE users SET user_id=$user_id WHERE user_id=$old_user_id");

    $register=$db->prepare("INSERT INTO student SET s_id=:user_id");
    $rmission= $register->execute(array('s_id'=>$user_id));

        $register=$db->query("SELECT * FROM faculties WHERE faculty_id=$faculty_id")->fetchAll(PDO::FETCH_ASSOC);
        $faculty=$register[0]['faculty'];

        $register=$db->query("SELECT * FROM departments WHERE department_id=$department_id")->fetchAll(PDO::FETCH_ASSOC);
        $department=$register[0]['department'];

        $register=$db->query("SELECT * FROM programs WHERE program_id=$program_id")->fetchAll(PDO::FETCH_ASSOC);
        $program=$register[0]['program'];

    }else if($role=='advisor'){
    $faculty_id=$_GET['faculty_id'];
    $department_id=$_GET['department_id'];
    $program_id=$_GET['program_id'];

    $register=$db->query("UPDATE users SET role='$role' WHERE user_id=$old_user_id");
    $register=$db->query("UPDATE users SET faculty_id=$faculty_id WHERE user_id=$old_user_id");
    $register=$db->query("UPDATE users SET department_id=$department_id WHERE user_id=$old_user_id");
    $register=$db->query("UPDATE users SET program_id=$program_id WHERE user_id=$old_user_id");
    $register=$db->query("UPDATE users SET user_id=$user_id WHERE user_id=$old_user_id");

    $register=$db->prepare("INSERT INTO advisors SET user_id=:user_id");
    $rmission= $register->execute(array('user_id'=>$user_id));

        $register=$db->query("SELECT * FROM faculties WHERE faculty_id=$faculty_id")->fetchAll(PDO::FETCH_ASSOC);
        $faculty=$register[0]['faculty'];

        $register=$db->query("SELECT * FROM departments WHERE department_id=$department_id")->fetchAll(PDO::FETCH_ASSOC);
        $department=$register[0]['department'];

        $register=$db->query("SELECT * FROM programs WHERE program_id=$program_id")->fetchAll(PDO::FETCH_ASSOC);
        $program=$register[0]['program'];

    }else if($role=='vice chair'){
    $faculty_id=$_GET['faculty_id'];
    $department_id=$_GET['department_id'];
    $program_id=0;

    $register=$db->query("UPDATE users SET role='$role' WHERE user_id=$old_user_id");
    $register=$db->query("UPDATE users SET faculty_id=$faculty_id WHERE user_id=$old_user_id");
    $register=$db->query("UPDATE users SET department_id=$department_id WHERE user_id=$old_user_id");
    $register=$db->query("UPDATE users SET program_id=$program_id WHERE user_id=$old_user_id");
    $register=$db->query("UPDATE users SET user_id=$user_id WHERE user_id=$old_user_id");

    $register=$db->prepare("INSERT INTO vice_chairs SET user_id=:user_id");
    $rmission= $register->execute(array('user_id'=>$user_id));

        $register=$db->query("SELECT * FROM faculties WHERE faculty_id=$faculty_id")->fetchAll(PDO::FETCH_ASSOC);
        $faculty=$register[0]['faculty'];

        $register=$db->query("SELECT * FROM departments WHERE department_id=$department_id")->fetchAll(PDO::FETCH_ASSOC);
        $department=$register[0]['department'];

        $program='';

    }else if($role=='vice dean'){
    $faculty_id=$_GET['faculty_id'];
    $department_id=0;
    $program_id=0;

    $register=$db->query("UPDATE users SET role='$role' WHERE user_id=$old_user_id");
    $register=$db->query("UPDATE users SET faculty_id=$faculty_id WHERE user_id=$old_user_id");
    $register=$db->query("UPDATE users SET department_id=$department_id WHERE user_id=$old_user_id");
    $register=$db->query("UPDATE users SET program_id=$program_id WHERE user_id=$old_user_id");
    $register=$db->query("UPDATE users SET user_id=$user_id WHERE user_id=$old_user_id");

    $register=$db->prepare("INSERT INTO vice_deans SET user_id=:user_id");
    $rmission= $register->execute(array('user_id'=>$user_id));

        $register=$db->query("SELECT * FROM faculties WHERE faculty_id=$faculty_id")->fetchAll(PDO::FETCH_ASSOC);
        $faculty=$register[0]['faculty'];

        $department='';

        $program='';

    } else{
    $faculty_id=0;
    $department_id=0;
    $program_id=0;

    $register=$db->query("UPDATE users SET role='$role' WHERE user_id=$old_user_id");
    $register=$db->query("UPDATE users SET faculty_id=$faculty_id WHERE user_id=$old_user_id");
    $register=$db->query("UPDATE users SET department_id=$department_id WHERE user_id=$old_user_id");
    $register=$db->query("UPDATE users SET program_id=$program_id WHERE user_id=$old_user_id");
    $register=$db->query("UPDATE users SET user_id=$user_id WHERE user_id=$old_user_id");

    $register=$db->prepare("INSERT INTO admins SET user_id=:user_id");
    $rmission= $register->execute(array('user_id'=>$user_id));

        $faculty='';

        $department='';

        $program='';
    }

    $user=$db->query("SELECT * FROM users WHERE user_id=$user_id")->fetchAll(PDO::FETCH_ASSOC);
    $name=$user[0]['name'];
    $surname=$user[0]['surname'];
    $phone_number=$user[0]['phone_number'];
    $country=$user[0]['country'];
    $email=$user[0]['email'];

}

// logout and go to login page
if(isset($_GET["operation"]) && $_GET["operation"] == "logout") {
	session_destroy();
	header("Location: ../index.php");
}

// REGISTER
if(isset($_POST['submit'])){
    $name= $_POST['name'];
    $surname= $_POST['surname'];
    $password=$_POST['password'];
    $phone_number=$_POST['phone_no'];
    $country=$_POST['country'];
    $email=$_POST['email'];
    $role=$_POST['role'];

    if($role=='system administrator'){
        $faculty_id= '';
        $department_id='';
        $program_id='';

        $faculty='';
        $department='';
        $program='';
    }else if($role=='vice dean'){
        $faculty_id= $_POST['faculty_id'];
        $department_id='';
        $program_id='';

        $register=$db->query("SELECT * FROM faculties WHERE faculty_id=$faculty_id")->fetchAll(PDO::FETCH_ASSOC);
        $faculty=$register[0]['faculty'];
        $department='';
        $program='';
    }else if($role=='vice chair'){
        $faculty_id= $_POST['faculty_id'];
        $department_id=$_POST['department_id'];
        $program_id='';

        $register=$db->query("SELECT * FROM faculties WHERE faculty_id=$faculty_id")->fetchAll(PDO::FETCH_ASSOC);
        $faculty=$register[0]['faculty'];

        $register=$db->query("SELECT * FROM departments WHERE department_id=$department_id")->fetchAll(PDO::FETCH_ASSOC);
        $department=$register[0]['department'];

        $program='';
    }else {
        $faculty_id= $_POST['faculty_id'];
        $department_id=$_POST['department_id'];
        $program_id=$_POST['program_id'];


        $register=$db->query("SELECT * FROM faculties WHERE faculty_id=$faculty_id")->fetchAll(PDO::FETCH_ASSOC);
        $faculty=$register[0]['faculty'];

        $register=$db->query("SELECT * FROM departments WHERE department_id=$department_id")->fetchAll(PDO::FETCH_ASSOC);
        $department=$register[0]['department'];

        $register=$db->query("SELECT * FROM programs WHERE program_id=$program_id")->fetchAll(PDO::FETCH_ASSOC);
        $program=$register[0]['program'];
    }


    $lastID=$db->query("SELECT max(id) as id FROM users")->fetchAll(PDO::FETCH_ASSOC);

    if($role=="student"){
        $user_id=$lastID[0]['id']+"10000001";
    }else if($role=="advisor"){
        $user_id=$lastID[0]['id']+"20000001";
    }else if($role=="vice chair"){
        $user_id=$lastID[0]['id']+"30000001";
    }else if($role=="vice dean"){
        $user_id=$lastID[0]['id']+"40000001";
    }else{
        $user_id=$lastID[0]['id']+"50000001";
    }

    $register= $db->prepare("INSERT INTO users SET user_id=:user_id, name=:name, surname=:surname, password=:password, phone_number=:phone_number, country=:country, email=:email, role=:role, faculty_id=:faculty_id, department_id=:department_id, program_id=:program_id");
    $lmission= $register->execute(array('user_id'=>$user_id,'name'=>$name,'surname'=>$surname,'password'=>$password,'phone_number'=>$phone_number,'country'=>$country,'email'=>$email,'role'=>$role,'faculty_id'=>$faculty_id,'department_id'=>$department_id,'program_id'=>$program_id));

    if($lmission){

    } else {
            echo "REGISTER FAILED";
        }

         if($role=="student"){
        $register=$db->prepare("INSERT INTO student SET s_id=:user_id");
        $rmission= $register->execute(array('user_id'=>$user_id));
        }else if($role=="advisor"){
        $register=$db->prepare("INSERT INTO advisors SET user_id=:user_id");
        $rmission= $register->execute(array('user_id'=>$user_id));
        }else if($role=="vice chair"){
        $register=$db->prepare("INSERT INTO vice_chairs SET user_id=:user_id");
        $rmission= $register->execute(array('user_id'=>$user_id));
        }else if($role=="vice dean"){
        $register=$db->prepare("INSERT INTO vice_deans SET user_id=:user_id");
        $rmission= $register->execute(array('user_id'=>$user_id));
        }else{
        $register=$db->prepare("INSERT INTO admins SET user_id=:user_id");
        $rmission= $register->execute(array('user_id'=>$user_id));}
}

?>
<html>
<head>
<title> System Administrator </title>
<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="/css/admin.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

<style>

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
		<div class="mainnav row no-gutter shadow-lg">
            <div class="col-6">
                <nav class="navbar navbar-expand-xl justify-content-start navbar-dark ">
                    <a class="nav-link text-light ml-5" href="admin.php" color="white">HOME</a>
                </nav>
            </div>
            <div class="col-6">
                <nav class="navbar navbar-expand-xl justify-content-end navbar-dark">
                    <a class="nav-link text-light mr-5 active" href="?operation=logout" color="white">LOGOUT</a>
                </nav>
            </div>
        </div>
	</div>
	<div class="container-fluid my-3"> <!-- ********************************User Show Up Panel******************************** -->
		<div class="container bg-light rounded border mb-4">
			<div class="row">
				<div class="col-md-4">
					<img src="https://stdportal.emu.edu.tr/ogrresimgetir2.aspx?img=17330110&RESIM=OGR" class="bg-muted rounded mx-auto my-2 img-thumbnail" style="height:200px;width:150px;">
				</div>
				<div class="col-md-8 my-2">
					<div>
						<h5><?php echo $name ?> <?php echo $surname ?></h5>
						<h6><?php echo $role ?></h6>
					</div>
					<div>
						<div>
							<div class="row mt-4">
								<div class="col-md-12">
									<strong>Role Id : </strong><a><?php echo $user_id ?></a>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<strong>Email : </strong><a><?php echo $email ?></a>
								</div>
								<div class="col-md-6">
									<strong>Phone : </strong><a><?php echo $phone_number ?></a>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<strong>Country : </strong><a><?php echo $country ?></a>
								</div>
								<div class="col-md-6">
									<strong>Faculty : </strong><a><?php echo $faculty ?></a>
								</div>
							</div>
							<div class="row mt-1">
								<div class="col-md-6">
									<strong>Department : </strong><a><?php echo $department ?></a>
								</div>
								<div class="col-md-6">
									<strong>Program : </strong><a><?php echo $program ?></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<ul class="container nav nav-tabs nav-justified pl-3"> <!-- ********************************Nav Bar******************************** -->
			<li class="nav-item">
				<a class="nav-link bg-light border border-primary border-bottom-0" href="#" >Create User</a>
			</li>
			<li class="nav-item ">
				<a class="nav-link bg-light border" href="sa_users.php" >Users</a>
			</li>
		</ul>
		<div class="container bg-light rounded border"> <!-- ********************************Create User Panel******************************** -->
			<div class="row">
				<div class="col-md-12 mt-3">
					<h4>New User Informations</h4>
					<hr>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<form id="myForm" method="post" action="sa_new_user_faculty.php">
					  <div class="form-group row">
						<label for="name_and_surname" class="col-4 col-form-label">Name & Surname <a class="text-danger">*</a></label>
						<div class="col-4">
						  <input id="name" name="name" placeholder="Name" class="form-control here" required="required" type="text">
						</div>
						<div class="col-4">
						  <input id="surname" name="surname" placeholder="Surname" class="form-control here" required="required" type="text">
						</div>
					  </div>
					  <div class="form-group row">
						<label for="password" class="col-4 col-form-label">Password <a class="text-danger">*</a></label>
						<div class="col-4">
						  <input id="password" name="password" placeholder="Password" class="form-control here" required="required" type="text">
						</div>
						<div class="col-4">
						  <input id="password_check" name="password_check" placeholder="Password Check" class="form-control here" required="required" type="text">
						</div>
                        <div class="col-4" id="msg"></div>
					  </div>
					  <div class="form-group row">
						<label for="phone_no" class="col-4 col-form-label">Phone Number <a class="text-danger">*</a> & Country <a class="text-danger">*</a></label>
						<div class="col-4">
						  <input id="phone_no" name="phone_no" placeholder="Ex : 90 555 555 55 55" class="form-control here" required="required" type="tel" pattern="[0-9]{2} [0-9]{3} [0-9]{3} [0-9]{2} [0-9]{2}||[0-9]{2}[0-9]{3}[0-9]{3}[0-9]{2}[0-9]{2}">
						</div>
						<div class="col-4">
						  <input id="" name="country" placeholder="Ex : Turkey" class="form-control here" required="required">
						</div>
					  </div>
					  <div class="form-group row">
						<label for="email" class="col-4 col-form-label">Email <a class="text-danger">*</a></label>
						<div class="col-8">
						  <input id="email" name="email" placeholder="Email" class="form-control here" required="required" type="text">
						</div>
					  </div>
					  <div class="form-group row">
						<label for="role" class="col-4 col-form-label">Role <a class="text-danger">*</a></label>
						<div class="col-8">
							<select id="select" name="role" class="custom-select">
								<option value="student">Student</option>
								<option value="advisor">Advisor</option>
								<option value="vice chair">Vice Chair</option>
								<option value="vice dean">Vice Dean</option>
								<option value="system administrator">System Administrator</option>
							</select>
						</div>
					  </div>
					  <div class="form-group row">
						<div class="col-12">
						  <center><button id="btnSubmit" name="submit" type="submit" class="btn btn-primary" disabled >Continue</button></center>
						</div>
					  </div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
       <!-- Optional JavaScript -->

      <script>
            $(document).ready(function(){
                $("#password_check").keyup(function(){
                     if ($("#password").val() != $("#password_check").val() ) {
                         $("#msg").html("Passwords not matched").css("color","red");
                         $("#btnSubmit").attr("disabled", true);
                     }else{
                         $("#msg").html("Passwords matched").css("color","green");
                         $("#btnSubmit").attr("disabled", false);
                    }
              });
            });
    </script>

       <script>
        document.getElementById("myForm").addEventListener("change", displayButton);
        function displayButton() {
        document.getElementById("btnSubmit").disabled = false;
        }
    </script>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
