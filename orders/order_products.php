<?php
include_once("dbconfig/db_driver.php");
if (isset($_GET['deleteOrders'])) {
    $ordersID = $_GET['ordersID'];
    DeleteOrders($ordersID);
    header("Location:http://localhost/WebQuanLyBanHangPHP/orders/add_orders.php");
    disconnect_db();
}

if (isset($_GET['editOrders'])) {
    $ordersID = $_GET['ordersID'];
    $customerName = $_GET['customerName'];
    $listOrderDetails = ShowOrderDetails($ordersID);
}

?>

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
            background-color: #668cff;
            border: none;
            color: white;
            padding: 8px 12px;
            font-size: 12px;
            cursor: pointer;
            border-radius: 12px;
        }
        .btn-delete {
            background-color: #ff4d4d;
            border: none;
            color: white;
            padding: 8px 12px;
            font-size: 12px;
            cursor: pointer;
            border-radius: 12px;
        }

        /* Darker background on mouse-over */
        .btn:hover {
            background-color: #3366ff;
        }

        .btn-delete:hover {
            background-color: #ff0000;
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
                // $listOrderDetails = ShowOrderDetails($ordersID);
                disconnect_db();
                ?>
                <div class="container-fluid">
                    <h1 class="h3 mb-2 text-gray-800">Choose Product</h1>

                    <!-- List of products -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <!-- <form method="GET"> -->
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Action</th>
                                            <th>ProductCode</th>
                                            <th>ProductName</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Details</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        foreach ($listProducts as $product) {
                                            ?>
                                            <tr>
                                                <form id="get-id-product" method="GET">
                                                    <td>
                                                        <!-- <input type="submit" class="btn btn-outline-primary btn-sm" name="addProduct" value="Add"> -->
                                                        <button type="submit" class="btn"><i class="fas fa-plus"></i></button>
                                                        <input type="hidden" name="productID" value="<?php echo $product['ProductCode']; ?>">
                                                    </td>
                                                    <td><?php echo $product['ProductCode']; ?></td>
                                                    <td><?php echo $product['ProductName']; ?></td>
                                                    <td><?php echo $product['Quantity']; ?></td>
                                                    <td><?php echo $product['Price']; ?> VND</td>
                                                    <td><?php echo $product['Details']; ?></td>
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
                                        <th>Order ID: <?php echo $ordersID ?></th>
                                        <th>&emsp;&emsp;Customer Name: <?php echo $customerName ?></th>
                                    </tr>
                                </table>
                            </h6>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Action</th>
                                            <th>NumericalOrder</th>
                                            <th>ProductName</th>
                                            <th>Quantity</th>
                                            <th>PriceEachItem</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($listOrderDetails as $orderDetails) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <!-- <input type="submit" class="btn btn-outline-danger btn-sm" name="delProduct" value="Delete"> -->
                                                    <button type="submit" class="btn-delete"><i class="fa fa-trash"></i></button>
                                                <td>1</td>
                                                <td><?php echo $orderDetails['ProductName']; ?></td>
                                                <td><input value="<?php echo $orderDetails['Quantity']; ?>" type="number" class="btn" name="quantity" min="1" size="10px"></td>
                                                <td><?php echo number_format($orderDetails['Price']); ?> VND</td>
                                                <?php $total += $orderDetails['Price']; ?>
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
                                        <th colspan="4">Total: </th>
                                        <th style="text-align: right;" colspan="3"><?php echo number_format($total); ?> VND</th>
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