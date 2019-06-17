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

        input[type=text]:focus,
        input[type=password]:focus {
            background-color: #ddd;
            outline: none;
        }

        input[type=text],
        input[type=password] {
            width: 100%;
            padding: 20px;
            margin: 5px 0 10px 0;
            display: inline-block;
            border: none;
            background: #f1f1f1;
        }

        input[type=date] {
            width: 100%;
            padding: 20x;
            margin: 5px 0 10px 0;
            display: inline-block;
            border: none;
            background: #f1f1f1;
        }

        /* Overwrite default styles of hr */
        .hr-customise {
            border: 1px solid #f1f1f1;
            margin-bottom: 25px;
        }

        /* The container */
        .container {
            display: block;
            position: relative;
            padding-left: 35px;
            margin-bottom: 12px;
            cursor: pointer;
            font-size: 22px;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        /* Hide the browser's default checkbox */
        .container input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }

        /* Create a custom checkbox */
        .checkmark {
            position: absolute;
            top: 0;
            left: 0;
            height: 25px;
            width: 25px;
            background-color: #eee;
        }

        /* On mouse-over, add a grey background color */
        .container:hover input~.checkmark {
            background-color: #ccc;
        }

        /* When the checkbox is checked, add a blue background */
        .container input:checked~.checkmark {
            background-color: #2196F3;
        }

        /* Create the checkmark/indicator (hidden when not checked) */
        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        /* Show the checkmark when checked */
        .container input:checked~.checkmark:after {
            display: block;
        }

        /* Style the checkmark/indicator */
        .container .checkmark:after {
            left: 9px;
            top: 5px;
            width: 5px;
            height: 10px;
            border: solid white;
            border-width: 0 3px 3px 0;
            -webkit-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            transform: rotate(45deg);
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
                $listProducts = ShowProducts();
                disconnect_db();
                ?>
                <div class="container-fluid">
                    <h2 class="h3 mb-2 text-gray-800">Create a new orders</h2>
                    <!-- List of products -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <form action="" method="post">
                                <h4><b>Register</b></h4>
                                <hr class="hr-customise">
                                <div class="table-responsive">
                                    <table lass="table table-bordered" width="50%" cellspacing="10%">
                                        <tr>
                                            <td><b>Customer Name:</b></td>
                                            <td>&emsp;<input type="text" style="border-radius: 15px;" class="form-control" name="customerName" id="" placeholder="Full name"></td>
                                        </tr>
                                        <tr>
                                            <td><b>Birthday:</b></td>
                                            <td>&emsp;<input type="date" style="border-radius: 15px;" class="form-control" name="customerBirthday" id=""></td>
                                        </tr>
                                        <tr>
                                            <td><b>Address:</b></td>
                                            <td>&emsp;<input type="text" style="border-radius: 15px;" class="form-control" name="customerAddress" id="" placeholder="Address"></td>
                                        </tr>
                                        <tr>
                                            <td><b>Email:</b></td>
                                            <td>&emsp;<input type="text" style="border-radius: 15px;" class="form-control" name="customerEmail" id="" placeholder="Email"></td>
                                        </tr>
                                        <tr>
                                            <td><b>Phone:</b></td>
                                            <td>&emsp;<input type="text" style="border-radius: 15px;" class="form-control" name="customerPhone" id="" placeholder="Phone number"></td>
                                        </tr>
                                    </table>
                            </form>
                        </div>

                        <hr class="hr-customise">
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
                                                    <label class="container">
                                                        <input type="checkbox" name="chooseID">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                    <input type="hidden" name="idProduct" value="<?php echo $product['ProductCode']; ?>">
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
                            <br>
                            <form action="" method="get">
                                <button type="submit" class="btn btn-success btn-md btn-block" name="smOrders">Add now!</button>
                            </form>
                            <!-- </form> -->
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