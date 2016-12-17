<?php
$db = mysqli_connect('localhost', 'root', '');
mysqli_select_db($db, 'BrokerFirm');
mysqli_set_charset($db, "utf8");
mysqli_query($db,"set names 'utf8'");
?>
