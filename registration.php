<?php
include 'database.php';

if(isset($_POST['submit'])){
    $uname=$_POST['username'];
    $email=$_POST['email'];
    $pass=$_POST['password'];


    $sql="insert into registration(username,email,password) values('$uname','$email','$pass')";
    if (mysqli_query($con,$sql))
    {
        // echo "sucessfully signed in";
        header("Location:login.php");
    }
    else{
        echo "not connected";
    }
}
?>