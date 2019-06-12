<?php
	include_once("../session.php");
?>
<!DOCTYPE html>
<html lang="vi">

<head>
	<?php
		include_once("../layout/meta_link.php");
	?>
	<!-- Custom styles for this page -->
	<?php
		include_once("../layout/cssdatatables.php")
	?>
	<title>Quản lý người dùng</title>
</head>
<body id="page-top">
	<!-- Page Wrapper -->
	<div id="wrapper">
		<!-- Sidebar -->
		<?php
			include_once("../layout/sidebar.php");
		?>
		<!-- End of Sidebar -->
		<!-- Content Wrapper -->
		<div id="content-wrapper" class="d-flex flex-column">
			<!-- Main Content -->
      		<div id="content">
      			<!-- Topbar -->
      			<?php
      				include_once("../layout/topbar.php");
      			?>
      			<!-- End of Topbar -->
      			<!-- Begin Page Content -->
      			<?php
      				include("users.php");
      				$users = get_all_users();
      				disconnect_db();
      			?>
      			<div class="container-fluid">
      				<a href="#" class="btn btn-success btn-icon-split">
                    	<span class="text">Add user</span>
                  	</a>
      			</div>
      			<br>
      			<!-- DataTales Users -->
      			<div class="card shadow mb-4">
      				<div class="card-header py-3">
      					<h6 class="m-0 font-weight-bold text-primary">Users List</h6>
      				</div>
      				<div class="card-body">
      					<div class="table-responsive">
      						<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      							<thead>
			                    	<tr>
				                      	<th>ID</th>
				                      	<th>Full name</th>
				                      	<th>Email</th>
				                      	<th>Phone</th>
					                    <th>Gender</th>
					                    <th>Roles</th>
					                    <th>Actions</th>
			                    	</tr>
				                </thead>
				                <tfoot>
				                    <tr>
				                      	<th>ID</th>
				                      	<th>Full name</th>
				                      	<th>Email</th>
				                      	<th>Phone</th>
					                    <th>Gender</th>
					                    <th>Roles</th>
					                    <th>Actions</th>
			                    	</tr>
				                </tfoot>
				                <tbody>
				                	<?php
				                		foreach ($users as $user)
				                		{
				                	?>
				                	<tr>
				                		<td><?php echo $user['u_id']; ?></td>
				                		<td><?php echo $user['u_fullname']; ?></td>
				                		<td><?php echo $user['u_email']; ?></td>
				                		<td><?php echo $user['u_phone']; ?></td>
				                		<td><?php echo $user['u_gender']; ?></td>
				                		<td><?php echo $user['r_name']; ?></td>
				                		<td>
				                			<a href="#" class="btn btn-info btn-circle" data-toggle="modal" <?php echo"data-target='#edituser" .$user['u_id']. "Modal'"; ?>>
                    							<i class="fas fa-info-circle"></i>
                  							</a>
                  							<a href="#" class="btn btn-warning btn-circle">
                    							<i class="fas fa-exclamation-triangle"></i>
                  							</a>
                  							<a href="#" class="btn btn-danger btn-circle">
                    							<i class="fas fa-trash"></i>
                  							</a>
				                		</td>
				                	</tr>
				                	<?php
				                		}
				                	?>
				                </tbody>
      						</table>
      					</div>
      				</div>
      			</div>
      			<!-- End of Page Content -->
      		</div>
      		<!-- End of Main Content -->
      		<!-- Footer -->
      		<?php
      			include_once("../layout/footer.php");
      		?>
      		<!-- End of Footer -->
		</div>
		<!-- End of Content Wrapper -->
	</div>
	<!-- End of Page Wrapper -->
	<!-- Scroll to Top Button-->

	<!-- Infor User Modal-->
	<?php
		foreach ($users as $user)
		{
	?>
	<div class="modal fade" <?php echo "id='edituser" .$user['u_id']. "Modal'"; ?> tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  	<div class="modal-dialog" role="document">
	  		<form method="post">
		    	<div class="modal-content">
		      		<div class="modal-header">
		        		<h5 class="modal-title" id="exampleModalLabel">User Information</h5>
		        		<button class="close" type="button" data-dismiss="modal" aria-label="Close">
		          			<span aria-hidden="true">×</span>
		        		</button>
		      		</div>
		      		<div class="modal-body">
		      			<div class="table-responsive">
		      				<table class="table">
		      					<tr>
				      				<td>ID</td>
				      				<td>
				      					<input type="text" class="form-control" readonly="readonly" name="id" value="<?php echo $user['u_id']; ?>">
				      				</td>
		      					</tr>
		      					<tr>
			      					<td>Full name</td>
			      					<td>
			      						<input type="text" class="form-control" name="fullname" value="<?php echo $user['u_fullname']; ?>">
			      					</td>
		      					</tr>
		      					<tr>
		      						<td>Gender&emsp;</td>
		      						<td>
		      							<select class="form-control" name="gender">
                            				<option value="Nam">Nam</option>
                            				<option value="Nữ" <?php if ($user['u_gender'] == 'Nữ') echo 'selected'; ?> >Nữ</option>
                        				</select>
                    				</td>
		      					</tr>
		      					<tr>
		      						<td>Email</td>
		      						<td>
		      							<input type="text" class="form-control" name="email" value="<?php echo $user['u_email']; ?>">
		      						</td>
		      					</tr>
		      					<tr>
		      						<td>Phone</td>
		      						<td>
		      							<input type="text" class="form-control" name="phone" value="<?php echo $user['u_phone']; ?>">
		      						</td>
		      					</tr>
		      					<tr>
		      						<td>Address</td>
		      						<td>
		      							<input type="text" class="form-control" name="address" value="<?php echo $user['u_address']; ?>">
		      						</td>
		      					</tr>
		      					<tr>
		      						<td>Hometown</td>
		      						<td>
		      							<input type="text" class="form-control" name="hometown" value="<?php echo $user['u_hometown']; ?>">
		      						</td>
		      					</tr>
		      					<tr>
		      						<td>Login name</td>
		      						<td>
		      							<input type="text" class="form-control" name="loginname" value="<?php echo $user['u_loginname']; ?>" readonly>
		      						</td>
		      					</tr>
		      					<tr>
		      						<td>&emsp;Role</td>
		      						<td>
		      							<select class="form-control" name="role">
		      								<option value="1">Quản trị viên</option>
                            				<option value="2" <?php if ($user['r_id'] == 2) echo 'selected'; ?> >Nhân viên</option>
                        				</select>
		      						</td>
		      					</tr>
		      				</table>
		      			</div>
		      		</div>
		      		<div class="modal-footer">
		      			<input type="submit" class="btn btn-primary" name="edituser" value="Edit">
		        		<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
		      		</div>
		      	</div>
		    </form> 
		</div>
	</div>
	<?php
		}
	?>

	<?php
		include_once("../layout/topbutton.php");
	?>
	<!-- Logout Modal-->
	<?php
		include_once("../layout/logout.php");
	?>
	<?php
		include_once("../layout/script.php");
	?>
	<!-- Page level -->
	<?php
		include_once("../layout/scriptdatatables.php")
	?>
</body>
</html>