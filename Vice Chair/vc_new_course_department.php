<?php if(isset($_GET['submit'])) { ?>
<?php
include "../config.php";
    

// logout and go to login page
if(isset($_GET["operation"]) && $_GET["operation"] == "logout") {
	session_destroy();
	header("Location: ../index.php");
}


    $faculties=explode(", ",$_GET['faculties']);
    $departments=[];
    unset($_GET['faculty']);
    unset($_GET['submit']);
    $second_info=$_GET;
    $department_ids=$second_info['departments'];
    $department_ids=explode(", ",$department_ids);

    for($i=0;$i<count($faculties);$i++){
        $try=$db->query("SELECT * FROM departments WHERE faculty_id IN (SELECT faculty_id WHERE faculty_id=$faculties[$i])")->fetchAll(PDO::FETCH_ASSOC);
        $departments=array_merge($departments,$try);
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
    <form id='my_form' method="get" action="vc_new_course_program.php">
        <?php foreach($second_info as $key => $value) {?>
            <input type="hidden" name="<?php echo $key; ?>" value="<?php echo $value; ?>" >
        <?php }?>
	<div class="container bg-light rounded border my-3 mx-auto">
		<h3 class="my-3 ml-2">Which departments can take this course?</h3>
		<div class="row">
			<ul class="list-group offset-1 col-5 list-group-flush my-2">
                <?php for($i=0;$i<ceil(count($departments)/2.0);$i++){ ?>
                
                <li class="list-group-item">
				  <div class="custom-control custom-checkbox">
					<input type="checkbox" class="custom-control-input" id="<?php echo $departments[$i]["id"] ?>" name="department" value="<?php echo $departments[$i]["department_id"]; ?>"
                           <?php for($z=0;$z<count($department_ids);$z++){
                                    if($departments[$i]['department_id']==$department_ids[$z]){
                           ?>
                           checked
                           <?php }} ?>
                           
                           >
					<label class="custom-control-label" for="<?php echo $departments[$i]["id"] ?>"><?php echo $departments[$i]["department"] ?></label>
				  </div>
                </li>
                
                <?php }?>
			</ul>
            <ul class="list-group offset-1 col-5 list-group-flush my-2">
                <?php for($i=ceil(count($departments)/2.0);$i<count($departments);$i++){ ?>
                
                <li class="list-group-item">
				  <div class="custom-control custom-checkbox">
					<input type="checkbox" class="custom-control-input" id="<?php echo $departments[$i]["id"] ?>" name="department" value="<?php echo $departments[$i]["department_id"]; ?>"
                           <?php for($z=0;$z<count($department_ids);$z++){
                                    if($departments[$i]['department_id']==$department_ids[$z]){
                           ?>
                           checked
                           <?php }} ?>
                           
                           >
					<label class="custom-control-label" for="<?php echo $departments[$i]["id"] ?>"><?php echo $departments[$i]["department"] ?></label>
				  </div>
                </li>
                
                <?php }?>
			</ul>
		</div>
        
        
            <input type="hidden" name="departments" id="departments" value="" >
		<div class="form-group row">
				<div class="col-12">
				  <center><button name="submit" onclick="location.href='vc_new_course_faculty.php'" type="submit" class="btn btn-primary mx-1">Go Back</button><button id='submit' name="submit" class="btn btn-primary mx-1 " >Continue</button></center>
				</div>
		</div>
	</div>
   </form>
</div>
    <script>

        
        $(document).ready(function() {
        $("#submit").click(function(){
            var department = [];
            $.each($("input[name='department']:checked"), function(){
                department.push($(this).val());
            });
            $('#departments').attr('value', department.join(", "));
            $('#my_form').submit();
        });
    });
    </script>
</body>
</html>

<?php }else { ?>
<?php
include "../config.php";

// logout and go to login page
if(isset($_GET["operation"]) && $_GET["operation"] == "logout") {
	session_destroy();
	header("Location: ../index.php");
}

if(isset($_POST['submit'])){
    $faculties=explode(", ",$_POST['faculties']);
    $departments=[];
    unset($_POST['faculty']);
    unset($_POST['submit']);
    $second_info=$_POST;
    
    for($i=0;$i<count($faculties);$i++){
        $try=$db->query("SELECT * FROM departments WHERE faculty_id IN (SELECT faculty_id WHERE faculty_id=$faculties[$i])")->fetchAll(PDO::FETCH_ASSOC);
        $departments=array_merge($departments,$try);
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
    <form id='my_form' method="post" action="vc_new_course_program.php">
	<div class="container bg-light rounded border my-3 mx-auto">
		<h3 class="my-3 ml-2">Which departments can take this course?</h3>
		<div class="row">
			<ul class="list-group offset-1 col-5 list-group-flush my-2">
                <?php for($i=0;$i<ceil(count($departments)/2.0);$i++){ ?>
                
                <li class="list-group-item">
				  <div class="custom-control custom-checkbox">
					<input type="checkbox" class="custom-control-input" id="<?php echo $departments[$i]["id"] ?>" name="department" value="<?php echo $departments[$i]["department_id"]; ?>">
					<label class="custom-control-label" for="<?php echo $departments[$i]["id"] ?>"><?php echo $departments[$i]["department"] ?></label>
				  </div>
                </li>
                
                <?php }?>
			</ul>
            <ul class="list-group offset-1 col-5 list-group-flush my-2">
                <?php for($i=ceil(count($departments)/2.0);$i<count($departments);$i++){ ?>
                
                <li class="list-group-item">
				  <div class="custom-control custom-checkbox">
					<input type="checkbox" class="custom-control-input" id="<?php echo $departments[$i]["id"] ?>" name="department" value="<?php echo $departments[$i]["department_id"]; ?>">
					<label class="custom-control-label" for="<?php echo $departments[$i]["id"] ?>"><?php echo $departments[$i]["department"] ?></label>
				  </div>
                </li>
                
                <?php }?>
			</ul>
		</div>
        
        <?php foreach($second_info as $key => $value) {?>
            <input type="hidden" name="<?php echo $key; ?>" value="<?php echo $value; ?>" >
        <?php }?>
            <input type="hidden" name="departments" id="departments" value="" >
		<div class="form-group row">
				<div class="col-12">
				  <center><button name="submit" onclick="location.href='vc_new_course_faculty.php'" type="submit" class="btn btn-primary mx-1">Go Back</button><button id='submit' name="submit" class="btn btn-primary mx-1 " disabled>Continue</button></center>
				</div>
		</div>
	</div>
   </form>
</div>
    <script>
        
        document.getElementById("my_form").addEventListener("change", displayButton);
        function displayButton() {
        document.getElementById("submit").disabled = false;
        }
        
        $(document).ready(function() {
        $("#submit").click(function(){
            var department = [];
            $.each($("input[name='department']:checked"), function(){
                department.push($(this).val());
            });
            $('#departments').attr('value', department.join(", "));
            $('#my_form').submit();
        });
    });
    </script>
</body>
</html>

<?php } ?>