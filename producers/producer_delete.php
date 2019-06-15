<?php
	include_once("producers.php");
	$id = isset($_POST['id']) ? (int)$_POST['id'] : '';
	if ($id)
	{
    	delete_producer($id);
	}
	echo "<script>alert('Delete producer {$id} successfully!')</script>";
	echo "<script>window.location='producer_list.php';</script>";
?>