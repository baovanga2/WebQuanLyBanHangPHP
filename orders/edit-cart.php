<?php

include_once("dbconfig/db-driver.php");
// Get data orders ID and Customer name from orders.php
if (isset($_GET['editOrders'])) {
    header("Location:http://localhost/WebQuanLyBanHangPHP/orders/edit-cart.php");
    $ordersID = $_GET['ordersID'];
    setcookie("ordersID", "$ordersID", time() + 7200);
    $customerName = $_GET['customerName'];
    setcookie("customerName", "$customerName", time() + 7200);
    $ordersID = $_COOKIE['ordersID'];
}

$customerName = $_COOKIE['customerName'];
$ordersID = $_COOKIE['ordersID'];
$listOrderDetails = show_order_details($ordersID);

// Delete an orders from orders.php
if (isset($_GET['deleteOrders'])) {
    // $ordersID = $_GET['ordersID'];
    // $productID = $_GET['productID'];
    // $quantity = $_GET['quantity'];
    // Delete a product in orders
    $getNumProduct = get_num_products($ordersID);
    foreach ($getNumProduct as $value) {
        $productID = $value['ProductID'];
        $quantity = $value['Quantity'];

        if (!empty($ordersID && $productID && $quantity)) {
            delete_orders($ordersID, $productID, $quantity);
            echo "<script>window.location='orders.php';</script>";
        } else {
            echo "<script>alert('Deleting the cart failed!');</script>";
            echo "<script>window.location='orders.php';</script>";
        }
    }
    disconnect_db();
}

// Insert the product into the orderdetails table
if (isset($_GET['addProduct'])) {
    $quantity = $_GET['quantity'];
    if ($quantity == '0') {
        echo "<script style=\"text/javascript\">";
        echo "alert('In stock products is not enough')";
        echo "</script>";
    } else {
        header("Location:http://localhost/WebQuanLyBanHangPHP/orders/edit-cart.php");
        $productID = $_GET['productID'];
        insert_order_details($productID, $ordersID);
        // update_quantity_add($productID);
    }
}

// Delete existing record in a orderdetails table
if (isset($_GET['deleteRecord'])) {
    $quantity = $_GET['quantity'];
    $productID = $_GET['productID'];
    delete_product($productID, $ordersID, $quantity);
    header("Location:http://localhost/WebQuanLyBanHangPHP/orders/edit-cart.php");
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once("../layout/meta_link.php"); ?>
    <?php include_once("../layout/cssdatatables.php"); ?>
    <link rel="shortcut icon" type="image/png" href="./imgs/cart-icon.png" />
    <title>Order Products | Edit orders</title>
    <style>
        input[type=number] {
            width: 80px;
            background-color: #e4e6e7;
            color: black
        }

        .btn-add {
            background-color: #668cff;
            border: none;
            color: white;
            padding: 8px 12px;
            font-size: 12px;
            cursor: pointer;
            border-radius: 12px;
        }

        .btn-delete {
            background-color: #ff6666;
            border: none;
            color: white;
            padding: 8px 12px;
            font-size: 12px;
            cursor: pointer;
            border-radius: 12px;
        }

        .btn-delete-order {
            border: 0px solid #c2d6d6;
            background-color: #ffcccc;
            color: gray;
            padding: 6px 10px;
            font-size: 16px;
            cursor: pointer;
        }

        .btn-update {
            background-color: #ffa366;
            border: none;
            color: white;
            padding: 8px 12px;
            font-size: 12px;
            cursor: pointer;
            border-radius: 12px;
        }

        /* Darker background on mouse-over */
        .btn-add:hover {
            background-color: #3366ff;
        }

        .btn-delete:hover {
            background-color: #ff0000;
        }

        .btn-update:hover {
            background-color: #ff6600;
        }
    </style>
    <script style="text/javascript">
        function notification() {
            $('#notification').modal()
        }
        notification();
    </script>
</head>

<body id="page-top">
    <!-- Begin modal -->
    <div class="modal" tabindex="-1" role="dialog" id="notification">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Notification!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Products are out of stock, please choose another product!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Eng modal -->
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
                include_once("dbconfig/db-driver.php");
                $listProducts = show_products();
                // $listOrderDetails = ShowOrderDetails($ordersID);
                disconnect_db();
                ?>
                <div class="container-fluid">

                    <h1 class="h3 mb-2 text-gray-800"><img src="./imgs/edit.png"><strong> Edit orders </strong></h1>

                    <!-- List of products -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <!-- <table style="border:0px; float: left; margin-right: 10px" class="table table-borderless">
                                    <th colspan="4">
                                        <a href="./orders.php">
                                            <button type="submit" style="" class="btn btn-light" name="back">
                                                <img src="./imgs/back.png"> Back
                                            </button>
                                        </a>
                                    </th>

                                    <th colspan="5">
                                        <a href="../home/homepage.php">
                                            <button type="submit" style="float: right" class="btn btn-light" name="homepage">
                                                <img src="./imgs/homepage.png"> Homepage
                                            </button>
                                        </a>
                                    </th>
                                </table> -->
                            <a href="./orders.php">
                                <button type="submit" style="border-radius: 50px;" class="btn btn-light" name="back">
                                    <img src="./imgs/back.png"> Back
                                </button>
                            </a>
                            <hr>
                            <div class="table-responsive">
                                <!-- <form method="GET"> -->
                                <table class="table table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="thead-dark">
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
                                                        <button type="submit" class="btn-add" name="addProduct"><i class="fas fa-plus"></i> Add</button>
                                                        <input type="hidden" name="productID" value="<?php echo $product['ProductCode']; ?>">
                                                    </td>
                                                    <td><?php echo $product['ProductCode']; ?></td>
                                                    <td><?php echo $product['ProductName']; ?></td>
                                                    <td>
                                                        <?php echo $product['Quantity']; ?>
                                                        <input type="hidden" name="quantity" value="<?php echo $product['Quantity']; ?>">
                                                    </td>
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
                                        <form action="#" method="GET">
                                        <th>
                                            <button type="submit" style="border-radius: 12px;" class="btn btn-delete-order btn-outline-danger btn-sm" name="deleteOrders">
                                                <img src="./imgs/trash.png"> Delete order
                                            </button>
                                        </th>
                                        </form>
                                        <th>&emsp;&emsp;Code Orders: <?php echo "#$ordersID" ?></th>
                                        <th>&emsp;&emsp;Customer's Name: <?php echo $customerName ?></th>
                                    </tr>
                                </table>
                            </h6>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Action</th>
                                            <th>NumericalOrder</th>
                                            <th>ProductName</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>TotalPrice</th>
                                            <th>UpdateQuantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (empty($listOrderDetails)) { ?>
                                            <div class="alert alert-warning">
                                                <strong>Cart is empty!</strong>
                                            </div>
                                        <?php
                                    } else {
                                        foreach ($listOrderDetails as $key => $orderDetails) {
                                            ?>
                                                <tr>
                                                    <form method="GET">
                                                        <td>
                                                            <!-- <input type="submit" class="btn btn-outline-danger btn-sm" name="delProduct" value="Delete"> -->
                                                            <button type="submit" class="btn-delete" name="deleteRecord"><i class="fa fa-trash"></i> Delete</button>
                                                            <input type="hidden" name="productID" value="<?php echo $orderDetails['ProductCode']; ?>">
                                                        </td>
                                                        <td><?php echo $key + 1; ?></td>
                                                        <td><?php echo $orderDetails['ProductName']; ?></td>
                                                        <td><input value="<?php echo $orderDetails['Quantity']; ?>" type="number" class="btn" name="quantity" min="1" size="10px"></td>
                                                        <td><?php echo number_format($orderDetails['Price']); ?> VND</td>
                                                        <td><?php echo number_format($orderDetails['TotalPrice']); ?> VND</td>
                                                        <td style="float: right;">
                                                            <button type="submit" class="btn-update" name="updateQuantity">
                                                                <i style='font-size:14px' class='fas'>&#xf044;</i> Update
                                                            </button>
                                                        </td>
                                                        <?php $total += $orderDetails['TotalPrice']; ?>
                                                    </form>
                                                </tr>
                                            <?php } ?>
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