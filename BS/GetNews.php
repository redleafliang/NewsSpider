<?php
/**
 * Created by PhpStorm.
 * User: hongyeliang
 * Date: 2017/3/12
 * Time: 下午2:48
 */


//header('Content-type: application/json');
//session_start();
// Connect database
include 'login/_include.php';
global $conn;
connectDB();
//Verify token
//loginCheck($_POST['token']);
$id = $_GET ['id'];

//$query_result = mysqli_query($conn, " select * from test1 where news_id = '$id'   ");


$block = $_GET ['block'];

if($block == 1)
    $query_result = mysqli_query($conn, "select * from sportsnews where news_id = '$id'  ");
else if($block == 2)
    $query_result = mysqli_query($conn, "select * from economynews where news_id = '$id'  ");
else if($block == 3)
    $query_result = mysqli_query($conn, "select * from gamesnews where news_id = '$id'  ");
else if($block == 4)
    $query_result = mysqli_query($conn, "select * from militarynews where news_id = '$id'  ");
else if($block == 5)
    $query_result = mysqli_query($conn, "select * from technologynews where news_id = '$id'  ");
else if($block == 6)
    $query_result = mysqli_query($conn, "select * from educationnews where news_id = '$id'  ");
else if($block == 7)
    $query_result = mysqli_query($conn, "select * from carnews where news_id = '$id'  ");
else if($block == 8)
    $query_result = mysqli_query($conn, "select * from phonenews where news_id = '$id'  ");
else if($block == 9)
    $query_result = mysqli_query($conn, "select * from entertainmentnews where news_id = '$id'  ");
else if($block == 10)
    $query_result = mysqli_query($conn, "select * from tournews where news_id = '$id'  ");
else
    $query_result = mysqli_query($conn, "select * from AllNews where news_id = '$id'  ");

if($query_result)
{
    $fetched = mysqli_fetch_array($query_result);
    $result = array(
        "code" => 0,
        "msg" => "读取成功",
        "res" => array(
            "title" => $fetched['title'],
            "time" => $fetched['time'],
            "contents" => $fetched['content'],
            "type" => $fetched['type']

        )
    );
    echo json_encode($result,JSON_UNESCAPED_UNICODE);
}
else{
    $result = array(
        "code" => 1,
        "msg" => "读取失败",
        "res" => null
    );
    echo json_encode($result,JSON_UNESCAPED_UNICODE);
}
mysqli_close($conn);
?>