<?php 
session_start();
if(!isset($_POST['submit'])){
    echo "something goes wrong!";
exit;

}
// require_once("../config/db.php");
// $conn=db_connect();

$email = trim($_POST["email"]);
$password = trim($_POST["password"]);

$admin_email="admin@gmail.com";
$admin_password= "admin";

// $name=mysqli_real_escape_string($conn,$email);
// $password=mysqli_real_escape_string($conn,$password);

if($email !== "$admin_email"&& $password !== "$admin_password")  {
echo "email and password does not match";
$_SESSION['admin']=false;
exit;
}else{
    $_SESSION['admin']=true;
    header("Location:admin_book.php");
}
?>