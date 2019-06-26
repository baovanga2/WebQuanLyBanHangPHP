<?php
	include_once("users.php");
	$id = isset($_POST['id']) ? (int)$_POST['id'] : '';
	if ($id)
	{
    	delete_user($id);
	}
	echo "<script>alert('Delete user {$id} successfully!')</script>";
	echo "<script>window.location='user_list.php';</script>";
?>