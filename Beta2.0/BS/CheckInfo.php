<?php
/**
 * Created by PhpStorm.
 * User: hongyeliang
 * Date: 2017/3/13
 * Time: 上午10:02
 */

include 'login/_include.php';
global $conn;
connectDB();


$user_name = $_POST ['user_name'];
$query_result = mysqli_query($conn, "select * from users WHERE user_name='$user_name';");
if($query_result){
    $fetched = mysqli_fetch_array($query_result);
    $result = array(
        "code" => 0,
        "msg" => "查找成功",
        "res" => array(
            "entertainment" => $fetched['entertainment'],
            "sports" => $fetched['sports'],
            "economy" => $fetched['economy'],
            "military" => $fetched['military'],
            "technology" => $fetched['technology'],
            "games" => $fetched['games'],
            "education" => $fetched['education'],
            "phone" => $fetched['phone'],
            "tour" => $fetched['tour'],
            "car" => $fetched['car'],
        )
    );
    echo json_encode($result,JSON_UNESCAPED_UNICODE);
}
else{
    $result = array(
        "code" => 1,
        "msg" => "查找失败",
        "res" => null
    );
    echo json_encode($result,JSON_UNESCAPED_UNICODE);
}
mysqli_close($conn);
?>