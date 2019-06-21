<?php
	include_once("producers.php");
	$id = isset($_POST['id']) ? (int)$_POST['id'] : '';
	if ($id)
	{
    	$r=delete_producer($id);
    	if ($r)
    	{
    		echo "<script>alert('Delete producer {$id} successfully!')</script>";
    	}
    	else
    	{
    		echo "<script>alert('Producer {$id} cannot be deleted because there is a product in this producer!')</script>";
    	}
    	disconnect_db();
	}
	echo "<script>window.location='producer_list.php';</script>";
?>