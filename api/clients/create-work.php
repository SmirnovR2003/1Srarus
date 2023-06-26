<?php
$link = mysqli_connect("mysql","root","password", "database");

//валидация
$workName = $_POST["workName"];
$workId = $_POST["workId"];
if(!$workName || !$workId)
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

//запорс
$date = date("Y-m-d H:i:s");
$defaultStatus = "wait";

$sql = "INSERT into `works` (workId, workName, status, date) value (?, ?, ?, ?);";
$stmt = mysqli_prepare($link, $sql);
mysqli_stmt_bind_param($stmt, "ssss", $workId, $workName, $defaultStatus, $date);
mysqli_stmt_execute($stmt);
$requestId = mysqli_insert_id($link);

//ответ
$response = [
    "success" => true,
    "data" => [
        "requestId" => $requestId,
    ]
    ];
echo json_encode($response);
?>