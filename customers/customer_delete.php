<?php
	include_once("customers.php");
	$id = isset($_POST['id']) ? (int)$_POST['id'] : '';
	if ($id)
	{
    	delete_customer($id);
	}
	echo "<script>alert('Delete customer {$id} successfully!')</script>";
	echo "<script>window.location='customer_list.php';</script>";
?>