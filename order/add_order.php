<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once("../layout/meta_link.php"); ?>
    <?php include_once("../layout/cssdatatables.php"); ?>
    <title>Order Products</title>
    <style>
        input[type=number] {
            width: 80px;
            background-color: #e4e6e7;
            color: black
        }
    </style>
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <?php include_once("../layout/sidebar.php"); ?>
        <!-- End sidebar -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main content -->
            <div id="content">
                <!-- Topbar  -->
                <?php include_once("../layout/topbar.php"); ?>
                <!-- End of topbar -->
                <!-- Begin page content -->
                <?php
                include("dbconfig/db_driver.php");
                $listOrders = ShowOrders();
                disconnect_db();
                ?>

                <!-- List of products -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Add Order</h6>
                    </div>

                    <div class="card-body">
                        <form action="" method="post">

                            <!-- <input type="text" name="customerName" placeholder="Customer name"> -->
                            <input type="submit" class="btn btn-primary" value="Add Orders" name="addOrder">

                        </form>
                    </div>

                    <div class="card-body">

                        <div class="table-responsive">

                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>OrderID</th>
                                        <th>CustomerName</th>
                                        <th>CreateDate</th>
                                        <th>StaffCreated</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($listOrders as $order) { ?>
                                        <tr>
                                            <form action="dbconfig/btn_delete_order.php" method="GET">
                                                <td>
                                                    <input type="submit" class="btn btn-outline-primary btn-sm" name="addOrder" value="Edit">
                                                    <input type="submit" class="btn btn-outline-danger btn-sm" name="deleteOrder" value="Delete">
                                                    <input type="hidden" name="idOrder" value="<?php echo $order['OrderID']; ?>">
                                                </td>
                                                <td><?php echo $order['OrderID']; ?></td>
                                                <td><?php echo $order['CustomerName']; ?></td>
                                                <td><?php echo $order['CreateDate']; ?></td>
                                                <td><?php echo $order['StaffCreated']; ?></td>

                                            </form>

                                        </tr>
                                    <?php } ?>
                                </tbody>

                            </table>
                        </div>

                    </div>
                </div>
                <!-- End of list of products -->
            </div>
            <!-- End of main content -->
            <!-- Footer -->
            <?php include_once("../layout/footer.php"); ?>
            <!-- End of footer -->
        </div>
        <!-- End of page wrapper -->

        <!-- Scroll to top button -->
        <?php include_once("../layout/topbutton.php"); ?>
        <?php include_once("../layout/script.php"); ?>
        <?php include_once("../layout/scriptdatatables.php"); ?>

    </div>
</body>

</html>