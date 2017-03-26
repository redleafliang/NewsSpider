<?php
/**
 * Created by PhpStorm.
 * User: hongyeliang
 * Date: 2017/3/13
 * Time: 上午9:24
 */


include 'login/_include.php';
global $conn;
connectDB();
//Verify token
//loginCheck($_POST['token']);

$user_name = $_GET ['user_name'];
$games = $_GET ['games'];
$technology = $_GET ['technology'];
$military = $_GET ['military'];
$economy = $_GET ['economy'];
$sports = $_GET ['sports'];
$entertainment = $_GET ['entertainment'];
$education = $_GET ['education'];
$phone = $_GET ['phone'];
$car = $_GET ['car'];
$tour = $_GET ['tour'];


//print($entertainment);
//print($sports);
//print($economy);
//print($military);

$query_result = mysqli_query($conn, "UPDATE users SET games = '$games' ,
                                                     technology = '$technology' ,                      
                                                     military = '$military' ,                      
                                                     economy = '$economy' ,                                                   
                                                     sports = '$sports',
                                                     entertainment = '$entertainment',
                                                     education = '$education',
                                                     phone = '$phone',
                                                     car = '$car',
                                                     tour = '$tour'                                                                        
                                                     WHERE user_name='$user_name';");
$query_result1 = mysqli_query($conn, "select * from users
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