<?php if(isset($_GET['submit'])) { ?>

<?php
include "../config.php";

// logout and go to login page
if(isset($_GET["operation"]) && $_GET["operation"] == "logout") {
	session_destroy();
	header("Location: ../index.php");
}

    $departments=explode(", ",$_GET['departments']);
    $programs=[];
    $groups=[];
    unset($_GET['department']);
    unset($_GET['submit']);
    $third_info=$_GET;
    $program_ids=$third_info['programs'];
    $program_ids=explode(", ",$program_ids);
    
    for($i=0;$i<count($departments);$i++){
        $try=$db->query("SELECT * FROM programs WHERE department_id IN (SELECT department_id FROM departments WHERE department_id=$departments[$i])")->fetchAll(PDO::FETCH_ASSOC);
        $programs=array_merge($programs,$try);
    }
    
    $group_names=explode(", ",$third_info['group_names']);
    
    for($s=0;$s<count($group_names);$s++){
        $groups[$s]=$db->query("SELECT * FROM groups WHERE group_name='$group_names[$s]'")->fetchAll(PDO::FETCH_ASSOC);
    }
    
    $group_number=count($group_names);
    $hour_number=$groups[0][0]['lecture_days'];
    $hour_number=explode(', ', $hour_number);
    $hour_number=count($hour_number);


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
    <form id='my_form' method="get" action="vc_group_settings_1.php">
        <?php foreach($third_info as $key => $value) {?>
            <input type="hidden" name="<?php echo $key; ?>" value="<?php echo $value; ?>" >
        <?php }?>
	<div class="container bg-light rounded border my-3 mx-auto">
		<h3 class="my-3 ml-2">Which programs can take this course?</h3>
		<div class="row">
			<ul class="list-group offset-1 col-5 list-group-flush my-2">
                <?php for($i=0;$i<ceil(count($programs)/2.0);$i++){ ?>
                
                <li class="list-group-item">
				  <div class="custom-control custom-checkbox">
					<input type="checkbox" class="custom-control-input" id="<?php echo $programs[$i]["id"] ?>" name="program" value="<?php echo $programs[$i]["program_id"]; ?>"
                           
                           <?php for($z=0;$z<count($program_ids);$z++){
                                    if($programs[$i]['program_id']==$program_ids[$z]){
                           ?>
                           checked
                           <?php }} ?>
                           
                           >
					<label class="custom-control-label" for="<?php echo $programs[$i]["id"] ?>"><?php echo $programs[$i]["program"] ?></label>
				  </div>
                </li>
                
                <?php }?>
			</ul>
            <ul class="list-group offset-1 col-5 list-group-flush my-2">
                <?php for($i=ceil(count($programs)/2.0);$i<count($programs);$i++){ ?>
                
                <li class="list-group-item">
				  <div class="custom-control custom-checkbox">
					<input type="checkbox" class="custom-control-input" id="<?php echo $programs[$i]["id"] ?>" name="program" value="<?php echo $programs[$i]["program_id"]; ?>"
                           <?php for($z=0;$z<count($program_ids);$z++){
                                    if($programs[$i]['program_id']==$program_ids[$z]){
                           ?>
                           checked
                           <?php }} ?>
                           
                           >
                           
					<label class="custom-control-label" for="<?php echo $programs[$i]["id"] ?>"><?php echo $programs[$i]["program"] ?></label>
				  </div>
                </li>
                
                <?php }?>
			</ul>
		</div>
        
        
            <input type="hidden" name="programs" id="programs" value="" >
        <input type="hidden" name="group_number" value="<?=$group_number?>" >
        <input type="hidden" name="hour_number" value="<?=$hour_number?>" >
        
		<div class="form-group row">
				<div class="col-12">
				  <center><button name="submit" onclick="location.href='vc_new_course_department.php'" type="submit" class="btn btn-primary mx-1">Go Back</button><button id='submit' name="submit" class="btn btn-primary mx-1">Continue</button></center>
				</div>
		</div>
	</div>
   </form>
	</div>	
    <script>
        
        $(document).ready(function() {
        $("#submit").click(function(){
            var program = [];
            $.each($("input[name='program']:checked"), function(){
                program.push($(this).val());
            });
            $('#programs').attr('value', program.join(", "));
            $('#my_form').submit();
        });
    });
    </script>
</body>
</html>

<?php } else {?>

<?php
include "../config.php";

// logout and go to login page
if(isset($_GET["operation"]) && $_GET["operation"] == "logout") {
	session_destroy();
	header("Location: ../index.php");
}

if(isset($_POST['submit'])){
    $departments=explode(", ",$_POST['departments']);
    $programs=[];
    unset($_POST['department']);
    unset($_POST['submit']);
    $third_info=$_POST;
    
    for($i=0;$i<count($departments);$i++){
        $try=$db->query("SELECT * FROM programs WHERE department_id IN (SELECT department_id FROM departments WHERE department_id=$departments[$i])")->fetchAll(PDO::FETCH_ASSOC);
        $programs=array_merge($programs,$try);
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
    <form id='my_form' method="post" action="vc_group_settings.php">
	<div class="container bg-light rounded border my-3 mx-auto">
		<h3 class="my-3 ml-2">Which programs can take this course?</h3>
		<div class="row">
			<ul class="list-group offset-1 col-5 list-group-flush my-2">
                <?php for($i=0;$i<ceil(count($programs)/2.0);$i++){ ?>
                
                <li class="list-group-item">
				  <div class="custom-control custom-checkbox">
					<input type="checkbox" class="custom-control-input" id="<?php echo $programs[$i]["id"] ?>" name="program" value="<?php echo $programs[$i]["program_id"]; ?>">
					<label class="custom-control-label" for="<?php echo $programs[$i]["id"] ?>"><?php echo $programs[$i]["program"] ?></label>
				  </div>
                </li>
                
                <?php }?>
			</ul>
            <ul class="list-group offset-1 col-5 list-group-flush my-2">
                <?php for($i=ceil(count($programs)/2.0);$i<count($programs);$i++){ ?>
                
                <li class="list-group-item">
				  <div class="custom-control custom-checkbox">
					<input type="checkbox" class="custom-control-input" id="<?php echo $programs[$i]["id"] ?>" name="program" value="<?php echo $programs[$i]["program_id"]; ?>">
					<label class="custom-control-label" for="<?php echo $programs[$i]["id"] ?>"><?php echo $programs[$i]["program"] ?></label>
				  </div>
                </li>
                
                <?php }?>
			</ul>
		</div>
        
        <?php foreach($third_info as $key => $value) {?>
            <input type="hidden" name="<?php echo $key; ?>" value="<?php echo $value; ?>" >
        <?php }?>
            <input type="hidden" name="programs" id="programs" value="" >
		<div class="form-group row">
				<div class="col-12">
				  <center><button name="submit" onclick="location.href='vc_new_course_department.php'" type="submit" class="btn btn-primary mx-1">Go Back</button><button id='submit' name="submit" class="btn btn-primary mx-1" disabled>Continue</button></center>
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
            var program = [];
            $.each($("input[name='program']:checked"), function(){
                program.push($(this).val());
            });
            $('#programs').attr('value', program.join(", "));
            $('#my_form').submit();
        });
    });
    </script>
</body>
</html>

<?php } ?>