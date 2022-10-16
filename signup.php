<?php


$db="projec10_projectdb";
$dbuser="projec10_hamidreza";
$dbpassword="owrBeRvGV3br";
$dbhost="localhost";



$return["error"]=false;
$return["message"]="";
$link=mysqli_connect($dbhost,$dbuser,$dbpassword,$db);

$val=isset($_POST["username"]) && isset($_POST["password"]);

if($val){
$username=$_POST["username"];
$password=$_POST["password"];
if(strlen($username)!=11){
    $return["error"]=true;
    $return["message"]="لطفا شماره موبایل خود را کامل وارد نمایید";
}

//add new filter


$check="SELECT * FROM users WHERE username='$username'";
$result_check=mysqli_query($link,$check);
if(mysqli_num_rows($result_check)>0){
    $return["error"]=true;
    $return["message"]="کاربری با این شماره موبایل وجود دارد";
}
//insert user table
if($return["error"]==false){
    $username=mysqli_real_escape_string($link,$username);
    $password=mysqli_real_escape_string($link,$username);

    $sql="INSERT INTO users SET username='$username' , pass='$password' ";
    $res=mysqli_query($link,$sql);
    if($res){
        $return["error"]=false;
        $return["message"]="ثبت نام با موفقیت انجام شد";
    }
    else{
        $return["error"]=true;
        $return["message"]="خطایی در ارتباط با سرور رخ داده است";
    }

}


}
else{
$return["error"]=true;
$return["message"]="طلاعاتی به سمت سرور ارسال نشده است مجدد تلاش کنید";

}


mysqli_close($link);
header('Content-Type : application/json')
echo json_encode($return);






?>
