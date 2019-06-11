<?php
	include_once("../database.php");

	function get_all_categories()
	{
		global $conn;
		connect_db();
		$sql="select ca_id, ca_name from categories";
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