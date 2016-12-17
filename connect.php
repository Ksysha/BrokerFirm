<?php
$db = mysqli_connect('localhost', 'root', 'grddron1995');
mysqli_select_db($db, 'graz');
mysqli_set_charset($db, "utf8");
mysqli_query($db,"set names 'utf8'");