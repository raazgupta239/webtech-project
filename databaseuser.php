<?php
$servername="localhost";
$username="root";
$password="";
$database="login";

$conn=mysqli_connect($servername,$username,$password,$database);

if($conn){
    // echo "database login connected sucessfully";
}
 else{
    die("database not connected" . mysqli_error($con));
 }
?>
