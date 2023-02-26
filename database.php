<?php
$servername="localhost";
$username="root";
$password="";
$database="signup";

$conn=mysqli_connect($servername,$username,$password,$database);

if($conn){
    // echo "database connected sucessfully";
}
 else{
    die("database not connected" . mysqli_error($con));
 }
?>
