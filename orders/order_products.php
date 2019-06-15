<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once("order_products.php"); ?>
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
                include_once("dbconfig/db_driver.php");
                $listProducts = ShowProducts();
                $listOrderDetails = ShowOrderDetails();
                disconnect_db();
                ?>
                <div class="container-fluid">
                    <h1 class="h3 mb-2 text-gray-800">Choose products</h1>
                
                <!-- List of products -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <!-- <form method="GET"> -->
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Action</th>
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Detail</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    foreach ($listProducts as $product) {
                                        ?>
                                        <tr>
                                            <form id="get-id-product" method="GET">
                                                <td>
                                                    <input type="submit" class="btn btn-outline-primary btn-sm" name="addProduct" value="Add">
                                                    <input type="hidden" name="idProduct" value="<?php echo $product['pro_id']; ?>">
                                                </td>
                                                <td><?php echo $product['pro_id']; ?></td>
                                                <td><?php echo $product['pro_name']; ?></td>
                                                <td><?php echo $product['ca_name']; ?></td>
                                                <td><?php echo $product['pro_quantity']; ?></td>
                                                <td><?php echo $product['pro_price']; ?></td>
                                                <td><?php echo $product['pro_detail']; ?></td>
                                            </form>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <!-- </form> -->
                        </div>
                    </div>

                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <table>
                                <tr>
                                    <th>Order ID: #1012</th>
                                    <th>&emsp;&emsp;Customer Name: Pham Hoang Vien</th>
                                </tr>
                            </table>
                        </h6>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Delete</th>
                                        <th>NumericalOrder</th>
                                        <th>ProductName</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($listOrderDetails as $orderDetails) {
                                        ?>
                                        <tr>
                                            <td><a href="delete"><i class="far fa-trash-alt"></i></a></td>
                                            <td>1</td>
                                            <td><?php echo $orderDetails['ProductName']; ?></td>
                                            <td><input value="1" type="number" class="btn" name="quantity" min="1" size="10px"></td>
                                            <td><?php echo $orderDetails['Price']; ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <!-- thanh toán tiền -->
                            <table style="border:0px; float: right; margin-right: 10px">
                                <tr>
                                    <th colspan="4">Money Received :</th>
                                    <th colspan="3"><input style="text-align:right; width:100%" class="btn" type="number" name="" value="1,000,000"></th>
                                </tr>
                                <tr>
                                    <th colspan="4">Total Amount: </th>
                                    <th style="text-align: right;" colspan="3">800,000đ</th>
                                </tr>
                                <tr>
                                    <th colspan="4">Excess Cash: </th>
                                    <th style="text-align: right;" colspan="3">200,000đ</th>
                                </tr>
                                <tr>
                                    <th colspan="7"> <input style="float: right;" type="submit" class="btn btn-primary" value="Thanh toán"></th>
                                </tr>
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