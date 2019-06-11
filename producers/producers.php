<?php
	include_once("../database.php");

	function get_all_producers()
	{
		global $conn;
		connect_db();
		$sql="select pr_id, pr_name from producers";
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