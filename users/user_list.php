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
	<title>User Management</title>
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
										<th>Role</th>
									</tr>
								</thead>
								<tfoot>
									<tr>
										<th>ID</th>
										<th>Full name</th>
										<th>Email</th>
										<th>Phone</th>
										<th>Gender</th>
										<th>Role</th>
									</tr>
								</tfoot>
								<tbody>
									<?php
									foreach ($users as $user) {
										?>
										<tr>
											<td><?php echo $user['u_id']; ?></td>
											<td><?php echo $user['u_fullname']; ?></td>
											<td><?php echo $user['u_email']; ?></td>
											<td><?php echo $user['u_phone']; ?></td>
											<td><?php echo $user['u_gender']; ?></td>
											<td><?php echo $user['r_name']; ?></td>
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