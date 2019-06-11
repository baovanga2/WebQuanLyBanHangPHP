<?php
	include_once("../database.php");

	function loginname_exist($loginname)
  	{
    	global $conn;
    	connect_db();
    	$sql="select * from users where u_loginname='$loginname'";
    	$query=mysqli_query($conn, $sql);
    	if (mysqli_num_rows($query)==0)
    	{
      		$bool=false;
    	}
    	else
    	{
      		$bool=true;
    	}
    	return $bool;
	}

	function password_true($loginname, $password)
	{
		global $conn;
		connect_db();
		$sql="select * from users where u_loginname='$loginname' and u_password='$password'";
		$query=mysqli_query($conn, $sql);
		if (mysqli_num_rows($query)==0)
    	{
      		$bool=false;
    	}
    	else
    	{
      		$bool=true;
    	}
    	return $bool;
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