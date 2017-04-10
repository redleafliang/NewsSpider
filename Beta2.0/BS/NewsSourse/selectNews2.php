<?php
/**
 * Created by PhpStorm.
 * User: hongyeliang
 * Date: 2017/3/14
 * Time: 下午1:50
 */
include '../login/_include.php';
global $conn;
connectDB();

$index = $_POST ['index'];

if($index == 1)
    $query_message = mysqli_query($conn, "select * from sportsnews");
else if($index == 2)
    $query_message = mysqli_query($conn, "select * from economynews");
else if($index == 3)
    $query_message = mysqli_query($conn, "select * from gamesnews");
else if($index == 4)
    $query_message = mysqli_query($conn, "select * from militarynews");
else if($index == 5)
    $query_message = mysqli_query($conn, "select * from technologynews");
else if($index == 6)
    $query_message = mysqli_query($conn, "select * from educationnews");
else if($index == 7)
    $query_message = mysqli_query($conn, "select * from carnews");
else if($index == 8)
    $query_message = mysqli_query($conn, "select * from phonenews");
else if($index == 9)
    $query_message = mysqli_query($conn, "select * from entertainmentnews");
else if($index == 10)
    $query_message = mysqli_query($conn, "select * from tournews");




else if($index == 99)
    $query_message = mysqli_query($conn, "select * from AllNews");
//没写呢

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