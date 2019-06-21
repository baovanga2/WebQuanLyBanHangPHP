<?php
	include_once("users.php");
	$id = isset($_POST['id']) ? (int)$_POST['id'] : '';
	if ($id)
	{
    	$r=delete_user($id);
    	if ($r)
    	{
    		echo "<script>alert('Delete user {$id} successfully!')</script>";
    	}
    	else
    	{
    		echo "<script>alert('User {$id} cannot be deleted because there is a order in this user!')</script>";
    	}
    	disconnect_db();
	}
	echo "<script>window.location='user_list.php';</script>";
?>