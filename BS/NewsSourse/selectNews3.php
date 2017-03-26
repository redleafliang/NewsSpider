<?php
/**
 * Created by PhpStorm.
 * User: hongyeliang
 * Date: 2017/3/14
 * Time: 下午8:55
 */
include '../login/_include.php';
global $conn;
connectDB();

$block = $_GET ['block'];

if($block == 1)
    $query_message = mysqli_query($conn, "select * from sportsnews WHERE news_id <= 10");
else if($block == 2)
    $query_message = mysqli_query($conn, "select * from economynews WHERE news_id <= 10");
else if($block == 3)
    $query_message = mysqli_query($conn, "select * from gamesnews WHERE news_id <= 10");
else if($block == 4)
    $query_message = mysqli_query($conn, "select * from militarynews WHERE news_id <= 10");
else if($block == 5)
    $query_message = mysqli_query($conn, "select * from technologynews WHERE news_id <= 10");
else if($block == 6)
    $query_message = mysqli_query($conn, "select * from educationnews WHERE news_id <= 10");
else if($block == 7)
    $query_message = mysqli_query($conn, "select * from carnews WHERE news_id <= 10");
else if($block == 8)
    $query_message = mysqli_query($conn, "select * from phonenews WHERE news_id <= 10");
else if($block == 9)
    $query_message = mysqli_query($conn, "select * from entertainmentnews WHERE news_id <= 10");
else if($block == 10)
    $query_message = mysqli_query($conn, "select * from tournews WHERE news_id <= 10");
else
    $query_message = mysqli_query($conn, "select * from AllNews");


if($fetched = mysqli_fetch_array($query_message))
{
    //message(msg_id,content,author,time,msg_state,reply_content)
    $message = array();
    do{
        $message[] = array(
            "news_id" => $fetched['news_id'],
            "title" => $fetched['title'],
            "type" => $fetched['type'],
            "time" => $fetched['time']
        );
    }while($fetched = mysqli_fetch_array($query_message));
    $result = array(
        "code" => 0,
        "msg" => "读取成功",
        "res" => $message
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