<?php
	include_once("../users/users.php");
	$roles=get_all_roles();
	foreach ($roles as $role)
	{
		echo $role['r_name'];
	}
?>
