<?php
function db_connect(){
$host='localhost';
$username='root';
$password='';
$db_name='book_shop_db';
$conn=mysqli_connect($host,$username,$password,$db_name);
if(!$conn){
    die('failed to connect database.'.mysqli_connect_error());
    exit;
}
return $conn;
}