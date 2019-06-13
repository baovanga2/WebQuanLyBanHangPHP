<?php
	include_once("../session.php");
	include_once("users.php");
	if (isset($_POST['adduser']))
	{
		$gender=$_POST['gender'];
		$birthday=$_POST['birthday'];
		$role=$_POST['role'];
		$errors = array();
		if ($_POST['fullname']=="")
			$errors['fullname']="Full name not entered!";
		else
			$fullname=$_POST['fullname'];

		if ($_POST['email']=="")
			$errors['email']="Email address not entered!";
		else
			$email=$_POST['email'];

		if ($_POST['phone']=="") {
			$errors['phone']="Phone number not entered!";
		} elseif (!phone_avaiable($_POST['phone'])) {
			$errors['phone']="Invalid phone number!";	
		} else {
			$phone=$_POST['phone'];
		}

		if ($_POST['address']=="")
			$errors['address']="Address not entered!";
		else
			$address=$_POST['address'];

		if ($_POST['hometown']=="")
			$errors['hometown']="Hometown not entered!";
		else
			$hometown=$_POST['hometown'];

		if ($_POST['loginname']=="")
			$errors['loginname']="Login name not entered!";
		elseif (loginname_exist($_POST['loginname']))
			$errors['loginname']="Login name exists!";
		else
			$loginname=$_POST['loginname'];

		if ($_POST['password']=="")
			$errors['password']="Password not entered!";
		else
			$password=md5($_POST['password']);

		if (!$errors)
		{
			add_user($fullname, $gender, $email, $phone, $address, $hometown, $birthday, $loginname, $password, $role);
			disconnect_db();
			echo "<script>alert('Add user successfully!')</script>";
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
	<title>User Addition</title>
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
      				<h1 class="h3 mb-2 text-gray-800">Add User</h1>
      				<!-- Form Add User -->
      				<form method="post">
      					<div class="card shadow mb-4">
      						<div class="card-body">
      							<div class="table-responsive">     							
      								<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					      				<tr>
						      				<td>Full name</td>
						      				<td>
						      					<input type="text" class="form-control" name="fullname">
						      					<?php if (!empty($errors['fullname'])) echo "<span style='color:#FF0000;'>{$errors['fullname']}</span>"; ?>
						      				</td>
					      				</tr>
					      				<tr>
					      					<td>Gender</td>
					      					<td>
					      						<select class="form-control" name="gender">
			                            			<option value="Nam">Nam</option>
			                            			<option value="Nữ">Nữ</option>
			                        			</select>
			                    			</td>
					      				</tr>
					      				<tr>
					      					<td>Email</td>
					      					<td>
					      						<input type="text" class="form-control" name="email">
					      						<?php if (!empty($errors['email'])) echo "<span style='color:#FF0000;'>{$errors['email']}</span>"; ?>
					      					</td>
					      				</tr>
					      				<tr>
					      					<td>Phone</td>
					      					<td>
					      						<input type="text" class="form-control" name="phone">
					      						<?php if (!empty($errors['phone'])) echo "<span style='color:#FF0000;'>{$errors['phone']}</span>"; ?>
					      					</td>
					      				</tr>
					      				<tr>
					      					<td>Address</td>
					      					<td>
					      						<input type="text" class="form-control" name="address">
					      						<?php if (!empty($errors['address'])) echo "<span style='color:#FF0000;'>{$errors['address']}</span>"; ?>
					      					</td>
					      				</tr>
					      				<tr>
					      					<td>Hometown</td>
					      					<td>
					      						<input type="text" class="form-control" name="hometown">
					      						<?php if (!empty($errors['hometown'])) echo "<span style='color:#FF0000;'>{$errors['hometown']}</span>"; ?>
					      					</td>
					      				</tr>
					      				<tr>
					      					<td>Birthday</td>
					      					<td>
					      						<input type="date" class="form-control" name="birthday">
					      					</td>
					      				</tr>
					      				<tr>
					      					<td>Login name</td>
					      					<td>
					      						<input type="text" class="form-control" name="loginname">
					      						<?php if (!empty($errors['loginname'])) echo "<span style='color:#FF0000;'>{$errors['loginname']}</span>"; ?>
					      					</td>
					      				</tr>
					      				<tr>
					      					<td>Password</td>
					      					<td>
					      						<input type="password" class="form-control" name="password">
					      						<?php if (!empty($errors['password'])) echo "<span style='color:#FF0000;'>{$errors['password']}</span>"; ?>
					      					</td>
					      				</tr>
					      				<tr>
					      					<td>Role</td>
					      					<td>
					      						<select class="form-control" name="role">
					      							<option value="1">Quản trị viên</option>
			                            			<option value="2">Nhân viên</option>
			                        			</select>
					      					</td>
					      				</tr>
      								</table>
      								<a href="user_list.php" style="float: right;" class="btn btn-secondary">Cancel</a>
      								<input type="submit" style="float: right; margin-right: 10px" class="btn btn-primary" name="adduser" value="Add">
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