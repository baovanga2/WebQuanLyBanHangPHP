<?php
	include_once("../categories/categories.php");
	$categories=get_all_categories();
	disconnect_db();
	foreach ($categories as $category)
	{
		echo $category['ca_name'];
	}
?>