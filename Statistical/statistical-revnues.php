<!DOCTYPE html>
<html lang="vi">

<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

	<?php
		include_once("../layout/meta_link.php");
	?>
	<!-- Custom styles for this page -->
	<?php
		include_once("../layout/cssdatatables.php")
	?>
	<title>Statistical Revnues</title>
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
      				include("statistical.php");
					  $users = get_all_order();
					  
      				disconnect_db();
      			?>
      			
      			<br>
      			<!-- DataTales Users -->
      			<div class="card shadow mb-4">
      				<div class="card-header py-3">
      					<h6 class="m-0 font-weight-bold text-primary">Revnues List</h6>
      				</div>
      				<div class="card-body">
                      <div class="col-sm-6 col-md-6">
                      <div class="dataTables_length" id="dataTable_length">
						  <?php
					$sql="SELECT * FROM ORDERS WHERE OR_CREATEDDATE >= CURDATE() AND OR_CREATEDDATE < CURDATE() + INTERVAL 1 DAY";
						  ?>
                        <label>Date <input type="date" name="dataTable_length" aria-controls="dataTable"
                                class="custom-input custom-input-sm form-control form-control-sm" 
								value="<?php  ?>" onchange="show_Date(this.value)" >                                
                        </label>
                        
                        <label>Month <select name="dataTable_length" aria-controls="dataTable"
                            class="custom-select custom-select-sm form-control form-control-sm" onchange="show_Month(this.value)">
									<option value=""> All months</option>
                            <?php for( $m=1; $m<=12; ++$m ) { 
                                    $month_label = date('F', mktime(0, 0, 0, $m, 1));
                                    ?>
                                    <option value="<?php echo +$m; ?>"><?php echo $month_label; ?></option>
                                    <?php } ?>
                          </select>
                          
                          
                          
                        </label>
                        
                        <label>Year <select name="dataTable_length" aria-controls="dataTable"
                            class="custom-select custom-select-sm form-control form-control-sm">
                            	<option> Select Year</option>
                            <?php 
                                $year = date('Y');
                                $min = $year - 60;
                                $max = $year;
                                for( $i=$max; $i>=$min; $i-- ) {
                                    echo '<option value='.$i.'>'.$i.'</option>';
                                }
                                ?>
                          </select> 
                        </label>
                      </div>

                    </div>
      					<div class="table-responsive">
      						<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      							<thead>
			                    	<tr>
										            <th>Orders ID</th>
				                      	<th>Customer Name</th>
				                      	<th>Staff Name</th>
				                      	<th>Created Date</th>
										<th>Price</th>
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
		include_once("../layout/scriptdatatables.php");
	?>
</body>
</html>
<script>
function show_Date(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseDate;
            }
        };
        xmlhttp.open("GET","process_orders.php?q="+str,true);
        xmlhttp.send(string);
    }
}
/*--------------------------------------*/
function show_Month(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","process_orders.php?q="+str,true);
        xmlhttp.send();
    }
}

</script>