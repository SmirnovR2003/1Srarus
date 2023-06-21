<?php 
$link = mysqli_connect("test_project-docker-mysql-1","root","password", "database");

//валидация
$requestId = $_GET['requestId'];
$requestId = $_POST['requestId'];

if(!isset($requestId))
{
    $error = [ 
        "success" => false,
        "error" => [
            "code" => "1001",
            "message" => "Переданы неверные данные"
        ]
        ];
    echo json_encode($error);
    return;
}

//запорс
$sql = "SELECT * FROM `works` WHERE ID = ?";
$stmt = mysqli_prepare($link, $sql);
mysqli_stmt_bind_param($stmt, "s", $requestId);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_array($result, MYSQLI_NUM);

//ответ
if($row[0])
{
    $response = [
        "success" => true, 
        "data" => [
            "status" => $row[3]
        ]
        ];
    echo json_encode($response);
    return;
}
else
{
    $error = [
        "success" => false,
        "error" => [
            "code" => "1002",
            "message" => "Переданы неверные данные"
        ]
        ];
    echo json_encode($error);
    return;
}