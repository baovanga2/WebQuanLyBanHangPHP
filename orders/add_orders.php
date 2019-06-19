
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
                <div class="container-fluid">
                    <h2 class="h3 mb-2 text-gray-800">Orders</h2>
                    <!-- List of products -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <form action="create_orders.php" method="get">
                                <input type="submit" style="border-radius: 15px;" class="btn btn-primary" value="Create Orders" name="addOrder">
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
                                                <form action="order_products.php" method="GET">
                                                    <td>
                                                        <input type="submit" style="border-radius: 12px;" class="btn btn-outline-primary btn-sm" name="editOrders" value="Edit">
                                                        <input type="submit" style="border-radius: 12px;" class="btn btn-outline-danger btn-sm" name="deleteOrders" value="Delete">
                                                        <input type="hidden" name="ordersID" value="<?php echo $order['OrdersID']; ?>">
                                                        <input type="hidden" name="customerName" value="<?php echo $order['CustomerName']; ?>">
                                                    </td>
                                                </form>
                                                <td><?php echo $order['OrdersID']; ?></td>
                                                <td><?php echo $order['CustomerName']; ?></td>
                                                <td><?php echo $order['CreateDate']; ?></td>
                                                <td><?php echo $order['StaffCreated']; ?></td>

                                            </tr>
                                        <?php } ?>
                                    </tbody>

                                </table>
                            </div>

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