<form action="" method="post">
    date: <input type="date" name="date" value="">
    <button type="submit">Gửi</button>
</form>
//SELECT * FROM `orderdetails`, orders WHERE orderdetails.or_id = orders.or_id and  `orders`.`OR_CREATEDDATE` = $date(Y-1-d)
<?php if(isset($_POST["date"])) { echo $_POST["date"]; } ?>
