<?php
session_start();
if(isset($_SESSION["email"])){
session_destroy();
}
include_once 'dbConnection.php';
$ref=@$_GET['q'];
$email = $_POST['email'];
$password = $_POST['password'];

$password=md5($password); 
$result = mysqli_query($con,"SELECT name,`id` FROM user WHERE email = '$email' and password = '$password'") or die('Error');
// $a = mysqli_fetch_array($result);
// print_r($a);
// exit;
$count=mysqli_num_rows($result);
if($count==1){
while($row = mysqli_fetch_array($result)) {
	$name = $row['name'];
	$id = $row['id'];
}
$_SESSION["id"] = $id;
$_SESSION["name"] = $name;
$_SESSION["email"] = $email;
header("location:account.php?q=1");
}
else
header("location:$ref?w=Wrong Username or Password");
