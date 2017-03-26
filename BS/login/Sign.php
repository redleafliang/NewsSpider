<?php
/**
 * Created by PhpStorm.
 * User: hongyeliang
 * Date: 2017/3/12
 * Time: 上午9:41
 */


include '_include.php';
global $conn;
connectDB();

$id = test_input(mysqli_escape_string($conn, $_GET ['id']));
$password = $_GET ['password'];
$user_name = $_GET ['user_name'];

$query_result = mysqli_query($conn, "select * from users 
                                         where user_id ='$id' ");
if($fetched = mysqli_fetch_array($query_result)){
    $result = array(
        "code" => 1,
        "msg" => "注册失败"
    );
    echo json_encode($result);

}
else {



    $query_result1 = mysqli_query($conn, "select * from users 
                                         where user_name ='$user_name' ");
    if($fetched = mysqli_fetch_array($query_result1)){
        $result = array(
            "code" => 2,
            "msg" => "注册失败"
        );
        echo json_encode($result);

    }
    else {

        $query_result2 = mysqli_query($conn,
            "INSERT INTO users (user_id, user_name, password) VALUES ('$id','$user_name','$password');");

        if ($query_result2) {
            $result = array(
                "code" => 0,
                "msg" => "注册成功"
            );
            echo json_encode($result);
        }
    }
}

mysqli_close($conn);
?>