<?php
	include_once("../session.php");
	include_once("users.php");
	if (isset($_POST['edituser']))
	{
		$id=$_POST['id'];
		$gender=$_POST['gender'];
		$birthday=$_POST['birthday'];
		$role=$_POST['role'];
		$errors = array();
		if ($_POST['fullname']=="")
			$errors['fullname']="Full name not entered";
		else
			$fullname=$_POST['fullname'];

		if ($_POST['email']=="")
			$errors['email']="Email address not entered";
		else
			$email=$_POST['email'];

		if ($_POST['phone']=="")
			$errors['phone']="Phone number not entered";
		else
			$phone=$_POST['phone'];

		if ($_POST['address']=="")
			$errors['address']="Address not entered";
		else
			$address=$_POST['address'];

		if ($_POST['hometown']=="")
			$errors['hometown']="Hometown not entered";
		else
			$hometown=$_POST['hometown'];

		if (!$errors)
		{
			edit_user($id, $fullname, $gender, $email, $phone, $address, $hometown, $birthday, $role);
			disconnect_db();
			echo "<script>alert('Edit user information successfully!')</script>";
			echo "<script>window.location='user_list.php';</script>";
		}
	}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
	<?php
		include_once("../layout/meta_link.php");
	?>
	<title>User Editing</title>
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
      			<div class="container-fluid">
      				<h1 class="h3 mb-2 text-gray-800">User Information</h1>
      				<!-- Form Infor User -->
      				<?php
      					$id = isset($_GET['id']) ? (int)$_GET['id'] : '';
      					if ($id)
      					{
    						$user = get_user($id);
    						disconnect_db();
						}
      					if (!$user)
      					{
   							echo "<script>window.location='user_list.php';</script>";
						}
      				?>
      				<form method="post">
      					<div class="card shadow mb-4">
      						<div class="card-body">
      							<div class="table-responsive">     							
      								<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
						      					<?php if (!empty($errors['fullname'])) echo "<span style='color:#FF0000;'>{$errors['fullname']}</span>"; ?>
						      				</td>
					      				</tr>
					      				<tr>
					      					<td>Gender</td>
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
					      						<?php if (!empty($errors['email'])) echo "<span style='color:#FF0000;'>{$errors['email']}</span>"; ?>
					      					</td>
					      				</tr>
					      				<tr>
					      					<td>Phone</td>
					      					<td>
					      						<input type="text" class="form-control" name="phone" value="<?php echo $user['u_phone']; ?>">
					      						<?php if (!empty($errors['phone'])) echo "<span style='color:#FF0000;'>{$errors['phone']}</span>"; ?>
					      					</td>
					      				</tr>
					      				<tr>
					      					<td>Address</td>
					      					<td>
					      						<input type="text" class="form-control" name="address" value="<?php echo $user['u_address']; ?>">
					      						<?php if (!empty($errors['address'])) echo "<span style='color:#FF0000;'>{$errors['address']}</span>"; ?>
					      					</td>
					      				</tr>
					      				<tr>
					      					<td>Hometown</td>
					      					<td>
					      						<input type="text" class="form-control" name="hometown" value="<?php echo $user['u_hometown']; ?>">
					      						<?php if (!empty($errors['hometown'])) echo "<span style='color:#FF0000;'>{$errors['hometown']}</span>"; ?>
					      					</td>
					      				</tr>
					      				<tr>
					      					<td>Birthday</td>
					      					<td>
					      						<input type="date" class="form-control" name="birthday" value="<?php echo $user['u_birthday']; ?>">
					      					</td>
					      				</tr>
					      				<tr>
					      					<td>Login name</td>
					      					<td>
					      						<input type="text" class="form-control" name="loginname" value="<?php echo $user['u_loginname']; ?>" readonly>
					      					</td>
					      				</tr>
					      				<tr>
					      					<td>Role</td>
					      					<td>
					      						<select class="form-control" name="role">
					      							<option value="1">Quản trị viên</option>
			                            			<option value="2" <?php if ($user['r_id'] == 2) echo 'selected'; ?> >Nhân viên</option>
			                        			</select>
					      					</td>
					      				</tr>
      								</table>
      								<a href="user_list.php" style="float: right;" class="btn btn-secondary">Cancel</a>
      								<input type="submit" style="float: right; margin-right: 10px" class="btn btn-primary" name="edituser" value="Edit">
      							</div>
      						</div>
      					</div>
      				</form>
      			</div>
      			<!-- End of Page Content -->
      		</div>
      		<!-- End of Main Content -->

      		<?php
      			// Footer
      			include_once("../layout/footer.php");
      		?>
      		<!-- End of Footer -->
		</div>
		<!-- End of Content Wrapper -->
	</div>
	<!-- End of Page Wrapper -->

	<?php
		// Scroll to Top Button
		include_once("../layout/topbutton.php");
		include_once("../layout/script.php");

		// Logout Modal
		include_once("../layout/logout.php");
	?>
</body>
</html>