<?php 

include "../config.php";

if(isset($_POST['role'])){
$second_info=$_POST;

$role=$second_info['role'];

$faculty_id=$second_info['faculty_id'];

$departments=$db->query("SELECT * FROM departments WHERE faculty_id=$faculty_id")->fetchAll(PDO::FETCH_ASSOC);

?>
<html>
<head>
<title> VC Add Course </title>
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
    <input type="hidden" id='role' value="<?php echo $role ?>">

<div class="main">
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
				<a class="nav-link text-light active" href="admin.php" color="white">HOME</a>
			</nav>
		</div>
	</div>
	<form id="myForm" method="post" action="sa_new_user_program.php" >
        <div class="container bg-light rounded border my-3 mx-auto">
		<h3 class="my-3 ml-2">Which departments can take this course?</h3>
		<div class="row">
			 <ul class="list-group offset-1 col-5 list-group-flush my-2">
				<?php for($i=0;$i<ceil(count($departments)/2.0);$i++){ ?>
        
                <li class="list-group-item">
				  <div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="<?php echo $departments[$i]["id"] ?>" name="department_id" value="<?php echo $departments[$i]["department_id"]; ?>">
					<label class="custom-control-label" for="<?php echo $departments[$i]["id"] ?>"><?php echo $departments[$i]["department"] ?></label>
				  </div>
                </li>
                
                <?php }?>
			</ul>
             <ul class="list-group offset-1 col-5 list-group-flush my-2">
				<?php for($i=ceil(count($departments)/2.0);$i<count($departments);$i++){ ?>
                <li class="list-group-item">
		          <div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="<?php echo $departments[$i]["id"] ?>" name="department_id" value="<?php echo $departments[$i]["department_id"]; ?>">
					<label class="custom-control-label" for="<?php echo $departments[$i]["id"] ?>"><?php echo $departments[$i]["department"] ?></label>
				  </div>
                </li>
                
                <?php }?>
			</ul>
		</div>
            <?php foreach($second_info as $key=> $value) { ?>
            <input type="hidden" name="<?php echo $key;?>" value="<?php echo $value; ?>" >
            <?php } ?>
		<div class="form-group row">
				<div class="col-12">
				  <center><button name="submit" onclick="location.href='sa_new_user_faculty.php'" type="button" class="btn btn-primary mx-1">Go Back</button><button id="myButton" name="submit" type="submit" class="btn btn-primary mx-1" disabled>Continue</button></center>
				</div>
		</div>
	</div>	
    </form>
</div>
       <script>
        document.getElementById("myForm").addEventListener("change", displayButton);
        function displayButton() {
        document.getElementById("myButton").disabled = false;
        }
           
        if ($('#role').val()=='vice chair'){
            $('#myForm').attr('action', "sa_new_user_show_up.php");
        }else{
            $('#myForm').attr('action', "sa_new_user_program.php");
        }
    </script>
</body>
</html>




<?php }else if(isset($_GET['faculty_id'])){
    $faculty_id=$_GET['faculty_id'];
    $departments=$db->query("SELECT * FROM departments WHERE faculty_id=$faculty_id")->fetchAll(PDO::FETCH_ASSOC);
    $user_role=$_GET['user_role'];
    $user_id=$_GET['user_id'];
    $old_user_id=$_GET['old_user_id'];
    $old_user_role=$_GET['old_user_role'];
?>

<html>
<head>
<title> VC Add Course </title>
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
    <input type="hidden" id='role' value="<?php echo $user_role ?>">

<div class="main">
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
				<a class="nav-link text-light active" href="admin.php" color="white">HOME</a>
			</nav>
		</div>
	</div>
	<form id="myForm" method="get" action="sa_new_user_program.php" >
        
    <input type="hidden" id='role' name="user_role" value="<?php echo $user_role ?>">
    <input type="hidden" name='user_id' value="<?php echo $user_id ?>">
    <input type="hidden" name="old_user_role" value="<?php echo $old_user_role ?>">
    <input type="hidden" name='old_user_id' value="<?php echo $old_user_id ?>">
    <input type="hidden" name='faculty_id' value="<?php echo $faculty_id ?>">
        
        <div class="container bg-light rounded border my-3 mx-auto">
		<h3 class="my-3 ml-2">Which departments can take this course?</h3>
		<div class="row">
			 <ul class="list-group offset-1 col-5 list-group-flush my-2">
				<?php for($i=0;$i<ceil(count($departments)/2.0);$i++){ ?>
        
                <li class="list-group-item">
				  <div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="<?php echo $departments[$i]["id"] ?>" name="department_id" value="<?php echo $departments[$i]["department_id"]; ?>">
					<label class="custom-control-label" for="<?php echo $departments[$i]["id"] ?>"><?php echo $departments[$i]["department"] ?></label>
				  </div>
                </li>
                
                <?php }?>
			</ul>
             <ul class="list-group offset-1 col-5 list-group-flush my-2">
				<?php for($i=ceil(count($departments)/2.0);$i<count($departments);$i++){ ?>
                <li class="list-group-item">
		          <div class="custom-control custom-radio">
					<input type="radio" class="custom-control-input" id="<?php echo $departments[$i]["id"] ?>" name="department_id" value="<?php echo $departments[$i]["department_id"]; ?>">
					<label class="custom-control-label" for="<?php echo $departments[$i]["id"] ?>"><?php echo $departments[$i]["department"] ?></label>
				  </div>
                </li>
                
                <?php }?>
			</ul>
		</div>
		<div class="form-group row">
				<div class="col-12">
				  <center><button name="submit" onclick="location.href='sa_new_user_faculty.php'" type="button" class="btn btn-primary mx-1">Go Back</button><button id="myButton" name="submit" type="submit" class="btn btn-primary mx-1" disabled>Continue</button></center>
				</div>
		</div>
	</div>	
    </form>
</div>
       <script>
        document.getElementById("myForm").addEventListener("change", displayButton);
        function displayButton() {
        document.getElementById("myButton").disabled = false;
        }
           
        if ($('#role').val()=='vice chair'){
            $('#myForm').attr('action', "sa_new_user_show_up.php");
        }else{
            $('#myForm').attr('action', "sa_new_user_program.php");
        }
    </script>
</body>
</html>

<?php } ?>