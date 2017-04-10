<?php

include '_include.php';
global $conn;
connectDB();

$id = test_input(mysqli_escape_string($conn, $_POST['id']));
$password = $_POST['password'];


$password = encrypt($password);


$query_result = mysqli_query($conn, "select * from users 
                                         where user_name ='$id' and password ='$password' limit 1");
if($fetched = mysqli_fetch_array($query_result)){
    $result = array(
        "code" => 0,
        "msg" => "登陆成功",
        "res" => array(
            "user_id" => $id
        )
    );
    echo json_encode($result);

} else {
    $result = array(
        "code" => 1,
        "msg" => "登录失败,用户名或密码错误",
        "res" => array(
            "user_id" => $id
            )
    );
    echo json_encode($result);
}

mysqli_close($conn);
?>