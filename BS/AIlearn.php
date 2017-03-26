<?php
/**
 * Created by PhpStorm.
 * User: hongyeliang
 * Date: 2017/3/19
 * Time: 下午2:56
 */

include 'login/_include.php';
global $conn;
connectDB();
//Verify token
//loginCheck($_POST['token']);

$block = $_GET ['index'];
$user_name = $_GET ['user_name'];

if($block == 1)
    $query_result = mysqli_query($conn, " UPDATE ai SET sportsnews = sportsnews + 1 where user_name = '$user_name'  ");
else if($block == 2)
    $query_result = mysqli_query($conn, "UPDATE ai SET economynews =economynews + 1  where user_name = '$user_name' ");
else if($block == 3)
    $query_result = mysqli_query($conn, "UPDATE ai SET gamesnews = gamesnews  + 1 where user_name = '$user_name'  ");
else if($block == 4)
    $query_result = mysqli_query($conn, "UPDATE ai SET militarynews =militarynews  + 1 where user_name = '$user_name' ");
else if($block == 5)
    $query_result = mysqli_query($conn, "UPDATE ai SET technologynews = technologynews + 1  where user_name = '$user_name'  ");
else if($block == 6)
    $query_result = mysqli_query($conn, "UPDATE ai SET educationnews = educationnews + 1  where user_name = '$user_name'  ");
else if($block == 7)
    $query_result = mysqli_query($conn, "UPDATE ai SET carnews = carnews + 1  where user_name = '$user_name' ");
else if($block == 8)
    $query_result = mysqli_query($conn, "UPDATE ai SET phonenews = phonenews + 1 where user_name = '$user_name'  ");
else if($block == 9)
    $query_result = mysqli_query($conn, "UPDATE ai SET entertainmentnews = entertainmentnews + 1 where user_name = '$user_name'  ");
else if($block == 10)
    $query_result = mysqli_query($conn, "UPDATE ai SET tournews = tournews  + 1 where user_name = '$user_name' ");
else
    $query_result = mysqli_query($conn, "UPDATE ai SET tournews = tournews  where user_name = '$user_name' ");

$query_result1 = mysqli_query($conn, "select * from ai
                                        where user_name ='$user_name'");

if($fetched = mysqli_fetch_array($query_result1)){
    $result = array(
        "code" => 0,
        "msg" => "修改成功"
    );
    echo json_encode($result,JSON_UNESCAPED_UNICODE);
}
else{
    $result = array(
        "code" => 1,
        "msg" => "修改失败"
    );
    echo json_encode($result,JSON_UNESCAPED_UNICODE);
}
mysqli_close($conn);
?>