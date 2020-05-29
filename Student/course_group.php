<?php

include "../config.php";


// logout and go to login page
if(isset($_GET["operation"]) && $_GET["operation"] == "logout") {
	session_destroy();
	header("Location: ../index.php");
}

$user_id=$_SESSION["user_id"];

//get selected course code from previous html page
$crs_code=$_POST["course_code"];
$sel_crs= "'".$crs_code."'";

$selectedCourse=$db->query("SELECT * FROM course WHERE course_code=$sel_crs")->fetchAll(PDO::FETCH_ASSOC);
$sel_grp=$selectedCourse[0]["group_id"];

$user=$db->query("SELECT * FROM users WHERE user_id=$user_id")->fetchAll(PDO::FETCH_ASSOC);
$student=$db->query("SELECT * FROM student WHERE s_id=$user_id")->fetchAll(PDO::FETCH_ASSOC);
$advisor=$db->query("SELECT * FROM advises JOIN instructor WHERE s_id=$user_id")->fetchAll(PDO::FETCH_ASSOC);


$student_tt=$db->query("SELECT periods FROM schedule WHERE s_id=$user_id")->fetchAll(PDO::FETCH_ASSOC);
$stt=subArraysToString($student_tt);
$schedule=preg_split("/[\s,]+/", $stt);


$takes=$db->query("SELECT * FROM takes JOIN schedule ON takes.s_id=schedule.s_id WHERE takes.s_id=$user_id AND takes.group_id=$sel_grp")->fetchAll(PDO::FETCH_ASSOC);


function displayGroups($course){
	$db = new PDO("mysql:host=localhost;dbname=emu_register", "root", "");
	$group=$db->query("SELECT * FROM course_group INNER JOIN instructor ON course_group.i_id=instructor.i_id WHERE course_group.course_code=$course")->fetchAll(PDO::FETCH_ASSOC);
	return $group;

	}


//get periods and classrooms in array form and splice to individual ELEMENTS
$periods=$db->query("SELECT period FROM course_group WHERE course_code=$sel_crs AND group_id=$sel_grp")->fetchAll(PDO::FETCH_ASSOC);
$string=subArraysToString($periods);
echo $string;
$lectureHour=preg_split("/[\s,]+/", $string); //each individual lecture hour
$numOfLectures=count($lectureHour);

//alg: while i<numOfLectures, match lectureHour[i] with table element, echo lectureHour[i] and classroom[i], i++

$classroom=$db->query("SELECT classroom FROM course_group WHERE course_code=$sel_crs AND group_id=$sel_grp")->fetchAll(PDO::FETCH_ASSOC);
$string1=subArraysToString($classroom);
$classNo=preg_split("/[\s,]+/", $string1);



function subArraysToString($ar, $sep = ', ') {
    $str = '';
    foreach ($ar as $val) {
        $str .= implode($sep, $val);
        $str .= $sep; // add separator between sub-arrays
    }
    $str = rtrim($str, $sep); // remove last separator
    return $str;
}
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

						  <table id="student-schedule" class="table table-sm table-borderless shadow" style="background-color:#e1f1ff">
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
							<table class="table table-sm tt shadow-lg" id="timetable"> <!--Timetable-->
								<thead>
								  <col width="%10">
								  <col width="%15">
								  <col width="%15">
								  <col width="%15">
								  <col width="%15">
								  <col width="%15">
								  <col width="%15">
								  <tr>
									<th>Period <br> Saat</th>
									<th>Monday <br> Pazartesi</th>
									<th>Tuesday <br> Sali</th>
									<th>Wednesday <br> Carsamba</th>
									<th>Thursday <br> Persembe</th>
									<th>Friday <br> Cuma</th>
									<th>Saturday <br> Cumartesi</th>
								  </tr>
								</thead>

							<tbody>
								<tr id="0" class="ts-1" style="height:30px">
								<td>08:30-09:20</td>
								<td></td>
								<td id="add_to_me" class="ts-3 "><a>CMPE312 / CMPE137</a></td>
								<td class="ts-3">CMPE312 / CMPE137</td>
								<td class="ts-3">CMPE312 / CMPE137</td>
								<td></td>
								<td></td>
							  </tr>
							  <tr id="1" class="ts-2" style="height:30px">
								<td>09:30-10:20</td>
								<td></td>
								<td class="ts-3">CMPE312 / CMPE137</td>
								<td class="ts-3">CMPE312 / CMPE137</td>
								<td class="ts-3">CMPE312 / CMPE137</td>
								<td class="ts-3">CMPE312 / CMPE137</td>
								<td></td>
							  </tr>
							  <tr id="2" class="ts-1" style="height:30px">
								<td>10:30-11:20</td>
								<td class="ts-3" id="add_to_me_2">CMPE312 / CMPE137</td>
								<td class="ts-3">CMPE312 / CMPE137</td>
								<td></td>
								<td></td>
								<td class="ts-3">CMPE312 / CMPE137</td>
								<td></td>
							  </tr>
							  <tr id="3" class="ts-2" style="height:30px">
								<td>11:30-12:20</td>
								<td class="ts-3">CMPE312 / CMPE137</td>
								<td class="ts-3">CMPE312 / CMPE137</td>
								<td></td>
								<td></td>
								<td class="ts-3">CMPE312 / CMPE137</td>
								<td></td>
							  </tr>
							  <tr id="4" class="ts-1" style="height:30px">
								<td>12:30-13:20</td>
								<td></td>
								<td></td>
								<td class="ts-3">CMPE312 / CMPE137</td>
								<td class="ts-3">CMPE312 / CMPE137</td>
								<td></td>
								<td></td>
							  </tr>
							  <tr id="5" class="ts-2" style="height:30px">
								<td>13:30-14:20</td>
								<td></td>
								<td></td>
								<td class="ts-3">CMPE312 / CMPE137</td>
								<td class="ts-3">CMPE312 / CMPE137</td>
								<td></td>
								<td></td>
							  </tr>
							  <tr id="6" class="ts-1" style="height:30px">
								<td>14:30-15:20</td>
								<td class="ts-3">CMPE312 / CMPE137</td>
								<td class="ts-3">CMPE312 / CMPE137</td>
								<td class="ts-3">CMPE312 / CMPE137</td>
								<td class="ts-3">CMPE312 / CMPE137</td>
								<td></td>
								<td></td>
							  </tr>
							  <tr id="7" class="ts-2" style="height:30px">
								<td>15:30-16:20</td>
								<td class="ts-3">CMPE312 / CMPE137</td>
								<td class="ts-3">CMPE312 / CMPE137</td>
								<td class="ts-3">CMPE312 / CMPE137</td>
								<td class="ts-3">CMPE312 / CMPE137</td>
								<td></td>
								<td></td>
							  </tr>
							  <tr id="8" class="ts-1" style="height:30px">
								<td>16:30-17:20</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							  </tr>
							  <tr id="9" class="ts-2" style="height:30px">
								<td>17:30-18:20</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							  </tr>
							  <tr id="10" class="ts-1" style="height:30px">
								<td>18:30-19:20</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							  </tr>
							  <tr id="11" class="ts-2" style="height:30px">
								<td>19:30-20:20</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							  </tr>
							  <tr id="12" class="ts-1" style="height:30px">
								<td>20:30-21:20</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							  </tr>
							  <tr id="13" class="ts-2" style="height:30px">
								<td>21:30-22:20</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							  </tr>
							  <tr id="14" class="ts-1" style="height:30px">
								<td>22:30-23:20</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							  </tr>

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
							<tbody id="tbody">
							  <!-- <tr>
								<td>Group #</td>
								<td>CMPE 101</td>
								<td>COURSE NAME</td>
								<td align="right"><button type="button" class="btn btn-primary btn-sm" >Drop Course</button></td>
							  </tr> -->
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
							<td><?php echo $selectedCourse[0]["course_name"];?></td></td>
							<td><?php echo $selectedCourse[0]["credit_hours"];?></td>
							<td><?php echo $selectedCourse[0]["lecture_hrs"];?></td>
							<td><?php echo $selectedCourse[0]["labs"];?></td>
							<td><?php echo $selectedCourse[0]["tutorial"];?></td>
						</tr>

						<tr>
							<th class="text-primary" colspan="6">Course Context</th>
						</tr>

						<tr>
							<td colspan="6"><?php echo $selectedCourse[0]["course_info"];?></td></td>
						</tr>
					</tbody>

				</table>
			</div>

			<div class="container">
				<h3>Group(s)</h3>
				<table class="table table-hover shadow-lg"> <!--Group Information Tabel-->
					<thead>
						<tr>
							<th class="text-primary">Group</th>
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
							<td>
								<a id="group_id" style="font-size:14px">
									<?php echo $selectedGroup[$i]["group_id"];?>
								</a>
							</td>
							<td><a style="font-size:14px"><?php echo $selectedGroup[$i]["quota"];?></a></td>
							<td><a style="font-size:14px"><?php echo $selectedGroup[$i]["quota_left"];?></a></td>
							<td><a style="font-size:14px"><?php echo $selectedGroup[$i]["name"];?></a></td>
							<td>
								<a style="font-size:14px">
									<button id="display_btn" onclick="display('<?php echo $selectedGroup[$i]["period"];?>' , '<?php echo $selectedGroup[$i]["classroom"];?>', '<?php echo $selectedCourse[0]["course_code"];?>')" type="button" value="" class="btn btn-sm btn-primary w-100" style="width:120px">
										Display
									</button>
								</a>
							</td>

							<td>
								<button type="button" id="select_btn" onclick="select()" name="select_btn"  value="display_course" class="btn btn-sm btn-primary w-100" style="width:120px">
										Select
								</button>
							</td>

								<form name="pass_tt" >
									<input type="hidden" id="student_tt" name="student_tt" value="<?php echo $stt; ?>" >
									<input type="hidden" id="student_tt_arr" name="student_tt_arr" value="<?php echo $schedule; ?>" >
									<input type="hidden" id="group_tt" name="group_tt" value="<?php echo $selectedGroup[$i]["period"];?>" >
									<input type="hidden" id="group_id" name="group_id" value="<?php echo $takes[$i]["group_id"]; ?>" >
									<input type="hidden" id="course_code" name="course_code" value="<?php echo $takes[$i]["course_code"]; ?>" >
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
	console.log("inside script");
	//declare variables to be used
	var rIndex, cIndex, td, split_p, split_c, slot, table_index, output, matched, c, r, col_id, row_id, mid, res_arr, displayed, display_btn, select_btn;
	//retrieve main timetable and "Selected Courses" table
	var table = document.getElementById("timetable");
	var tbody = document.getElementById("tbody");

	//retrieve data that will populate "Selected Courses" table
	var group_id=document.getElementById('group_id').value;
	var course_name=document.getElementById('course_name').value;
	var course_code=document.getElementById('course_code').value;

	//retrieve data of student's array of periods, and group schedule's periods
	var st_schedule = document.getElementById('student_tt').value; //access elements as array indices to get periods
	var grp_schedule= document.getElementById('group_tt').value;

	//combine retrieved arrays while trimming and splitting unnecessary characters, resulting in tokens
	var combined = (st_schedule.trim()).concat(", ", grp_schedule.trim()).split(/[ ,\n]+/);
	//combined is an array, convert it to string
	var combinedStr = combined.toString();



	//day and time dictionary to match col id and row for display purposes
	var col_dict = {
		1: "Monday",
		2: "Tuesday",
		3: "Wednesday",
		4: "Thursday",
		5: "Friday"
	}

	var row_dict = {
		1: "8:30-9:20",
		2: "9:30-10:20",
		3: "10:30-11:20",
		4: "11:30-12:20",
		5: "12:30-13:20",
		6: "13:30-14:20",
		7: "14:30-15:20",
		8: "15:30-16:20",
		9: "16:30-17:20",
		10: "17:30-18:20",
	}

	//retrieve select button
	select_btn=document.getElementById("select_btn");

	//onclick function from html
	function select(){
		//flag variable to limit amount of times select button can be clicked
		var clicked=0;
		if(!clicked){
			//when student selects group, relevant group periods are inserted to their database
			$.ajax({
				type: 'POST',
				url: 'insert.php',
				data: {combinedStr:combinedStr},
				success: function(data){
					console.log("in ajax: "+data);
				}
				})
		//when student selects group, selected group and course should be displayed in "Selected Courses" table
		//simplified as a function
		displaySelectedTable(group_id, course_code, course_name);
		//toggle flag
		clicked=1;
	}
	}

	//function to display selected group and course in "Selected Courses" table
	function displaySelectedTable(group_id, course_code, course_name){
		//insert parameters as row and concatenate onto tbody
		tbody.innerHTML+="<tr><td>"+group_id+"</td>
																		<td>"+course_code+"</td>
																		<td>"+course_name+"</td>
																		<td align='right'><button type='button' class='btn btn-primary btn-sm' >Drop Course</button></td>
																		</tr>";
	}


	//display button flag to limit how many times it can be clicked
	var turn_check=0;
	//retrieving display button
	display_btn=document.getElementById("display_btn");

	//function to display chosen group onto timetable and cancel selection, removing chosen group from timetable
	function display(str1, str2, course_code){
			//display button clicked
			if(turn_check==0){
					//change contents of button from Display to Cancel, blue to red
					display_btn.innerHTML='Cancel';
					document.getElementById("display_btn").style.background='#dc3545';
					//retrieve periods array and classrooms array, split into string calling parse function
					split_p=parse(str1);
					split_c=parse(str2);
					//for each element of period
					for(var i=0; i<split_p.length; i++){
							//convert period number into index of 2D Matrix that represents timetable
							slot = generateIndices(split_p[i]);
							//match generated index with timetable index, finding correct day and lecture hour
							table_index = match(slot);
							//insert course code and period into appropriate day and lecture hour (matching table cell)
							displayed=insert(table_index, course_code, split_c[i]);
					}
					//toggle flag
					turn_check = 1;
			}
			else{
				//change back to blue
				document.getElementById("display_btn").style.background='#007bff';
	      display_btn.innerHTML = 'Display';
				document.getElementById("thiscolor").innerHTML="";
				//toggle flag back
	      turn_check=0;
			}
		}

		//function to insert into table cell
		function insert(i, cc, c){
			//i is index of matching table index generated from match function
			output=table.rows[i[0]].cells[i[1]];
			var htmlstring = output.innerHTML;
			//clash algorithm
			//if periods are repeated, count repetitions calling duplicate function
			var clashPeriods = duplicate(combined).trim().split(" ");
			//how many repetitions (clashes)
			var numOfClashes = clashPeriods.length;
			var isClash=0;
			//if there's no clash and cell is empty, mark color is transparent, no alarming design
			if(!isClash && htmlstring==""){
				output.innerHTML+=
							"<a class='text-primary pt-4'><br><mark>"+cc+"/"+c+"</mark></a>";
			}
			//there is clash, highlight it in red
			else{
				var i=0;
				output.innerHTML+="<a class='text-primary pt-4'><br><mark id='thiscolor'>"+cc+"/"+c+"</mark></a>";
				while(i<numOfClashes){
					var val = generateIndices(clashPeriods[i]);
					console.log("this is the generated index: "+val[0]+" and "+ val[1]);
					document.getElementById("thiscolor").style.background='#dc3545';
					i++;
				}
			}
			return output;
		}

		//counting duplicate periods. if dup=1, no clash, if >1 and 2, then clash and is allowed, if >2 can't select
		function duplicate(arr){
			var current = null;
			var count=0;
			var clashPeriod="";
			var conflict;
			for (var i=0; i < arr.length; i++) {
	        if (arr[i] != current) {
	            if (count>1) {
									clashPeriod+=current+" ";
	            }
	            current = arr[i];
	            count = 1;
	        }
					else {
	            count++;
	        }
	    }
		return clashPeriod;
	}

	//function to match generated index from period element in database with html index of timetable
	function match(timeSlot){
				//timeSlot[0] is the row_id, timeSlot[1] is the col_id
				var matchedIndex;
				matched=0;
				if(!matched){
				for(var i=0; i<table.rows.length; i++){
				  //row cells td
				  for(var j=0; j<table.rows[i].cells.length; j++){
				    // td is the box
				    td = table.rows[i].cells[j];
				    if (td.parentElement.rowIndex==timeSlot[0] && td.cellIndex==timeSlot[1]){
							matched=1;
							//store the conditions that matched as this is the result needed
							rIndex=td.parentElement.rowIndex;
							cIndex=td.cellIndex;
							matchedIndex = [rIndex, cIndex];
							break;
						}
					}
				}
				return matchedIndex;
			}
		}

		//function that takes period element p and produces 2D matrix index
		function generateIndices(p){
			//algorithm to calculate row index and column index, returned as a tuple
			c=p%10;
	    var temp=c;
	    var temp2=c;
			if(c>5){
				col_id=(temp-5)%10+1;
			}else if(c<5){
	      col_id=temp2+1;
	    }else if(c=5){
				col_id=1;
	    }
			r=parseInt(p/10);
			if(r==0){
				if(p<5){row_id=1;}
				else if(p>=5){row_id=2;}
			}else if(r!=0){
				mid=((r*10)+((r+1)*10))/2;
				if(p<mid){
					row_id=r*2+1;
				}else if(p>=mid){
					row_id=r*2+2;
				}
			}
			return [row_id, col_id];
		}

		//simple function that converts string to array
		function parse(s){
			res_arr=s.split(", ");
			return res_arr;
		}


	  </script>

	</div>
	</html>
