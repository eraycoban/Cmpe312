<?php
include "../config.php";

// logout and go to login page
if(isset($_GET["operation"]) && $_GET["operation"] == "logout") {
	session_destroy();
	header("Location: ../index.php");
}

//$user_id=$_SESSION["user_id"];
//$user=$db->query("SELECT * FROM users WHERE user_id=$user_id")->fetchAll(PDO::FETCH_ASSOC);
//$username=$user[0]["name"];
//$department_id=$user[0]['department_id'];
//
//$lecturers=$db->query("SELECT * FROM users WHERE department_id=$department_id AND (role='advisor' OR role='vice chair') ")->fetchAll(PDO::FETCH_ASSOC);

if(isset($_POST['submit'])){
    unset($_POST['program']);
    unset($_POST['submit']);
    $fourth_info=$_POST;
  
    $faculties_id=explode(", ",$_POST['faculties']);
    $departments_id=explode(", ",$_POST['departments']);
    $programs_id=explode(", ",$_POST['programs']);
    $faculties=[];
    $departments=[];
    $programs=[];
    
    foreach($faculties_id as $key=>$value){
        $try=$db->query("SELECT faculty FROM faculties WHERE faculty_id='$value'")->fetchAll(PDO::FETCH_ASSOC);
        $faculties=array_merge($try,$faculties);
    }
    foreach($departments_id as $key=>$value){
        $try=$db->query("SELECT department FROM departments WHERE department_id='$value'")->fetchAll(PDO::FETCH_ASSOC);
        $departments=array_merge($try,$departments);
    }
    foreach($programs_id as $key=>$value){
        $try=$db->query("SELECT program FROM programs WHERE program_id='$value'")->fetchAll(PDO::FETCH_ASSOC);
        $programs=array_merge($try,$programs);
    }
    
    
}
?>
<html>

<head>
<title> VC Add Course </title>
<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="/css/vice_chair.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>


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
table.table-bordered{
    border:2px solid white;
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
        </div>
	<div class="container-fluid my-3">
		<div class="container-fluid">
			
			<div class="container my-3">  
				<br>
				<div class="row">
					<div class="col-12">
						<form method="post" action="vc_group_settings_1.php">
							<div class="container-fluid  bg-light border rounded">
									<div class="row">
										<div class="col-md-12 my-2">
											<div>
												<h5><?=$fourth_info['course_code']?></h5>
												<h6><?=$fourth_info['course_name']?></h6>
											</div>
											<div>
												<div>
													<div class="row mt-4">
														<div class="col-md-6">
															<strong>Course Faculties : </strong><br><div class="border rounded bg-white">
                                                            <?php for($i=0;$i<count($faculties);$i++){ ?><a><?=$faculties[$i]['faculty']?></a><br>
                                                            <?php } ?>
														</div>
                                                        </div>
														<div class="col-md-6">
															<strong>Course Departments : </strong><br><div class="border rounded bg-white"><?php for($i=0;$i<count($departments);$i++){ ?><a><?=$departments[$i]['department']?></a><br>
                                                            <?php } ?></div>
														</div>
                                                        </div>
													
													<div class="row mt-1">
														<div class="col-md-6">
															<strong>Programs : </strong><br><div class="border rounded bg-white"><?php for($i=0;$i<count($programs);$i++){ ?><a><?=$programs[$i]['program']?></a><br>
                                                            <?php } ?></div>
														</div>
														<div class="col-md-6">
															<strong>Course Semester : </strong><a><?=$fourth_info['course_semester']?></a>
														</div>
													</div>
													<div class="row mt-1">
														<div class="col-md-12">
															<strong>Description : </strong><br><div class="border rounded bg-white"><p><?=$fourth_info['description']?></p></div>
														</div>
													</div>
												
											</div>
										</div>
									</div>      
                                </div>
                            </div>
                            
                            <h3 class="my-2">Fill these areas :</h3>
							<div class="form-group row mt-3">
								<label for="username" class="col-3 col-form-label"><strong>Number of Groups :</strong></label> 
								<div class="col-3">
									<input type="number" min="0" id="name" name="group_number" placeholder="Ex : 4" class=" form-control here" type="text">
								</div>
								<label for="username" class="col-3 col-form-label"><strong>Course Hour(s) Per Week :</strong></label> 
								<div class="col-3">
									<input type="number" id="name" name="hour_number" placeholder="Ex : 4" class="form-control here" type="text">
								</div>
							</div>
                                <div class="col-12"><center><button name='submit_group' type='submit' class='btn btn-lg btn-success'>Save</button></center></div>
                            
                            <?php foreach($fourth_info as $key => $value) {?>
                            <input type="hidden" name="<?php echo $key; ?>" value="<?php echo $value; ?>" >
                            <?php }?>
                        </form>
                    </div>
				</div>
			</div>
		</div>
	</div>
</div>	
</body>

<script> <!-- ***************************** TOOL TIP SCRIPT ***************************** -->
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
</script>

</html>

