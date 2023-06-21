<?php
$link = mysqli_connect("test_project-docker-mysql-1","root","password", "database");

$sql = "UPDATE `works` SET `status` = 'success' WHERE TIMESTAMPDIFF(SECOND,`date`,NOW()) > 60;" .
        "UPDATE `works` SET `status` = 'process' WHERE `status` = 'wait'";
if(!($stmt = mysqli_prepare($link, $sql))) echo "aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa";
mysqli_stmt_execute($stmt);