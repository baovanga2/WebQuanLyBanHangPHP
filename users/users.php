<?php
	include_once("../database.php");

	function user_exist($username, $password)
  	{
    	global $conn;
    	connect_db();
    	$sql="select * from users where u_loginname='$username' and u_password='$password'";
    	$query=mysqli_query($conn, $sql);
    	if (mysqli_num_rows($query)==0)
    	{
      	return false;
    	}
    	else
    	{
      	return true;
    	}
	}

	function get_all_users()
	{
		global $conn;
		connect_db();
		$sql="select u_id, u_fullname, u_email, u_phone, u_gender, r_name from users, roles where users.r_id = roles.r_id";
		$query=mysqli_query($conn, $sql);
		$result=array();
		if ($query)
		{
			while ($row=mysqli_fetch_assoc($query))
			{
				$result[]=$row;
			}
		}
		return $result;
	}

?>