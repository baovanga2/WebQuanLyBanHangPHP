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
	<title>Thống kê đơn hàng</title>
</head>
<body id="page-top">
	<!-- Page Wrapper -->
	<div id="wrapper" >
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
      				include("orders.php");
					  $users = get_all_order();
      				disconnect_db();
      			?>
      			<div class="container-fluid">
      				<a href="#" class="btn btn-success btn-icon-split">
                    	<span class="text">Add order</span>
                  	</a>
      			</div>
      			<br>
      			<!-- DataTales Users -->
      			<div class="card shadow mb-4">
      				<div class="card-header py-3">
      					<h6 class="m-0 font-weight-bold text-primary">Order List</h6>
      				</div>
      				<div class="card-body">
      					<div class="table-responsive">
      						<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      							<thead>
			                    	<tr>
										<th>ORDER ID</th>
				                      	<th>CUSTOMER ID</th>
				                      	<th>USER ID</th>
				                      	<th>OR_CREATEDDATE</th>
										<th>OD PRICE</th>
										<th>DELETE</th>
			                    	</tr>
				                </thead>
				                
				                <tbody>
				                	<?php
				                		foreach ($users as $user)
				                		{
				                	?>
				                	<tr>
				                		<td><?php echo $user['OR_ID']; ?></td>
				                		<td><?php echo $user['CUS_FULLNAME']; ?></td>
				                		<td><?php echo $user['U_FULLNAME']; ?></td>
										<td><?php
											$date=date_create($user['OR_CREATEDDATE']);
											echo date_format($date,"s:i:H-d/m/Y");
											// echo $user['OR_CREATEDDATE'];?></td>
										<td><?php echo $user['OD_PRICE'];?></td>
										<td align="center">
											<a href="../orders/view_orders.php?OR_ID=<?php echo $user['OR_ID'] ?> "onclick = "return deleteConfirm()"> 
											 <i class="far fa-trash-alt"></i> </a>
										</td>
									</tr>
									
									<?php
										
				                		}
				                	?>
									<?php  
											// include_once("../database.php");
											$conn = mysqli_connect('localhost', 'root', '', 'webquanlybanhang') or die ('Can not connect to database');
											 if(isset($_GET['OR_ID'])) {
												$OR_ID = $_GET['OR_ID'];											
												$sql = "DELETE FROM ORDERDETAILS WHERE OR_ID = $OR_ID";											
												$conn->query($sql);
															 echo "<script>
															 	window.location = '../orders/view_orders.php';
															 </script>";

											 //echo '<meta http-equiv="refresh" content="0;URL=../orders/view_orders.php"/>';
											/*--------delete----------*/

											 }else{
												 $OR_ID = null;
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
		include_once("../layout/scriptdatatables.php");
	?>
</body>
</html>
<script>
    function deleteConfirm(){
        if(confirm("Bạn có chắc chắn muốn xóa!")){
            return true;
			// tuyetdoi();
        }
        else{
            return false;
        }
    }
	// function tuyetdoi(){
	// 	window.location.reload();
    //         //location.href = "../orders/view_orders.php";
    //     }
	
</script>