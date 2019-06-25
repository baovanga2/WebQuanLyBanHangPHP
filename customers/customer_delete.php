<?php
    include_once("../session.php");
	include_once("customers.php");
	$id = isset($_POST['id']) ? (int)$_POST['id'] : '';
	if ($id)
	{
    	$r=delete_customer($id);
    	if ($r)
    	{
    		echo "<script>alert('Delete customer {$id} successfully!')</script>";
    	}
    	else
    	{
    		echo "<script>alert('Customer {$id} cannot be deleted because there is a order in this customer!')</script>";
    	}
    	disconnect_db();
	}	
	echo "<script>window.location='customer_list.php';</script>";
?>