<?php 

    include_once("./db_driver.php");
    
    if(isset($_POST['smOrders'])) {
        // Get customer information
        $customerName       = $_POST['customerName'];
        $customerBirthday   = $_POST['customerBirthday'];
        $customerAddress    = $_POST['customerAddress'];
        $customerEmail      = $_POST['customerEmail'];
        $customerPhone      = $_POST['customerPhone'];
        $customerGender = $_POST['customerGender'];
        InsertCustomer($customerName,$customerEmail,$customerAddress,$customerGender,$customerPhone,$customerBirthday);
        
    }
    
    

?>

