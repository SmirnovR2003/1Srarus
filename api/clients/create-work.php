<?php
$link = mysqli_connect("172.18.0.3:3306","root","password", "database");

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
$sql = "INSERT into works (workId, workName, status) value (?, ?, 0)";
$stmt = mysqli_prepare($link, $sql);
mysqli_stmt_bind_param($stmt, "ss", $workId, $workName);
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