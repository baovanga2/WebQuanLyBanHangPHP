<?php
    include_once("../session.php");
	include_once("products.php");
	$id = isset($_POST['id']) ? (int)$_POST['id'] : '';
	if ($id)
	{
    	$r=delete_product($id);
    	if ($r)
    	{
    		echo "<script>alert('Delete product {$id} successfully!')</script>";
    	}
    	else
    	{
    		echo "<script>alert('Product {$id} cannot be deleted because there is a order in this product!')</script>";
    	}
    	disconnect_db();
	}
	echo "<script>window.location='product_list.php';</script>";
?>