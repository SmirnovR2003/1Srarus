<?php
$link = mysqli_connect("mysql","root","password", "database");

$sql = "UPDATE `works` SET `status` = 'success' WHERE TIMESTAMPDIFF(SECOND, `date`, NOW()) > 300;";
$stmt = mysqli_prepare($link, $sql);
mysqli_stmt_execute($stmt);

$sql = "UPDATE `works` SET `status` = 'process' WHERE `status` = 'wait'";
$stmt = mysqli_prepare($link, $sql);
mysqli_stmt_execute($stmt);