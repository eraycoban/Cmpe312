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

?>
<html>
<head>
<title> Student Administrator </title>
<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="/css/admin.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <!-- If else conditions between select faculty and department  -->
  <script>
	$(document).ready(function() {

    $("#select_faculty").change(function() {
        var val = $(this).val();
        if (val == "b&e") {
            $("#select_department").html("<option value='business_administration'>Business Administration</option><option value='political_science'>Political Science and International Relations</option><option value='economics'>Economics</option><option value='banking_finance'>Banking and Finance</option>");
        } else if (val == "eng") {
            $("#select_department").html("<option value='civil'>Civil Engineering</option><option value='computer'>Computer Engineering</option><option value='electrical'>Electrical & Electronic Engineering</option><option value='industrial'>Industrial Engineering</option><option value='mechanical'>Mechanical Engineering</option>");

        } else if (val == "a&s") {
            $("#select_department").html("<option value=''></option>");

        } else if (val == "a&s") {
            $("#select_department").html("<option value=''></option>");

        } else if (val == "a&s") {
            $("#select_department").html("<option value=''></option>");

        } else if (val == "a&s") {
            $("#select_department").html("<option value=''></option>");

        } else if (val == "a&s") {
            $("#select_department").html("<option value=''></option>");

        } else if (val == "a&s") {
            $("#select_department").html("<option value=''></option>");

        } else if (val == "a&s") {
            $("#select_department").html("<option value=''></option>");

        } else if (val == "a&s") {
            $("#select_department").html("<option value=''></option>");

        } else if (val == "a&s") {
            $("#select_department").html("<option value=''></option>");

        } else if (val == "a&s") {
            $("#select_department").html("<option value=''></option>");

        }
    });


});
  </script>
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

	<div class="mainnav row no-gutter shadow-lg">
            <div class="col-6">
                <nav class="navbar navbar-expand-xl justify-content-start navbar-dark ">
                    <a class="nav-link text-light ml-5" href="#" color="white">HOME</a>
                </nav>
            </div>
            <div class="col-6">
                <nav class="navbar navbar-expand-xl justify-content-end navbar-dark">
                    <a class="nav-link text-light mr-5 active" href="?operation=logout" color="white">LOGOUT</a>
                </nav>
            </div>
        </div>
	<div class="container-fluid my-3">
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
						  <input id="password" minlength="6" name="password" placeholder="Password" class="form-control here" required="required" type="text">
						</div>
						<div class="col-4">
						  <input id="password_check" minlength="6" name="password_check" placeholder="Password Check" class="form-control here" required="required" type="text">
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

        $('#select').change(function () {
           if($('#select').val()=='system administrator'){
               $('#myForm').attr('action', "sa_new_user_show_up.php");
           }else{
               $('#myForm').attr('action', "sa_new_user_faculty.php");
           }
        })
    </script>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>

</html>
