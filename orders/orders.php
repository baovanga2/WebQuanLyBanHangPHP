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

        .btn {
            border: 0px solid #c2d6d6;
            background-color: white;
            color: black;
            padding: 8px 10px;
            font-size: 16px;
            cursor: pointer;
        }

        .btn-new {
            border: 0px solid #c2d6d6;
            background-color: #ffcc99;
            color: black;
            padding: 8px 10px;
            font-size: 16px;
            cursor: pointer;
        }


        .btn-add {
            border: 0px solid #c2d6d6;
            background-color: #66a3ff;
            color: black;
            padding: 6px 10px;
            font-size: 16px;
            cursor: pointer;
        }

        .btn-delete {
            border: 0px solid #c2d6d6;
            background-color: #ffcccc;
            color: black;
            padding: 6px 12px;
            font-size: 16px;
            cursor: pointer;
        }

        .btn-add:hover {
            background-color: #3366ff;
            color: white;
        }

        /* Blue */
        .btn-info {
            border-color: #2196F3;
            color: dodgerblue
        }

        .btn-info:hover {
            background: #2196F3;
            color: white;
        }

        /* Gray */
        .btn-default {
            border-color: #ccccff;
            color: black;
        }

        .btn-default:hover {
            background: #ff9900;
            color: white;
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
                include("dbconfig/db-driver.php");
                $listOrders = show_orders();
                disconnect_db();
                ?>
                <div class="container-fluid">
                    <h2 class="h3 mb-2 text-gray-800">Order Management</h2>
                    <!-- List of products -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <form action="create-orders.php" method="get">
                                <!-- <input type="submit" style="border-radius: 15px;" class="btn btn-primary" value="Create new" name="createNew"> -->
                                <button type="submit" style="border-radius: 100px;" class="btn btn-new btn-default" name="createNew">
                                    <img src="./imgs/cart.png" /> New 
                                </button>
                            </form>
                        </div>

                        <div class="card-body">

                            <div class="table-responsive">

                                <table class="table table-hover table-sm" id="dataTable" width="100%" cellspacing="0">

                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Action</th>
                                            <th>CodeOrders</th>
                                            <th>CustomerName</th>
                                            <th>CreateDate</th>
                                            <th>StaffCreated</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($listOrders as $order) { ?>
                                            <tr>
                                                <form action="edit-cart.php" method="GET">
                                                    <td>
                                                        <!-- <input type="submit" style="border-radius: 12px;" class="btn-add btn-outline-primary btn-sm" name="editOrders" value="Edit"> -->

                                                        <button type="submit" style="border-radius: 12px;" class="btn btn-add btn-outline-primary btn-sm" name="editOrders">
                                                            <img src="./imgs/edit.png">
                                                        </button>

                                                        <button type="submit" style="border-radius: 12px;" class="btn btn-delete btn-outline-danger btn-sm" name="deleteOrders">
                                                            <img src="./imgs/delete.png">
                                                        </button>

                                                        <!-- <input type="submit" style="border-radius: 12px;" class="btn-delete btn-outline-danger btn-sm" name="deleteOrders" value="Delete"> -->
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