<?php

include "../config.php";


// logout and go to login page
if(isset($_GET["operation"]) && $_GET["operation"] == "logout") {
	session_destroy();
	header("Location: ../index.php");
}

$user_id=$_SESSION["user_id"];

$user=$db->query("SELECT * FROM users WHERE user_id=$user_id")->fetchAll(PDO::FETCH_ASSOC);
$student=$db->query("SELECT * FROM student WHERE s_id=$user_id")->fetchAll(PDO::FETCH_ASSOC);
$advisor=$db->query("SELECT * FROM advises JOIN instructor WHERE s_id=$user_id")->fetchAll(PDO::FETCH_ASSOC);
//$course=$db->query("SELECT * FROM course")->fetchAll(PDO::FETCH_ASSOC);


$crs_code=$_POST["course_code"];
$sel_crs= "'".$crs_code."'";
//echo $str_crs."<br/>";;
$selectedCourse=$db->query("SELECT * FROM course WHERE course_code=$sel_crs")->fetchAll(PDO::FETCH_ASSOC);

//echo $selectedCourse[0]["course_code"]."<br/>";



//$takes=$db->query("SELECT * FROM takes JOIN course WHERE s_id=$user_id")->fetchAll(PDO::FETCH_ASSOC);
//$chosen=$takes[0]["group_id"];
//$chosen=$takes[0]["group_id"];
//$group=$db->query("SELECT * FROM groupst JOIN course ON groupst.course_code = course.course_code WHERE course.course_code=$sel_crs")->fetchAll(PDO::FETCH_ASSOC);
//$var=$group[0]["i_id"];

//$groupst=$db->query("SELECT * FROM instructor WHERE i_id=$var")->fetchAll(PDO::FETCH_ASSOC);
//AND groupst.course_code = course.course_code WHERE

//chosen course index display inside takes[courseIndex]
//chosen course should influence all displayed things
//$courseIndex=

$sel_grp=$selectedCourse[0]["group_id"];



function displayGroups($course){
	$db = new PDO("mysql:host=localhost;dbname=emu_register", "root", "");
	$group=$db->query("SELECT * FROM groupst INNER JOIN instructor ON groupst.i_id=instructor.i_id WHERE groupst.course_code=$course")->fetchAll(PDO::FETCH_ASSOC);
	//echo print_r($group, true)."<br>";
	//$str=subArraysToString($group);
	//$groupArr=explode(",",$str);
	//echo "THIS IS THE NUMBER OF ELEMENTS ".count($groupArr)."<br>";
	//echo "THIS IS THE ARR: ".$group[0]["i_id"]."<br>";
	//echo "THIS IS THE ARR: ".$group[0]["group_id"]."<br>";
	return $group;

	}




//echo "Calling function to display groups<br>".displayGroups($sel_crs)."<br>";

$days=$db->query("SELECT days FROM groupst WHERE course_code=$sel_crs AND group_id=$sel_grp")->fetchAll(PDO::FETCH_ASSOC);
echo "days as an query: ".print_r($days, true)."<br>";
$string=subArraysToString($days);
$dayArr=explode(", ",$string);
echo "days converted to string: ".$string."<br>";
echo "First index of day: ".$dayArr[0]."<br>";
$dayArrLength=count($dayArr);




$times=$db->query("SELECT time FROM groupst WHERE course_code=$sel_crs AND group_id=$sel_grp")->fetchAll(PDO::FETCH_ASSOC);
echo "times as an query: ".print_r($times, true)."<br>";
$string1=subArraysToString($times);
$timeArr=preg_split("/[\s,-]+/", $string1); //the values here are twice as long as the ones below
$timeSlots=preg_split("/[\s,]+/", $string1);
//echo "times converted to string: ".$string1."<br>";
//echo "First index of time: ".$timeIndex[0]."<br>";
//echo "Second index of time: ".$timeArr[1]."<br>";
//echo "Third index of time: ".$timeArr[2]."<br>";
//echo "Fourth index of time: ".$timeArr[3]."<br>";
//echo "This is the number of elements: ".count($timeArr)."<br>";
$timeArrLength=count($timeArr);
$numOfElements=count($timeSlots);



//creating key:value pairs for time:tr index
$dict = [
    "08:30" => "8",
    "09:30" => "9",
		"10:30" => "10",
    "11:30" => "11",
		"12:30" => "12",
    "13:30" => "13",
		"14:30" => "14",
    "15:30" => "15",
		"16:30" => "16",
		"17:30" => "17",
		"18:30" => "18",
		"19:30" => "19",
		"20:30" => "20",
		"21:30" => "21",
		"22:30" => "22",
];



$pair = [
];

function generateDate($days, $slots, $arr){
	$i=0;
	$count=count($slots);
	while($i<$count){
		$arr+=[$days[$i] => $slots[$i]];
		$i++;
	}
	foreach($arr as $key => $val){
		echo "---------$key => $val"."<br>";
	}
	return $arr;
}

$lectures = generateDate($dayArr, $timeSlots, $pair);
//echo print_r($lectures)."<br>";


$store=[];
function storeValues($day, $start_time, $end_time){
	$store+=array($day.", ".$start_time.", ".$end_time);
	return $store;
}


	//echo "$key => $val \n"."<br>";
	//key and value
	//t is the index in time which is 4 and timeArr is the one with beginning and ending times
	//d is the index of days which is 2 and dayArr is the one with days
	//i is the index of time total which is 2 and timeIndex is the time slot


foreach($lectures as $key => $val){
	$spliced = preg_split("/[\s,-]+/", $val);
	echo "This is val".$val."<br>";
	//echo "STRINGGGGG---------".$spliced[0]."+++++++".$spliced[1]."-----------<br>";
	$day=$key;
	$start_time=$spliced[0];
	$end_time=$spliced[1];
	//echo "$start_time, $end_time"."<br>";
	//echo "---------- THE DAY IS: ".$day."<br>";



	foreach($dict as $k => $v){

		if($spliced[0]==$k){
			$start_tr=$v;
		}
		elseif($spliced[1]==$k){
			$end_tr=$v;
	}


	}
	//echo "---------- start HTML tr tag: ".$start_tr."<br>";
	//echo "---------- eng HTML tr tag: ".$end_tr."<br>";


	echo "$day, $start_tr, $end_tr"."<br>";

	$class="CMPE 127";

	$data = [
	 'period' => $val,
	 'start_time' => $start_time,
	 'end_time' => $end_time,
	 'course_code' => $crs_code,
	 'dayName' => $day,
	 'class'=> $class,
];
//$db = new PDO("mysql:host=localhost;dbname=emu_register", "root", "");

$db->prepare("INSERT INTO group_schedule (period, start_time, end_time, course_code, dayName, class)
			VALUES (:period, :start_time, :end_time, :course_code, :dayName, :class)")->execute($data);


	}

$group_schedule=$db->query("SELECT * FROM group_schedule WHERE course_code=$sel_crs")->fetchAll(PDO::FETCH_ASSOC);










//echo $sel_grp;



function subArraysToString($ar, $sep = ', ') {
    $str = '';
    foreach ($ar as $val) {
        $str .= implode($sep, $val);
        $str .= $sep; // add separator between sub-arrays
    }
    $str = rtrim($str, $sep); // remove last separator
    return $str;
}

/////////////////////////////

////////////////////////////

//$index = count($dayArr);
///////////////////////////
//echo "Number of elements: ".$index;





?>

<html>

<head>
<title> EMU PORTAL </title>
<link rel="icon" href="https://upload.wikimedia.org/wikipedia/tr/a/ae/Emu-dau-logo.png">
<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>



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
div ,button.bb{
border-bottom: 1px solid #0000;
text-align:left;
}
button.btn:focus,.btn:active {
   outline: none !important;
   box-shadow: none;
}
.row.no-gutters {
  margin-right: 0;
  margin-left: 0;

  & > [class^="col-"],
  & > [class*=" col-"] {
    padding-right: 0;
    padding-left: 0;
  }
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
	<div class="">
		<div class="mainnav" >
			<nav class="navbar navbar-expand-xl  navbar-dark shadow-lg">
				<a class="nav-link text-light active" href="#" color="white">HOME</a>

			</nav>
		</div>
	</div>

	<div class="row no-gutters" > <!-- MAIN ROW -->
		<div class="col-7">

			<div class="mt-3 container-fluid">
				<div class="row">
					<div class="col-12 ">

							<!--Student information panel-->

						  <table class="table table-sm table-borderless shadow" style="background-color:#e1f1ff">
							<tbody>
							  <tr>
								<td rowspan="2" ><img src="#" alt="PP"></td>
								<td><?php echo $student[0]["name"]." ".$student[0]["surname"];?></td></td></td>
								<td style="text-align:right"><b>ID :</b></td>
								<td><?php echo $student[0]["s_id"];?></td>
							  </tr>
							  <tr>

								<td><?php echo $student[0]["department"];?></td>
								<td style="text-align:right "><b>GPA :</b></td>
								<td><?php echo $student[0]["GPA"];?></td>
							  </tr>
							  <tr>
								<td style="text-align:right"><b>Advisor :</b></td>
								<td><?php echo $advisor[0]["name"];?></td>
								<td style="text-align:right"><b>CGPA :</b></td>
								<td><?php echo $student[0]["CGPA"];?></td>
							  </tr>
							  <tr>
								<td></td>
								<td><?php echo $advisor[0]["email"];?></td>
								<td colspan="2"></td>
							  </tr>
							</tbody>
						  </table>

					</div>
				</div>
			</div>
			<div class="container-fluid">
				<div class="row">

					<!--Timetable-->

					<div class="col-12">
						<table class="table table-sm tt shadow-lg">
							<thead>
							  <col width="%10">
							  <col width="%15">
							  <col width="%15">
							  <col width="%15">
							  <col width="%15">
							  <col width="%15">
							  <col width="%15">
								<tr> <!--START OF DAY ROW-->
	 							<th>Period <br> Saat</th>
								<?php
								$engDays = ["Monday","Tuesday", "Wednesday", "Thursday", "Friday","Saturday"];
								$turkishDays = [" Pazartesi", " Sali", " Carsamba", " Persembe", " Cuma", " Cumartesi"];
								$indexDay=0;
								$id=1;
								while($indexDay<6){
									//indexDay is 0, 1, 2, 3--- example 1 is tuesday
								?>
	 							<th id=<?php echo "'".$id."'"?>>
									<?php echo $engDays[$indexDay]."<br>".$turkishDays[$indexDay];
											if ($group_schedule[0]["dayName"]==$engDays[$indexDay]){
												$match=$indexDay+1; //so that case switch works according to index
												echo "lecture day: ".$group_schedule[0]["dayName"]." matches ".$engDays[$indexDay]."<br>";
											}

									?>
								</th>
		 						<?php $indexDay++;} ?>
							</tr><!--END OF DAY ROW-->
							</thead>

							<tbody>
								<tr id="1" class="ts-1" style="height:30px">
								<td>08:30-09:20</td>
								<td></td>
								<td id="add_to_me" class="ts-3 "><a>CMPE312 / CMPE137</a></td>
								<td class="ts-3">CMPE312 / CMPE137</td>
								<td class="ts-3">CMPE312 / CMPE137</td>
								<td></td>
								<td></td>
							  </tr>
							  <tr id="2" class="ts-2" style="height:30px">
								<td>09:30-10:20</td>
								<td></td>
								<td class="ts-3">CMPE312 / CMPE137</td>
								<td class="ts-3">CMPE312 / CMPE137</td>
								<td class="ts-3">CMPE312 / CMPE137</td>
								<td class="ts-3">CMPE312 / CMPE137</td>
								<td></td>
							  </tr>
							  <tr id="3" class="ts-1" style="height:30px">
								<td>10:30-11:20</td>
								<td class="ts-3" id="add_to_me_2">CMPE312 / CMPE137</td>
								<td class="ts-3">CMPE312 / CMPE137</td>
								<td></td>
								<td></td>
								<td class="ts-3">CMPE312 / CMPE137</td>
								<td></td>
							  </tr>
							  <tr id="4" class="ts-2" style="height:30px">
								<td>11:30-12:20</td>
								<td class="ts-3">CMPE312 / CMPE137</td>
								<td class="ts-3">CMPE312 / CMPE137</td>
								<td></td>
								<td></td>
								<td class="ts-3">CMPE312 / CMPE137</td>
								<td></td>
							  </tr>
							  <tr id="5" class="ts-1" style="height:30px">
								<td>12:30-13:20</td>
								<td></td>
								<td></td>
								<td class="ts-3">CMPE312 / CMPE137</td>
								<td class="ts-3">CMPE312 / CMPE137</td>
								<td></td>
								<td></td>
							  </tr>
							  <tr id="13" class="ts-2" style="height:30px">
								<td>13:30-14:20</td>
								<td></td>
								<td></td>
								<td class="ts-3">CMPE312 / CMPE137</td>
								<td class="ts-3">CMPE312 / CMPE137</td>
								<td></td>
								<td></td>
							  </tr>
							  <tr id="14" class="ts-1" style="height:30px">
								<td>14:30-15:20</td>
								<td class="ts-3">CMPE312 / CMPE137</td>
								<td class="ts-3">CMPE312 / CMPE137</td>
								<td class="ts-3">CMPE312 / CMPE137</td>
								<td class="ts-3">CMPE312 / CMPE137</td>
								<td></td>
								<td></td>
							  </tr>
							  <tr id="15" class="ts-2" style="height:30px">
								<td>15:30-16:20</td>
								<td class="ts-3">CMPE312 / CMPE137</td>
								<td class="ts-3">CMPE312 / CMPE137</td>
								<td class="ts-3">CMPE312 / CMPE137</td>
								<td class="ts-3">CMPE312 / CMPE137</td>
								<td></td>
								<td></td>
							  </tr>
							  <tr id="16" class="ts-1" style="height:30px">
								<td>16:30-17:20</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							  </tr>
							  <tr id="17" class="ts-2" style="height:30px">
								<td>17:30-18:20</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							  </tr>
							  <tr id="18" class="ts-1" style="height:30px">
								<td>18:30-19:20</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							  </tr>
							  <tr id="19" class="ts-2" style="height:30px">
								<td>19:30-20:20</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							  </tr>
							  <tr id="20" class="ts-1" style="height:30px">
								<td>20:30-21:20</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							  </tr>
							  <tr id="21" class="ts-2" style="height:30px">
								<td>21:30-22:20</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							  </tr>
							  <tr id="22" class="ts-1" style="height:30px">
								<td>22:30-23:20</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							  </tr>
							  <tr class="ts-2">

							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- Selected Courses -->
			<div class="mt-3 container-fluid">
				<div class="row ">
					<div class="col-12 ">

						  <table id="selected-c" class="table table-sm table-borderless shadow" style="background-color:#e1f1ff">
							<thead class="thead-light">
								<th class="pl-4" colspan="4">Selected Courses</th>
							  </thead>
							<tbody>
							  <tr>
								<td>Group #</td>
								<td>CMPE 101</td>
								<td>COURSE NAME</td>
								<td align="right"><button type="button" class="btn btn-primary btn-sm" >Drop Course</button></td>
							  </tr>
							</tbody>
						  </table>

					</div>
				</div>
			</div>
		</div>
		<div class="col-5">
			<div class="container mt-3">
				<h3>Course Information</h3>
				<table class="table table-bordered shadow-lg"> <!--Course Information Table-->
					<thead>
						<tr>
							<th class="text-primary">Course Code</th>
							<th class="text-primary">Course Name</th>
							<th class="text-primary">Credit</th>
							<th class="text-primary">Lecture Hours <small>(hrs/week)</small></th>
							<th class="text-primary">Labs <small>(hrs/week)</small></th>
							<th class="text-primary">Tutorial<br><small>(hrs/week)</small></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?php echo $selectedCourse[0]["course_code"];?> </td>
								<!--CMPE 344--></td>
							<td><!--</td></td>Computer Networks--><?php echo $selectedCourse[0]["course_name"];?></td></td>
							<td><!--4--><?php echo $selectedCourse[0]["credit_hours"];?></td>
							<td><!--4--><?php echo $selectedCourse[0]["lecture_hrs"];?></td>
							<td><!--1--><?php echo $selectedCourse[0]["labs"];?></td>
							<td><!-----><?php echo $selectedCourse[0]["tutorial"];?></td>
						</tr>

						<tr>
							<th class="text-primary" colspan="6">Course Context</th>
						</tr>
						<tr>
							<td colspan="6"><!--Basic concepts of data transmission. Overview of networks. The layered network architecture, ISO reference model. Circuit switching, packet switching. Physical layer. Communication techniques. Frequency and time division multiplexing, modulation, modems, error detecting. Data link layer. Data link protocols. Network layer. Routing and congestion. Local area networks. Other layers. Examples of commonly used networks and their protocols. Basics of LANs ,wireless LANs, new trends in computer communication and computer networks--> <?php echo $selectedCourse[0]["course_info"];?></td></td>
						</tr>
					</tbody>

				</table>
			</div>

			<div class="container">
				<h3>Group(s)</h3>
				<table class="table table-hover shadow-lg"> <!--Group Information Tabel-->
					<thead>
						<tr>
							<th class="text-primary">Grup</th>
							<th class="text-primary">Quota</th>
							<th class="text-primary">Left</th>
							<th class="text-primary">Instructor</th>
							<th class="text-primary" colspan="2" style="float-left"></th>
						</tr>
					</thead>
					<tbody>


							<?php
								$selectedGroup=displayGroups($sel_crs);
								$count=count($selectedGroup);
								$i=0;
								while($i<$count){
								?>
							<tr>
							<td><a id="group_id" style="font-size:14px"><?php echo $selectedGroup[$i]["group_id"];?></a></td>
							<td><a style="font-size:14px">30</a></td>
							<td><a style="font-size:14px">2</a></td>
							<td><a style="font-size:14px"><?php echo $selectedGroup[$i]["name"];?></a></td>
							<td><a style="font-size:14px">
								<button onclick="display_1()" type="button" id="display_btn_1" value="" class="btn btn-sm btn-primary w-100" style="width:120px">Display</button></a></td>
							<td>
								<form action="" method="post">
								<button type="button" name="display_course" value="display_course" class="btn btn-sm btn-primary w-100" style="width:120px">Select</button></td>
								<!--<input type="hidden" name="display_course" value="display_course"/>-->
						</form>
						</tr>
						<?php $i++;} ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
</body>
<script>
  var turn_check =0;
  var turn_check_1 =0;
  var elem = document.getElementById("display_btn_1");
  var elem_2 = document.getElementById("display_btn_2");
    function display_1() {
      if(turn_check ==0){
        document.getElementById(id).innerHTML +=
        "<a id='displayed_course' class='text-primary pt-4'><br><mark id='display_crs_1'>CMPE312 / CMPE137</mark></a>";
        elem.innerHTML = 'Cancel';
        document.getElementById("display_crs_1").style.background='#dc3545';
        //this is the color of the background of button, changes to red when selected
        document.getElementById("display_btn_1").style.background='#dc3545';
        //$("#display_btn_1").click(function()){
          //alert("this is what happens "+$("#group_id").text());
        //}
        turn_check=1;
      }else{
        document.getElementById("displayed_course").remove();
        document.getElementById("display_btn_1").style.background='#007bff';
        elem.innerHTML = 'Display';
        turn_check=0;



  }
}

  function display_2() {
    if(turn_check_1 ==0){
      document.getElementById("add_to_me_2").innerHTML +=
      "<a id='displayed_course_2' class='text-primary pt-4'><br><mark id='display_crs_2'>CMPE312 / CMPE137</mark></a>";
      elem_2.innerHTML = 'Cancel';
      document.getElementById("display_crs_2").style.background='#ffc107';
      document.getElementById("display_btn_2").style.background='#ffc107';
      turn_check_1=1;
    }else{
      document.getElementById("displayed_course_2").remove();
      document.getElementById("display_btn_2").style.background='#007bff';
      elem_2.innerHTML = 'Display';
      turn_check_1=0;
    }
      }
  </script>

</div>
</html>
