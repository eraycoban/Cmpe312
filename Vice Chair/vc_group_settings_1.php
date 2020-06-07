<?php if(isset($_GET['submit'])){?>
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
$department_id=$user[0]['department_id'];

$lecturers=$db->query("SELECT * FROM users WHERE department_id=$department_id AND (role='advisor' OR role='vice chair') ")->fetchAll(PDO::FETCH_ASSOC);


    $fourth_info=$_GET;
    unset($fourth_info['program']);


    $faculties_id=explode(", ",$_GET['faculties']);
    $departments_id=explode(", ",$_GET['departments']);
    $programs_id=explode(", ",$_GET['programs']);
    $group_names=explode(", ",$_GET['group_names']);
    $faculties=[];
    $departments=[];
    $programs=[];
    $groups=[];

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
    foreach($group_names as $key=>$value){
        $try=$db->query("SELECT * FROM course_group WHERE group_name='$value'")->fetchAll(PDO::FETCH_ASSOC);
        $groups=array_merge($try,$groups);
    }



   if(isset($_GET['save'])){
    unset($_GET['save']);
    $fourth_info=$_GET;


    for($i=0;$i<$fourth_info['group_number'];$i++){
        unset($fourth_info['group_name'.$i]);
        unset($fourth_info['lecturer'.$i]);
        unset($fourth_info['quota'.$i]);

        for($k=0;$k<$fourth_info['hour_number'];$k++){
            unset($fourth_info['course_day'.$i.$k]);
            unset($fourth_info['course_hour'.$i.$k]);
            unset($fourth_info['course_class'.$i.$k]);
            unset($fourth_info['lab'.$i.$k]);
        }
    }

    $fourth_info['group_number']=$fourth_info['group_number_new'];
    $fourth_info['hour_number']=$fourth_info['hour_number_new'];
    unset($fourth_info['group_number_new']);
    unset($fourth_info['hour_number_new']);



    $faculties_id=explode(", ",$fourth_info['faculties']);
    $departments_id=explode(", ",$fourth_info['departments']);
    $programs_id=explode(", ",$fourth_info['programs']);
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
}else if(isset($_GET['finish'])){
    $fourth_info=$_GET;
    unset($fourth_info['lecturer']);
    unset($fourth_info['quota']);
    unset($fourth_info['course_day']);
    unset($fourth_info['course_hour']);
    unset($fourth_info['course_class']);
    unset($fourth_info['lab']);

    $group_names=[];
    $group_names=explode(", ",$fourth_info['group_names']);

       for($d=0;$d<$fourth_info['group_number'];$d++){
             $delete=$db->query("DELETE FROM course_group WHERE group_names='$group_names[$d]' ");
       }

    $fourth_info['group_number']=$fourth_info['group_number_new'];
    $fourth_info['hour_number']=$fourth_info['hour_number_new'];
    unset($fourth_info['group_number_new']);
    unset($fourth_info['hour_number_new']);

    $course_id=$fourth_info['course_id'];
    $course_code=$fourth_info['course_code'];
    $course_name=$fourth_info['course_name'];
    $faculties=$fourth_info['faculties'];
    $departments=$fourth_info['departments'];
    $programs=$fourth_info['programs'];
    $group_number=$fourth_info['group_number'];
    $description=$fourth_info['description'];
    $is_elective=$fourth_info['is_elective'];
    $semester=$fourth_info['course_semester'];
    $credit=$fourth_info['course_credit'];

    $group_names=[];

    for($i=0;$i<$fourth_info['group_number'];$i++){
        $group_names[$i]=$fourth_info['group_name'.$i];
    }

    $group_names=implode(", ",$group_names);


    $register= $db->prepare("UPDATE course SET course_id=:course_id, course_code=:course_code, course_name=:course_name, faculties=:faculties, departments=:departments, programs=:programs, group_names=:group_names, description=:description, is_elective=:is_elective, credit=:credit, sem_id=:semester WHERE course_id=:course_id ");
    $lmission= $register->execute(array('course_id'=>$course_id,'course_code'=>$course_code,'course_name'=>$course_name,'faculties'=>$faculties,'departments'=>$departments,'programs'=>$programs,'group_names'=>$group_names,'description'=>$description, 'is_elective'=>$is_elective, 'semester'=>$semester, 'credit'=>$credit));

if($lmission){
        for($i=0;$i<$group_number;$i++){
            $group_name=$fourth_info['group_name'.$i];
            $lecturer_id=$fourth_info['lecturer'.$i];
            $quota=$fourth_info['quota'.$i];
            $lecture_days=[];
            $lecture_hours=[];
            $lecture_classes=[];
            $is_lab=[];
            $periods=[];

//            for($k=0;$k<$fourth_info['hour_number'];$k++){
//                $lecture_days[$k]=$fourth_info['course_day'.$i.$k];
//                $lecture_hours[$k]=$fourth_info['course_hour'.$i.$k];
//                $lecture_classes[$k]=$fourth_info['course_class'.$i.$k];
//                $is_lab[$k]=$fourth_info['lab'.$i.$k];
//
//            }
            $periods=[];
            for($k=0;$k<$fourth_info['hour_number'];$k++){


                $lecture_hours[$k]=$fourth_info['course_hour'.$i.$k];

                if($fourth_info['course_hour'.$i.$k]=='08:30-09:20'){

                    $periods[$k]=$periods[$k].'0';

                }if($fourth_info['course_hour'.$i.$k]=='09:30-10:20'){

                    $periods[$k]=$periods[$k].'1';

                }if($fourth_info['course_hour'.$i.$k]=='10:30-11:20'){

                    $periods[$k]=$periods[$k].'2';

                }if($fourth_info['course_hour'.$i.$k]=='11:30-12:20'){

                    $periods[$k]=$periods[$k].'3';

                }if($fourth_info['course_hour'.$i.$k]=='12:30-13:20'){

                    $periods[$k]=$periods[$k].'4';

                }if($fourth_info['course_hour'.$i.$k]=='13:30-14:20'){

                    $periods[$k]=$periods[$k].'5';

                }if($fourth_info['course_hour'.$i.$k]=='14:30-15:20'){

                    $periods[$k]=$periods[$k].'6';

                }if($fourth_info['course_hour'.$i.$k]=='15:30-16:20'){

                    $periods[$k]=$periods[$k].'7';

                }if($fourth_info['course_hour'.$i.$k]=='16:30-17:20'){

                    $periods[$k]=$periods[$k].'8';

                }if($fourth_info['course_hour'.$i.$k]=='17:30-18:20'){

                    $periods[$k]=$periods[$k].'9';

                }
                $lecture_days[$k]=$fourth_info['course_day'.$i.$k];

                if($fourth_info['course_day'.$i.$k]=='monday'){

                    $periods[$k]=$periods[$k].'0';

                }if($fourth_info['course_day'.$i.$k]=='tuesday'){

                    $periods[$k]=$periods[$k].'1';

                }if($fourth_info['course_day'.$i.$k]=='wednesday'){

                    $periods[$k]=$periods[$k].'2';

                }if($fourth_info['course_day'.$i.$k]=='thursday'){

                    $periods[$k]=$periods[$k].'3';

                }if($fourth_info['course_day'.$i.$k]=='friday'){

                    $periods[$k]=$periods[$k].'4';

                }
                $lecture_classes[$k]=$fourth_info['course_class'.$i.$k];
                $is_lab[$k]=$fourth_info['lab'.$i.$k];

            }

            $lecture_days=implode(", ",$lecture_days);
            $lecture_hours=implode(", ",$lecture_hours);
            $periods=implode(", ",$periods);
            $lecture_classes=implode(", ",$lecture_classes);
            $is_lab=implode(", ",$is_lab);

            $register= $db->prepare("INSERT INTO course_group SET group_names=:group_name, i_id=:lecturer_id, quota=:quota, quota_left=:quota, lecture_days=:lecture_days, lecture_hours=:lecture_hours, lecture_classes=:lecture_classes, is_lab=:is_lab, period=:periods");
            $lmission= $register->execute(array('group_name'=>$group_name,'lecturer_id'=>$lecturer_id, 'quota'=>$quota, 'quota_left'=>$quota, 'lecture_days'=>$lecture_days,'lecture_hours'=>$lecture_hours,'lecture_classes'=>$lecture_classes,'is_lab'=>$is_lab, 'period'=>$periods));
        }

        if($lmission){
                header("Location: vc_courses.php");
            }
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
						<form id="my_form" method="get" action="">
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
							<div id="check_save" class="form-group row mt-3">
								<label for="username" class="col-3 col-form-label"><strong>Number of Groups :</strong></label>
								<div class="col-3">
									<input type="number" min="1" value="<?=$fourth_info['group_number']?>" id="group_number_new" name="group_number_new">
								</div>
								<label for="username" class="col-3 col-form-label"><strong>Course Hour(s) Per Week :</strong></label>
								<div class="col-3">
									<input type="number" value="<?=$fourth_info['hour_number']?>" min="1" id="hour_number_new" name="hour_number_new">
								</div>
							</div>
                                <div class="col-12"><center><button id="save" name='save' class='btn btn-lg btn-success'>Change</button></center></div>
                            </div>


                            <?php for($i=0;$i<$fourth_info['group_number'];$i++){ ?>
                            <input type="hidden" name="group_name<?=$i?>" value="<?=$fourth_info['course_code'].'-'.($i+1)?>">
							<div class="container-fluid border rounded mt-5">
                                <h3 class="my-2">Fill these areas :</h3>
								<h3><?php echo $groups[$i]['group_names']; ?></h3>
								<div class="form-group row">
									<label for="lecturer" class="col-4 col-form-label">Course Lecturer :</label>
									<div class="col-8">
									  <input list="lecturer" class="custom-select" value="<?=$groups[$i]['i_id']?>" name="lecturer<?=$i?>" id="">
										<datalist id="lecturer">
                                            <?php for($k=0;$k<count($lecturers);$k++){ ?>
                                            <option value="<?=$lecturers[$k]['user_id']?>"><?=$lecturers[$k]['name']." ".$lecturers[$k]['surname']?></option>
					                        <?php }?>
										</datalist>
									</div>
								</div>
								<div class="form-group row">
									<label for="username" class="col-4 col-form-label">Quota of group :</label>
									<div class="col-8">
										<input type="number" name="quota<?=$i?>" min="1" id="name" value="<?=$groups[$i]['quota']?>" placeholder="Ex : 4" >
									</div>
								</div>

                                <?php
       $is_lab=[];
       $lecture_days=[];
       $lecture_hours=[];
       $lecture_classes=[];

        $lecture_days=explode(", ",$groups[$i]['lecture_days']);
        $lecture_hours=explode(", ",$groups[$i]['lecture_hours']);
        $lecture_classes=explode(", ",$groups[$i]['lecture_classes']);
        $is_lab=explode(", ",$groups[$i]['is_lab']);

                                ?>

                                <?php for($j=0;$j<$fourth_info['hour_number'];$j++){ ?>
                                <div>
								<div class="form-group row mt-5">
                                    <?php if($j==0){?>
									<div class="col-4">
										<h4>Course Hour(s):</h4>
									</div>

                                    <?php }else { ?>
                                    <div class="col-4"></div>
                                    <?php } ?>
									<div class="col-2">
										<h4>Day</h4>
									</div>
									<div class="col-2">
										<h4>Hour</h4>
									</div>
									<div class="col-2">
										<h4>Class</h4>
									</div>
									<div class="col-2">
										<h4>Lab/Tutorial</h4>
									</div>
								</div>
								<div class="form-group row mt-1">
									<div class="col-4">
									</div>
									<div class="col-2">
										<input list="Days" name="course_day<?=$i?><?=$j?>" class="custom-select"  value="<?=$lecture_days[$j]?>">

										<datalist id="Days">
																<option value="monday">Monday</option>
																<option value="tuesday">Tuesday</option>
																<option value="wednesday">Wednesday</option>
																<option value="thursday">Thursday</option>
																<option value="friday">Friday</option>
																<option value="saturday">Saturday</option>
															</datalist>
									</div>
									<div class="col-2">
                                        <input list="Hours" name="course_hour<?=$i?><?=$j?>" class="custom-select"  value="<?=$lecture_hours[$j]?>">

										<datalist id="Hours">
															<option value="08:30-09:20">08:30-09:20</option>
															<option value="09:30-10:20">09:30-10:20</option>
															<option value="10:30-11:20">10:30-11:20</option>
															<option value="11:30-12:20">11:30-12:20</option>
															<option value="12:30-13:20">12:30-13:20</option>
															<option value="13:30-14:20">13:30-14:20</option>
															<option value="14:30-15:20">14:30-15:20</option>
															<option value="15:30-16:20">15:30-16:20</option>
															<option value="16:30-17:20">16:30-17:20</option>
															<option value="17:30-18:20">17:30-18:20</option>
														  </datalist>
									</div>
									<div class="col-2">
										<input list="Classes" name="course_class<?=$i?><?=$j?>" class="custom-select"  value="<?=$lecture_classes[$j]?>" id="">
															<datalist id="Classes">
																<option value="CMPE320">
																<option value="CMPE311">
																<option value="CMPE306">
																<option value="CMPE206">
															</datalist>
									</div>
									<div class="col-2">
										<center><input type="checkbox" id="check_box<?=$i?><?=$j?>" name="lab<?=$i?><?=$j?>" data-id="lab<?=$i?><?=$j?>" class="check_box form-check-input"></center>
                                        <input type="hidden" name="lab<?=$i?><?=$j?>" id="lab<?=$i?><?=$j?>" value="0">
									</div>
								</div>
				                </div>

                                <script>
        if(parseInt(<?=$is_lab[$j]?>)){
           $('#check_box<?=$i?><?=$j?>').prop('checked', true);
           }else{
               $('#check_box<?=$i?><?=$j?>').prop('checked', false);
           }

    </script>

                                <?php }?>
							</div>

                            <?php } ?>
							  <div class="form-group row mt-3">
								<div class="offset-4 col-8">
								  <button id="finish" name="finish" class="btn btn-primary">Complete Creating New Course</button>
								</div>
							  </div>
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
    <script>
        $(".check_box").click(function(){
            var name=$(this).data("id");
            if($(this).is(":checked")){
                $('#'+name).attr('value', "1");
            }else {
                $('#'+name).attr('value', "0");
            }
        });

        $("#save").click(function () {
            $('#my_form').attr('action', 'vc_group_settings_1.php');
            $('#my_form').submit();
        });
        $("#finish").click(function () {

            $('#my_form').attr('action', 'vc_group_settings_1.php');
            $('#my_form').submit();
        });
    </script>
</body>
</html>
<?php } else{ ?>
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
$department_id=$user[0]['department_id'];

$lecturers=$db->query("SELECT * FROM users WHERE department_id=$department_id AND (role='advisor' OR role='vice chair') ")->fetchAll(PDO::FETCH_ASSOC);

if(isset($_POST['submit_group'])){
    unset($_POST['submit_group']);
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
}else if(isset($_POST['save'])){
    unset($_POST['save']);
    $fourth_info=$_POST;


    for($i=0;$i<$fourth_info['group_number'];$i++){
        unset($fourth_info['group_name'.$i]);
        unset($fourth_info['lecturer'.$i]);
        unset($fourth_info['quota'.$i]);

        for($k=0;$k<$fourth_info['hour_number'];$k++){
            unset($fourth_info['course_day'.$i.$k]);
            unset($fourth_info['course_hour'.$i.$k]);
            unset($fourth_info['course_class'.$i.$k]);
            unset($fourth_info['lab'.$i.$k]);
        }
    }

    $fourth_info['group_number']=$fourth_info['group_number_new'];
    $fourth_info['hour_number']=$fourth_info['hour_number_new'];
    unset($fourth_info['group_number_new']);
    unset($fourth_info['hour_number_new']);


    $faculties_id=explode(", ",$fourth_info['faculties']);
    $departments_id=explode(", ",$fourth_info['departments']);
    $programs_id=explode(", ",$fourth_info['programs']);
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
}else if(isset($_POST['finish'])){
    $fourth_info=$_POST;
    unset($fourth_info['lecturer']);
    unset($fourth_info['quota']);
    unset($fourth_info['course_day']);
    unset($fourth_info['course_hour']);
    unset($fourth_info['course_class']);
    unset($fourth_info['lab']);

    $fourth_info['group_number']=$fourth_info['group_number_new'];
    $fourth_info['hour_number']=$fourth_info['hour_number_new'];
    unset($fourth_info['group_number_new']);
    unset($fourth_info['hour_number_new']);

    $lastID=$db->query("SELECT max(course_id) as id FROM course")->fetchAll(PDO::FETCH_ASSOC);

    $course_id=$lastID[0]['id']+1;
    $course_code=$fourth_info['course_code'];
    $course_name=$fourth_info['course_name'];
    $faculties=$fourth_info['faculties'];
    $departments=$fourth_info['departments'];
    $programs=$fourth_info['programs'];
    $group_number=$fourth_info['group_number'];
    $description=$fourth_info['description'];
    $is_elective=$fourth_info['elective'];
    $semester=$fourth_info['course_semester'];
    $credit=$fourth_info['course_credit'];

    $group_names=[];

    for($i=0;$i<$fourth_info['group_number'];$i++){
        $group_names[$i]=$fourth_info['group_name'.$i];

    }
    $group_names=implode(", ",$group_names);


    $register= $db->prepare("INSERT INTO course SET course_id=:course_id, course_code=:course_code, course_name=:course_name, faculties=:faculties, departments=:departments, programs=:programs, group_names=:group_names, description=:description, is_elective=:is_elective, credit=:credit, sem_id=:semester");
    $lmission= $register->execute(array('course_id'=>$course_id,'course_code'=>$course_code,'course_name'=>$course_name,'faculties'=>$faculties,'departments'=>$departments,'programs'=>$programs,'group_names'=>$group_names,'description'=>$description, 'is_elective'=>$is_elective, 'semester'=>$semester, 'credit'=>$credit));

    if($lmission){
        for($i=0;$i<$group_number;$i++){
            $group_name=$fourth_info['group_name'.$i];
            $lecturer_id=$fourth_info['lecturer'.$i];
            $quota=$fourth_info['quota'.$i];
            $lecture_days=[];
            $lecture_hours=[];
            $lecture_classes=[];
            $is_lab=[];
            $periods=[];

//            for($k=0;$k<$fourth_info['hour_number'];$k++){
//                $lecture_days[$k]=$fourth_info['course_day'.$i.$k];
//                $lecture_hours[$k]=$fourth_info['course_hour'.$i.$k];
//                $lecture_classes[$k]=$fourth_info['course_class'.$i.$k];
//                $is_lab[$k]=$fourth_info['lab'.$i.$k];
//
//            }
            $periods=[];
            for($k=0;$k<$fourth_info['hour_number'];$k++){


                $lecture_hours[$k]=$fourth_info['course_hour'.$i.$k];

                if($fourth_info['course_hour'.$i.$k]=='08:30-09:20'){

                    $periods[$k]=$periods[$k].'0';

                }if($fourth_info['course_hour'.$i.$k]=='09:30-10:20'){

                    $periods[$k]=$periods[$k].'1';

                }if($fourth_info['course_hour'.$i.$k]=='10:30-11:20'){

                    $periods[$k]=$periods[$k].'2';

                }if($fourth_info['course_hour'.$i.$k]=='11:30-12:20'){

                    $periods[$k]=$periods[$k].'3';

                }if($fourth_info['course_hour'.$i.$k]=='12:30-13:20'){

                    $periods[$k]=$periods[$k].'4';

                }if($fourth_info['course_hour'.$i.$k]=='13:30-14:20'){

                    $periods[$k]=$periods[$k].'5';

                }if($fourth_info['course_hour'.$i.$k]=='14:30-15:20'){

                    $periods[$k]=$periods[$k].'6';

                }if($fourth_info['course_hour'.$i.$k]=='15:30-16:20'){

                    $periods[$k]=$periods[$k].'7';

                }if($fourth_info['course_hour'.$i.$k]=='16:30-17:20'){

                    $periods[$k]=$periods[$k].'8';

                }if($fourth_info['course_hour'.$i.$k]=='17:30-18:20'){

                    $periods[$k]=$periods[$k].'9';

                }
                $lecture_days[$k]=$fourth_info['course_day'.$i.$k];

                if($fourth_info['course_day'.$i.$k]=='monday'){

                    $periods[$k]=$periods[$k].'0';

                }if($fourth_info['course_day'.$i.$k]=='tuesday'){

                    $periods[$k]=$periods[$k].'1';

                }if($fourth_info['course_day'.$i.$k]=='wednesday'){

                    $periods[$k]=$periods[$k].'2';

                }if($fourth_info['course_day'.$i.$k]=='thursday'){

                    $periods[$k]=$periods[$k].'3';

                }if($fourth_info['course_day'.$i.$k]=='friday'){

                    $periods[$k]=$periods[$k].'4';

                }
                $lecture_classes[$k]=$fourth_info['course_class'.$i.$k];
                $is_lab[$k]=$fourth_info['lab'.$i.$k];

            }

            $lecture_days=implode(", ",$lecture_days);
            $lecture_hours=implode(", ",$lecture_hours);
            $periods=implode(", ",$periods);
            $lecture_classes=implode(", ",$lecture_classes);
            $is_lab=implode(", ",$is_lab);

            $register= $db->prepare("INSERT INTO course_group(group_names, i_id, quota, quota_left, lecture_days, lecture_hours, lecture_classes, is_lab, period) VALUES (?,?,?,?,?,?,?,?,?)")->execute([$group_name, $lecturer_id, $quota, $quota, $lecture_days, $lecture_hours, $lecture_classes, $is_lab, $periods]);

        }

        if($lmission){
                header("Location: vc_courses.php");
            }
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
						<form id="my_form" method="post" action="">
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
							<div id="check_save" class="form-group row mt-3">
								<label for="username" class="col-3 col-form-label"><strong>Number of Groups :</strong></label>
								<div class="col-3">
									<input type="number" min="1" value="<?=$fourth_info['group_number']?>" id="group_number_new" name="group_number_new">
								</div>
								<label for="username" class="col-3 col-form-label"><strong>Course Hour(s) Per Week :</strong></label>
								<div class="col-3">
									<input type="number" value="<?=$fourth_info['hour_number']?>" min="1" id="hour_number_new" name="hour_number_new">
								</div>
							</div>
                                <div class="col-12"><center><button id="save" name='save' class='btn btn-lg btn-success'>Change</button></center></div>
                            </div>


                            <?php for($i=0;$i<$fourth_info['group_number'];$i++){ ?>
                            <input type="hidden" name="group_name<?=$i?>" value="<?=$fourth_info['course_code'].'-'.($i+1)?>">
							<div class="container-fluid border rounded mt-5">
                                <h3 class="my-2">Fill these areas :</h3>
								<h3><?php echo $fourth_info['course_code']."-".($i+1); ?></h3>
								<div class="form-group row">
									<label for="lecturer" class="col-4 col-form-label">Course Lecturer :</label>
									<div class="col-8">
									  <input list="lecturer" class="custom-select" name="lecturer<?=$i?>" id="">
										<datalist id="lecturer">
                                            <?php for($k=0;$k<count($lecturers);$k++){ ?>
                                            <option value="<?=$lecturers[$k]['user_id']?>"><?=$lecturers[$k]['name']." ".$lecturers[$k]['surname']?></option>
					                        <?php }?>
										</datalist>
									</div>
								</div>
								<div class="form-group row">
									<label for="username" class="col-4 col-form-label">Quota of group :</label>
									<div class="col-8">
										<input type="number" name="quota<?=$i?>" min="1" id="name" name="quota" placeholder="Ex : 4" >
									</div>
								</div>

                                <?php for($j=0;$j<$fourth_info['hour_number'];$j++){ ?>
                                <div>
								<div class="form-group row mt-5">
                                    <?php if($j==0){?>
									<div class="col-4">
										<h4>Course Hour(s):</h4>
									</div>

                                    <?php }else { ?>
                                    <div class="col-4"></div>
                                    <?php } ?>
									<div class="col-2">
										<h4>Day</h4>
									</div>
									<div class="col-2">
										<h4>Hour</h4>
									</div>
									<div class="col-2">
										<h4>Class</h4>
									</div>
									<div class="col-2">
										<h4>Lab/Tutorial</h4>
									</div>
								</div>
								<div class="form-group row mt-1">
									<div class="col-4">
									</div>
									<div class="col-2">
										<select id="select" name="course_day<?=$i?><?=$j?>" class="custom-select">
																<option value="monday">Monday</option>
																<option value="tuesday">Tuesday</option>
																<option value="wednesday">Wednesday</option>
																<option value="thursday">Thursday</option>
																<option value="friday">Friday</option>
																<option value="saturday">Saturday</option>
															</select>
									</div>
									<div class="col-2">
										<select id="select" name="course_hour<?=$i?><?=$j?>" class="custom-select">
															<option value="08:30-09:20">08:30-09:20</option>
															<option value="09:30-10:20">09:30-10:20</option>
															<option value="10:30-11:20">10:30-11:20</option>
															<option value="11:30-12:20">11:30-12:20</option>
															<option value="12:30-13:20">12:30-13:20</option>
															<option value="13:30-14:20">13:30-14:20</option>
															<option value="14:30-15:20">14:30-15:20</option>
															<option value="15:30-16:20">15:30-16:20</option>
															<option value="16:30-17:20">16:30-17:20</option>
															<option value="17:30-18:20">17:30-18:20</option>
														  </select>
									</div>
									<div class="col-2">
										<input list="Classes" name="course_class<?=$i?><?=$j?>" class="custom-select"  value="" id="">
															<datalist id="Classes">
																<option value="CMPE320">
																<option value="CMPE311">
																<option value="CMPE306">
																<option value="CMPE206">
															</datalist>
									</div>
									<div class="col-2">
										<center><input type="checkbox" name="lab<?=$i?><?=$j?>" data-id="lab<?=$i?><?=$j?>" class="check_box form-check-input"></center>
                                        <input type="hidden" name="lab<?=$i?><?=$j?>" id="lab<?=$i?><?=$j?>" value="0">
									</div>
								</div>
				                </div>
                                <?php }?>
							</div>

                            <?php } ?>
							  <div class="form-group row mt-3">
								<div class="offset-4 col-8">
								  <button id="finish" name="finish" class="btn btn-primary">Complete Creating New Course</button>
								</div>
							  </div>
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
    <script>
        $(".check_box").click(function(){
            var name=$(this).data("id");
            $('#'+name).attr('value', "1");
        });
        $("#save").click(function () {
            $('#my_form').attr('action', 'vc_group_settings_1.php');
            $('#my_form').submit();
        });
        $("#finish").click(function () {



            $('#my_form').attr('action', 'vc_group_settings_1.php');
            $('#my_form').submit();
        });
    </script>
</body>
</html>
<?php } ?>
