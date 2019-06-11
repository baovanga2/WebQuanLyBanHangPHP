<?php
	include_once("../database.php");

	function get_all_customers()
	{
		global $conn;
		connect_db();
		$sql="select cus_id, cus_fullname, cus_email, cus_phone, cus_gender from customers";
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