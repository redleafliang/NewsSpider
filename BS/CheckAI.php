<?php
/**
 * Created by PhpStorm.
 * User: hongyeliang
 * Date: 2017/3/19
 * Time: 下午4:18
 */

include 'login/_include.php';
global $conn;
connectDB();


$user_name = $_GET ['user_name'];
$query_result = mysqli_query($conn, "select * from ai WHERE user_name='$user_name';");
if($query_result){
    $fetched = mysqli_fetch_array($query_result);
    $result = array(
        "code" => 0,
        "msg" => "查找成功",
        "res" => array(
            "entertainment" => $fetched['entertainmentnews'],
            "sports" => $fetched['sportsnews'],
            "economy" => $fetched['economynews'],
            "military" => $fetched['militarynews'],
            "technology" => $fetched['technologynews'],
            "games" => $fetched['gamesnews'],
            "education" => $fetched['educationnews'],
            "phone" => $fetched['phonenews'],
            "tour" => $fetched['tournews'],
            "car" => $fetched['carnews'],
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