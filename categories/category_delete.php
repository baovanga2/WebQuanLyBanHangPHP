<?php
	include_once("categories.php");
	$id = isset($_POST['id']) ? (int)$_POST['id'] : '';
	if ($id)
	{
    	delete_category($id);
	}
	echo "<script>alert('Delete category {$id} successfully!')</script>";
	echo "<script>window.location='category_list.php';</script>";
?>