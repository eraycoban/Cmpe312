<?php

include "../config.php";

// logout and go to login page
if(isset($_GET["operation"]) && $_GET["operation"] == "logout") {
	session_destroy();
	header("Location: ../index.php");
}

$user=$db->query("SELECT * FROM users")->fetchAll(PDO::FETCH_ASSOC);

if(isset($_POST['delete'])){

    $user_id=$_POST['user_id'];
    $users=$db->query("SELECT * FROM users WHERE user_id=$user_id")->fetchAll(PDO::FETCH_ASSOC);
    $role=$users[0]['role'];
    $register=$db->query("DELETE FROM users WHERE user_id=$user_id;");

    if($role=="student"){
         $register=$db->query("DELETE FROM student WHERE s_id=$user_id;");
         $cur_tab='astudent';
    }else if($role=="advisor"){
         $register=$db->query("DELETE FROM advisors WHERE user_id=$user_id;");
        $cur_tab='aadvisor';
    }else if($role=="vice chair"){
         $register=$db->query("DELETE FROM vice_chairs WHERE user_id=$user_id;");
        $cur_tab='avice_chair';
    }else if($role=="vice dean"){
         $register=$db->query("DELETE FROM vice_deans WHERE user_id=$user_id;");
        $cur_tab='avice_dean';
    }else{
         $register=$db->query("DELETE FROM admins WHERE user_id=$user_id;");
        $cur_tab='asystem_administrator';
    }




}

if(isset($_POST['edit'])){

    $user_id=$_POST['user_id'];
    $crole=$_POST['select'];

    $users=$db->query("SELECT * FROM users WHERE user_id=$user_id")->fetchAll(PDO::FETCH_ASSOC);
    $role=$users[0]['role'];

    if($crole=="student"){
        $remain=$user_id%"10000000";
        $new_user_id=$remain+"10000000";
        header("Location: sa_new_user_faculty.php?old_user_id=$user_id&old_user_role=$role&user_id=$new_user_id&user_role=$crole");

    }else if($crole=="advisor"){
        $remain=$user_id%"10000000";
        $new_user_id=$remain+"20000000";
        header("Location: sa_new_user_faculty.php?old_user_id=$user_id&old_user_role=$role&user_id=$new_user_id&user_role=$crole");

    }else if($crole=="vice chair"){
        $remain=$user_id%"10000000";
        $new_user_id=$remain+"30000000";
        header("Location: sa_new_user_faculty.php?old_user_id=$user_id&old_user_role=$role&user_id=$new_user_id&user_role=$crole");

    }else if($crole=="vice dean"){
        $remain=$user_id%"10000000";
        $new_user_id=$remain+"40000000";
        header("Location: sa_new_user_faculty.php?old_user_id=$user_id&old_user_role=$role&user_id=$new_user_id&user_role=$crole");

    }else{
        $remain=$user_id%"10000000";
        $new_user_id=$remain+"50000000";
        header("Location: sa_new_user_show_up.php?old_user_id=$user_id&old_user_role=$role&user_id=$new_user_id&user_role=$crole");
    }

//        if($role=="student"){
//         $register=$db->query("DELETE FROM students WHERE user_id=$user_id;");
//        }else if($role=="advisor"){
//             $register=$db->query("DELETE FROM advisors WHERE user_id=$user_id;");
//        }else if($role=="vice chair"){
//             $register=$db->query("DELETE FROM vice_chairs WHERE user_id=$user_id;");
//        }else if($role=="vice dean"){
//             $register=$db->query("DELETE FROM vice_deans WHERE user_id=$user_id;");
//        }else{
//             $register=$db->query("DELETE FROM admins WHERE user_id=$user_id;");
//        }
//
//    if($crole=="student"){
//        $remain=$user_id%"10000000";
//        $new_user_id=$remain+"10000000";
//    }else if($crole=="advisor"){
//        $remain=$user_id%"10000000";
//        $new_user_id=$remain+"20000000";
//    }else if($crole=="vice chair"){
//        $remain=$user_id%"10000000";
//        $new_user_id=$remain+"30000000";
//    }else if($crole=="vice dean"){
//        $remain=$user_id%"10000000";
//        $new_user_id=$remain+"40000000";
//    }else{
//        $remain=$user_id%"10000000";
//        $new_user_id=$remain+"50000000";
//    }
//
//    $register=$db->query("UPDATE users SET role='$crole' WHERE user_id=$user_id");
//    $register=$db->query("UPDATE users SET user_id=$new_user_id WHERE user_id=$user_id");
//
//    if($crole=="student"){
//        $register=$db->prepare("INSERT INTO students SET user_id=:user_id");
//        $rmission= $register->execute(array('user_id'=>$new_user_id));
//        }else if($crole=="advisor"){
//        $register=$db->prepare("INSERT INTO advisors SET user_id=:user_id");
//        $rmission= $register->execute(array('user_id'=>$new_user_id));
//        }else if($crole=="vice chair"){
//        $register=$db->prepare("INSERT INTO vice_chairs SET user_id=:user_id");
//        $rmission= $register->execute(array('user_id'=>$new_user_id));
//        }else if($crole=="vice dean"){
//        $register=$db->prepare("INSERT INTO vice_deans SET user_id=:user_id");
//        $rmission= $register->execute(array('user_id'=>$new_user_id));
//        }else{
//        $register=$db->prepare("INSERT INTO admins SET user_id=:user_id");
//        $rmission= $register->execute(array('user_id'=>$new_user_id));}



}

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

	<!-- Script for search student -->
	<script>
		$(document).ready(function(){
		  $("#std-search").on("keyup", function() {
			var value = $(this).val().toLowerCase();
			$("#std-table tr").filter(function() {
			  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		  });
		});
	</script>
	<!-- Script for search Advisor -->
	<script>
		$(document).ready(function(){
		  $("#advisor-search").on("keyup", function() {
			var value = $(this).val().toLowerCase();
			$("#advisor-table tr").filter(function() {
			  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		  });
		});
	</script>
	<!-- Script for search Vice Chair -->
	<script>
		$(document).ready(function(){
		  $("#vc-search").on("keyup", function() {
			var value = $(this).val().toLowerCase();
			$("#vc-table tr").filter(function() {
			  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		  });
		});
	</script>
	<!-- Script for search Vice Dean -->
	<script>
		$(document).ready(function(){
		  $("#vd-search").on("keyup", function() {
			var value = $(this).val().toLowerCase();
			$("#vd-table tr").filter(function() {
			  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		  });
		});
	</script>
	<!-- Script for search System Administrator -->
	<script>
		$(document).ready(function(){
		  $("#sa-search").on("keyup", function() {
			var value = $(this).val().toLowerCase();
			$("#sa-table tr").filter(function() {
			  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		  });
		});
	</script>
	<!-- Script for Modal -->
	<script>
		function modal(row_count,role) {
			var name = document.getElementById("std-table").rows[row_count].cells[1].innerHTML;
			document.getElementById("un_modal").innerHTML = name ;
			document.getElementById("cRole_modal").innerHTML = role ;
		}
	</script>
<style>

</style>

</head>

<body>

<div class="main h-100">
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
                    <a class="nav-link text-light ml-5" href="admin.php" color="white">HOME</a>
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
				<a class="nav-link bg-light border" href="admin.php" >Create User</a>
			</li>
			<li class="nav-item ">
				<a class="nav-link bg-light border border-primary border-bottom-0" href="#" >Users</a>
			</li>
		</ul>
		<div class="container bg-light rounded border h-100">
			<div class="row h-100">
				<div class="col-md-12">
					<form>
					  <!-- ********************************Sub Nav tabs******************************** -->
						<ul class="nav nav-tabs" id="my_tabs" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" data-toggle="tab" id="astudent" href="#student">Student</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" data-toggle="tab" id="aadvisor" href="#advisor">Advisor</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" data-toggle="tab" id="avice_chair" href="#vice_chair">Vice Chair</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" data-toggle="tab" id="avice_dean" href="#vice_dean">Vice Dean</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" data-toggle="tab" id="asystem_administrator" href="#system_administrator">System Administrator</a>
							</li>
						</ul>

						  <!-- ********************************Tab panes******************************** -->
						<div class="tab-content">
							<div id="student" class="container tab-pane active"><br> <!--********************** Student Tab *********************-->
								<div class="row">
									<div class="col-6 pb-2"><h4>Students</h4></div>
									<div class=" col-6"><input class="form-control" id="std-search" type="text" placeholder="Search ..."></div>
								</div>
								  <table id="" class="table table-striped">
									<thead>
										<tr>
											<th>Student ID</th>
											<th>Student Name</th>
											<th>Faculty</th>
											<th>Department</th>
											<th></th>
										</tr>
									</thead>
									<tbody id="std-table">

                                        <?php $students=$db->query("SELECT * FROM users where role='student'")->fetchAll(PDO::FETCH_ASSOC);
                                        for($i=0;$i<count($students);$i++){
                                        ?>

										<tr >
											<td><?php echo $students[$i]['user_id'] ?></td>
											<td><?php echo $students[$i]['name']." ".$students[$i]['surname']; ?></td>
											<td><?php $faculty_id=$students[$i]['faculty_id'];
                                                $register=$db->query("SELECT * FROM faculties WHERE faculty_id=$faculty_id")->fetchAll(PDO::FETCH_ASSOC);
                                                $faculty=$register[0]['faculty'];
                                                echo $faculty;
                                                ?></td>
											<td><?php $department_id=$students[$i]['department_id'];
                                                $register=$db->query("SELECT * FROM departments WHERE department_id=$department_id")->fetchAll(PDO::FETCH_ASSOC);
                                                $department=$register[0]['department'];
                                                echo $department;
                                                ?></td>
											<td align="center"><button type="button" class="btn btn-sm btn-primary ml-1" href="user_information.php" onclick="window.open('user_information.php?user_id=<?php echo $students[$i]['user_id'] ?>', 'newwindow', 'width=820, height=242'); return false;">Show More</button>
                                                <button type="button" data-role="student" data-name="<?php echo $students[$i]['name']." ".$students[$i]['surname']?>" class="editrole btn btn-sm btn-primary ml-1" data-id="<?php echo $students[$i]['user_id']?>" >Edit Role</button>

                                            <button type="button"  class="deleterole btn btn-sm btn-danger ml-1" data-name="<?php echo $students[$i]['name']." ".$students[$i]['surname']?>" data-role="student" data-id="<?php echo $students[$i]['user_id']?>">Delete</button>
										</tr>

                                        <?php }?>
									</tbody>
								  </table>
							</div>
							<div id="advisor" class="container tab-pane fade"><br> <!--********************** Advisor Tab *********************-->
								<div class="row">
									<div class="col-6 pb-2"><h4>Advisor</h4></div>
									<div class=" col-6"><input class="form-control" id="advisor-search" type="text" placeholder="Search ..."></div>
								</div>
								  <table id="" class="table table-striped">
									<thead>
										<tr>
											<th>Advisor ID</th>
											<th>Advisor Name</th>
											<th>Faculty</th>
											<th>Department</th>
											<th></th>
										</tr>
									</thead>
									<tbody id="advisor-table">

                                        <?php $advisor=$db->query("SELECT * FROM users where role='advisor'")->fetchAll(PDO::FETCH_ASSOC);
                                        for($i=0;$i<count($advisor);$i++){
                                        ?>

										<tr >
											<td><?php echo $advisor[$i]['user_id'] ?></td>
											<td><?php echo $advisor[$i]['name']." ".$advisor[$i]['surname']; ?></td>
											<td><?php $faculty_id=$advisor[$i]['faculty_id'];
                                                $register=$db->query("SELECT * FROM faculties WHERE faculty_id=$faculty_id")->fetchAll(PDO::FETCH_ASSOC);
                                                $faculty=$register[0]['faculty'];
                                                echo $faculty;
                                                ?></td>
											<td><?php $department_id=$advisor[$i]['department_id'];
                                                $register=$db->query("SELECT * FROM departments WHERE department_id=$department_id")->fetchAll(PDO::FETCH_ASSOC);
                                                $department=$register[0]['department'];
                                                echo $department;
                                                ?></td>
											<td align="center"><button type="button" class="btn btn-sm btn-primary ml-1" href="user_information.php" onclick="window.open('user_information.php?user_id=<?php echo $advisor[$i]['user_id'] ?>', 'newwindow', 'width=820, height=242'); return false;">Show More</button>
                                                <button type="button"  class="editrole btn btn-sm btn-primary ml-1" data-role="advisor" data-name="<?php echo $advisor[$i]['name']." ".$advisor[$i]['surname']?>" data-id="<?php echo $advisor[$i]['user_id']?>" >Edit Role</button>

                                                <button type="button"  class="deleterole btn btn-sm btn-danger ml-1" data-name="<?php echo $advisor[$i]['name']." ".$advisor[$i]['surname']?>" data-role="advisor" data-id="<?php echo $advisor[$i]['user_id']?>">Delete</button>
										</tr>

                                        <?php }?>

									</tbody>
								  </table>
							</div>
							<div id="vice_chair" class="container tab-pane fade"><br> <!--********************** Vice Chair Tab *********************-->
								<div class="row">
									<div class="col-6 pb-2"><h4>Vice Chairs</h4></div>
									<div class=" col-6"><input class="form-control" id="vc-search" type="text" placeholder="Search ..."></div>
								</div>
								  <table id="" class="table table-striped">
									<thead>
										<tr>
											<th>Vice Chairs ID</th>
											<th>Vice Chairs Name</th>
											<th>Faculty</th>
											<th>Department</th>
											<th></th>
										</tr>
									</thead>
									<tbody id="vc-table">
										<?php $vice_chair=$db->query("SELECT * FROM users where role='vice chair'")->fetchAll(PDO::FETCH_ASSOC);
                                        for($i=0;$i<count($vice_chair);$i++){
                                        ?>

										<tr >
											<td><?php echo $vice_chair[$i]['user_id'] ?></td>
											<td><?php echo $vice_chair[$i]['name']." ".$vice_chair[$i]['surname']; ?></td>
											<td><?php $faculty_id=$vice_chair[$i]['faculty_id'];
                                                $register=$db->query("SELECT * FROM faculties WHERE faculty_id=$faculty_id")->fetchAll(PDO::FETCH_ASSOC);
                                                $faculty=$register[0]['faculty'];
                                                echo $faculty;
                                                ?></td>
											<td><?php $department_id=$vice_chair[$i]['department_id'];
                                                $register=$db->query("SELECT * FROM departments WHERE department_id=$department_id")->fetchAll(PDO::FETCH_ASSOC);
                                                $department=$register[0]['department'];
                                                echo $department;
                                                ?></td>
											<td align="center"><button type="button" class="btn btn-sm btn-primary ml-1" href="user_information.php" onclick="window.open('user_information.php?user_id=<?php echo $vice_chair[$i]['user_id'] ?>', 'newwindow', 'width=820, height=242'); return false;">Show More</button>
                                                <button type="button"  class="editrole btn btn-sm btn-primary ml-1" data-role="vice chair" data-name="<?php echo $vice_chair[$i]['name']." ".$advisor[$i]['surname']?>" data-id="<?php echo $vice_chair[$i]['user_id']?>" >Edit Role</button>

                                            <button type="button"  class="deleterole btn btn-sm btn-danger ml-1" data-name="<?php echo $vice_chair[$i]['name']." ".$vice_chair[$i]['surname']?>" data-role="vice chair" data-id="<?php echo $vice_chair[$i]['user_id']?>">Delete</button>
										</tr>

                                        <?php }?>
									</tbody>
								  </table>
							</div>
							<div id="vice_dean" class="container tab-pane fade"><br> <!--********************** Vice Dean Tab *********************-->
								<div class="row">
									<div class="col-6 pb-2"><h4>Vice Deans</h4></div>
									<div class=" col-6"><input class="form-control" id="vd-search" type="text" placeholder="Search ..."></div>
								</div>
								  <table id="" class="table table-striped">
									<thead>
										<tr>
											<th>Vice Dean ID</th>
											<th>Vice Dean Name</th>
											<th>Faculty</th>
											<th></th>
										</tr>
									</thead>
									<tbody id="vd-table">
										<?php $vice_dean=$db->query("SELECT * FROM users where role='vice dean'")->fetchAll(PDO::FETCH_ASSOC);
                                        for($i=0;$i<count($vice_dean);$i++){
                                        ?>

										<tr >
											<td><?php echo $vice_dean[$i]['user_id'] ?></td>
											<td><?php echo $vice_dean[$i]['name']." ".$vice_dean[$i]['surname']; ?></td>
											<td><?php $faculty_id=$vice_dean[$i]['faculty_id'];
                                                $register=$db->query("SELECT * FROM faculties WHERE faculty_id=$faculty_id")->fetchAll(PDO::FETCH_ASSOC);
                                                $faculty=$register[0]['faculty'];
                                                echo $faculty;
                                                ?></td>
											<td align="center"><button type="button" class="btn btn-sm btn-primary ml-1" href="user_information.php" onclick="window.open('user_information.php?user_id=<?php echo $vice_dean[$i]['user_id'] ?>', 'newwindow', 'width=820, height=242'); return false;">Show More</button>
                                                <button type="button" data-role="vice dean" data-name="<?php echo $vice_dean[$i]['name']." ".$vice_dean[$i]['surname']?>" class="editrole btn btn-sm btn-primary ml-1" data-id="<?php echo $vice_dean[$i]['user_id']?>" >Edit Role</button>

                                            <button type="button"  class="deleterole btn btn-sm btn-danger ml-1" data-name="<?php echo $vice_dean[$i]['name']." ".$vice_dean[$i]['surname']?>" data-role="vice dean" data-id="<?php echo $vice_dean[$i]['user_id']?>">Delete</button>
										</tr>

                                        <?php }?>
									</tbody>
								  </table>
							</div>
							<div id="system_administrator" class="container tab-pane fade"><br> <!--********************** System Administrator Tab *********************-->
								<div class="row">
									<div class="col-6 pb-2"><h4>System Administrators</h4></div>
									<div class=" col-6"><input class="form-control" id="sa-search" type="text" placeholder="Search ..."></div>
								</div>
								  <table id="" class="table table-striped">
									<thead>
										<tr>
											<th>Sys. Administrator ID</th>
											<th>Sys. Administrator Name</th>
										</tr>
									</thead>
									<tbody id="sa-table">
										<?php $admin=$db->query("SELECT * FROM users where role='system administrator'")->fetchAll(PDO::FETCH_ASSOC);
                                        for($i=0;$i<count($admin);$i++){
                                        ?>

										<tr >
											<td><?php echo $admin[$i]['user_id'] ?></td>
											<td><?php echo $admin[$i]['name']." ".$admin[$i]['surname']; ?></td>
											<td align="center"><button type="button" class="btn btn-sm btn-primary ml-1" href="user_information.php" onclick="window.open('user_information.php?user_id=<?php echo $admin[$i]['user_id'] ?>', 'newwindow', 'width=820, height=242'); return false;">Show More</button>

                                                <button type="button"  class="editrole btn btn-sm btn-primary ml-1" data-name="<?php echo $admin[$i]['name']." ".$admin[$i]['surname']?>" data-role="system administrator" data-id="<?php echo $admin[$i]['user_id']?>">Edit Role</button>

                                                <button type="button"  class="deleterole btn btn-sm btn-danger ml-1" data-name="<?php echo $admin[$i]['name']." ".$admin[$i]['surname']?>" data-role="system administrator" data-id="<?php echo $admin[$i]['user_id']?>">Delete</button>

										</tr>

                                        <?php }?>
									</tbody>
								  </table>
							</div>
						</div>
						</form>

						<!-- The Modal -->

						<div class="modal" id="myModal">
						  <div class="modal-dialog">
							<div class="modal-content">

							  <!-- Modal Header -->
							  <div class="modal-header">
								<h4 class="modal-title">Change Role</h4>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							  </div>

							  <!-- Modal body -->
                            <form method="post" action="sa_users.php">
                                <input id="user_id" type="hidden" name="user_id" value="">
							  <div class="modal-body">
									<h5 id='un_modal'>Name</h5><br>
									<a class="font-weight-bold">ID :</a> <a id='show_id'></a><br> <br>
                                    <a class="font-weight-bold">Current Role :</a> <a id='cRole_modal'></a><br> <br>
									<h6>Change to :</h6>
									<select id='select' name='select' class='custom-select'>
										<option value='student'>Student</option>
										<option value='advisor'>Advisor</option>
										<option value='vice chair'>Vice Chair</option>
										<option value='vice dean'>Vice Dean</option>
										<option value='system administrator'>System Administrator</option>
									</select>
							  </div>


							  <!-- Modal footer -->
							  <div class="modal-footer">
								<button name="edit" type="submit" class="btn btn-success" >Save</button>
							  </div>
                            </form>

							</div>
						  </div>
						</div>


                    <!-- The Modal for Delete -->
						<div class="modal" id="deleteModal">
						  <div class="modal-dialog">
							<div class="modal-content">

							  <!-- Modal Header -->
							  <div class="modal-header">
								<h4 class="modal-title">Delete User</h4>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							  </div>
							  <!-- Modal body -->
                            <form method="post" action="sa_users.php">
                                <input id="duser_id" type="hidden" name="user_id" value="">
							  <div class="modal-body">
									<h5 id='username'>Name</h5><br>
									<a class="font-weight-bold">ID :</a> <a id='id'></a><br> <br>
                                    <a class="font-weight-bold">ROLE :</a> <a id='role'></a><br> <br>
                                    <a class="font-weight-bold">Are you sure you want to delete ?</a>

							  </div>

							  <!-- Modal footer -->
							  <div class="modal-footer">
								<button name="delete" type="submit" class="btn btn-danger" >Delete</button>
							  </div>
                            </form>

							</div>
						  </div>
						</div>

				</div>
			</div>
		</div>
	</div>
</div>
    <script>
        $('.editrole').click(function () {
            var user_id=$(this).data("id");
            var name=$(this).data("name");
            var user_role=$(this).data("role");
            $('#cRole_modal').html(user_role);
            $('#un_modal').html(name);
            $('#show_id').html(user_id);
            $('#user_id').val(user_id);
            $('#select ').val(user_role);
            $('#myModal').modal();

        })

        $('.deleterole').click(function () {
            var user_id=$(this).data("id");
            var name=$(this).data("name");
            var user_role=$(this).data("role");
            $('#username').html(name);
            $('#id').html(user_id);
            $('#role').html(user_role);
            $('#duser_id').val(user_id);
            $('#deleteModal').modal();
        })

//        $('#my_tabs li #aadvisor').tab('show');


        <?php if(isset($cur_tab)){ ?>
        $('#my_tabs li a[id=<?=$cur_tab?>]').tab('show');
        <?php } ?>
    </script>
</body>

</html>
