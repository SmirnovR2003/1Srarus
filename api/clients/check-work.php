<?php 
$link = mysqli_connect("172.18.0.3:3306","root","password", "database");

//валидация
$requestId = $_GET["requestId"];
echo $requestId;
if(!$requestId)
{
    $error = [
        "success" => false,
        "error" => [
            "code" => "100",
            "message" => "Переданы неверные данные"
        ]
        ];
    echo json_encode($error);
    return;
}
echo $requestId;

//запорс
$query = 
$sql = "SELECT * FROM `works` WHERE ID = ?";
$stmt = mysqli_prepare($link, $sql);
mysqli_stmt_bind_param($stmt, "s", $requestId);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_array($result, MYSQLI_NUM);

//ответ
if($row["status"])
{
    $response = [
        "success" => true, 
        "data" => [
            "status" => $row["status"]
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
            "code" => "100",
            "message" => "Переданы неверные данные"
        ]
        ];
    echo json_encode($error);
    return;
}