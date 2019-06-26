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

	function get_all_order()
	{
		global $conn;
		connect_db();
		$date = getdate();
		
		$sql="SELECT * FROM `orders`, customers, users, orderdetails where orders.cus_id = customers.cus_id and orders.u_id = users.u_id and orderdetails.or_id = orders.or_id and MONTH(orders.OR_CREATEDDATE) =  	month(now())  and YEAR(orders.OR_CREATEDDATE) = year(now()) ";
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