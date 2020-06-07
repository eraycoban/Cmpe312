<?php if(isset($_GET['course_id'])){

    include "../config.php";


    $course_id=$_GET['course_id'];
    $course=$db->query("SELECT * FROM course WHERE course_id=$course_id")->fetchAll(PDO::FETCH_ASSOC);
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

			<div class="container bg-light border rounded my-3">
				<br>
				<div class="row">
					<div class="col-12">
						<form method="get" action="vc_new_course_faculty.php">
                            <?php foreach($course[0] as $key => $value){ ?>
                            <input type="hidden" name="<?=$key?>" value="<?=$value?>" >
                            <?php }?>
						  <div class="form-group row">
							<label for="username" class="col-4 col-form-label">Course Code :</label>
							<div class="col-8">
							  <input id="username" name="course_code" value="<?=$course[0]['course_code']?>" class="form-control here" required="required" type="text">
							</div>
						  </div>
						  <div class="form-group row">
							<label for="username" class="col-4 col-form-label">Course Name :</label>
							<div class="col-8">
							  <input id="name"  name="course_name" value="<?=$course[0]['course_name']?>" class="form-control here" type="text" required="required">
							</div>
						  </div>
                            <div class="form-group row">
							<label for="username" class="col-4 col-form-label">Course Semester :</label>
							<div class="col-8">
							  <input name="course_semester" type="number" min="0" id="name" name="name" value="<?=$course[0]['sem_id']?>" class="form-control here" type="text" required="required">
							</div>
						  </div>
                            <div class="form-group row">
							<label for="username" class="col-4 col-form-label">Course Credit :</label>
							<div class="col-8">
							  <input name="course_credit" type="number" min="0" id="name" name="name" value="<?=$course[0]['credit']?>" class="form-control here" type="text" required="required">
							</div>
						  </div>
						  <div class="form-group row">
							<label for="publicinfo" class="col-4 col-form-label">Course Description:</label>
							<div class="col-8">
							  <textarea id="publicinfo" value="<?=$course[0]['description']?>" name="description" cols="40" rows="4" class="form-control" required="required"><?=$course[0]['description']?></textarea>
							</div>
						  </div>
                            <div class="form-group row">
							<div class="offset-4 col-8 my-2">
							  <center><input type="checkbox" class="form-check-input" id="checkbox"><a>Check this box if this course is an <strong>elective</strong> course</a></center>
							</div>
						  </div>
						  <div class="form-group row">
							<div class="offset-4 col-8">
							  <button name="submit" type="submit" class="btn btn-primary">Continue</button>
							</div>
						  </div>

                            <input id="elective" type="hidden" name="is_elective" value="<?=$course[0]['is_elective']?>" >
                            <input type="hidden" name="faculties" value="<?=$course[0]['faculties']?>" >
                            <input type="hidden" name="departments" value="<?=$course[0]['departments']?>" >
                            <input type="hidden" name="programs" value="<?=$course[0]['programs']?>" >
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


    <script>
        if(parseInt(<?=$course[0]['is_elective']?>)){
           $('#checkbox').prop('checked', true);
           }else{
               $('#checkbox').prop('checked', false);
           }

        $("#checkbox").click(function(){
            if($(this).is(":checked")){
                alert("VALUE 1");
                $('#elective').attr('value', "1");}
            else{alert("VALUE 0");
                $('#elective').attr('value', "0");}

        });
    </script>

</body>

<script> <!-- ***************************** TOOL TIP SCRIPT ***************************** -->
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
</script>

</html>

<?php }else {?>
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

			<div class="container bg-light border rounded my-3">
				<br>
				<div class="row">
					<div class="col-12">
						<form method="post" action="vc_new_course_faculty.php">
						  <div class="form-group row">
							<label for="username" class="col-4 col-form-label">Course Code :</label>
							<div class="col-8">
							  <input id="username" name="course_code" placeholder="Course Code ..." class="form-control here" required="required" type="text">
							</div>
						  </div>
						  <div class="form-group row">
							<label for="username" class="col-4 col-form-label">Course Name :</label>
							<div class="col-8">
							  <input id="name"  name="course_name" placeholder="Course Name ..." class="form-control here" type="text" required="required">
							</div>
						  </div>
                            <div class="form-group row">
							<label for="username" class="col-4 col-form-label">Course Semester :</label>
							<div class="col-8">
							  <input name="course_semester" type="number" min="0" id="name" name="name" placeholder="Course Semester (1-8) " class="form-control here" type="text" required="required">
							</div>
						  </div>
                            <div class="form-group row">
							<label for="username" class="col-4 col-form-label">Course Credit :</label>
							<div class="col-8">
							  <input name="course_credit" type="number" min="0" id="name" name="name" placeholder="Course Credit ..." class="form-control here" type="text" required="required">
							</div>
						  </div>
						  <div class="form-group row">
							<label for="publicinfo" class="col-4 col-form-label">Course Description:</label>
							<div class="col-8">
							  <textarea id="publicinfo" name="description" cols="40" rows="4" class="form-control" required="required"></textarea>
							</div>
						  </div>
                            <div class="form-group row">
							<div class="offset-4 col-8 my-2">
							  <center><input type="checkbox" class="form-check-input" id="checkbox"><a>Check this box if this course is an <strong>elective</strong> course</a></center>
							</div>
						  </div>
						  <div class="form-group row">
							<div class="offset-4 col-8">
							  <button name="submit" type="submit" class="btn btn-primary">Continue</button>
							</div>
						  </div>
                            <input id="elective" type="hidden" name="elective" value="0" >
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

    <script>
        $("#checkbox").click(function(){
            $('#elective').attr('value', "1");
        });
    </script>

</body>

<script> <!-- ***************************** TOOL TIP SCRIPT ***************************** -->
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
</script>


<script> <!-- ***************************** ADD NEW Lesson HOUR SCRIPT ***************************** -->
var row_count = 0;
function new_lesson_Function() {
	var table = document.getElementById("new_lesson");
	var row = table.insertRow(row_count);
	var cell0 = row.insertCell(0);
	var cell1 = row.insertCell(1);
	var cell2 = row.insertCell(2);
	cell0.innerHTML = ( <!-- ***************************** col HTML ***************************** -->
						""
);
	cell1.innerHTML = ( <!-- ***************************** col HTML ***************************** -->
						"Group "+(row_count+1)
);
	cell2.innerHTML = ( <!-- ***************************** col HTML ***************************** -->
						"button"
);
	row_count++;
}
<!-- ***************************** DELETE ROW SCRIPT ***************************** -->
function deleteLesson_Function() {
	var table = document.getElementById("new_lesson");
	var last_row = table.rows.length;
	document.getElementById("new_lesson").deleteRow(last_row-2);
	row_count--;
}
</script>
</html>

<?php }?>
