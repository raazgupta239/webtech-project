<?php
    $servername="localhost";
    $username="root";
    $password="";

    $conn=mysqli_connect($servername,$username,$password);
    if($conn){
        echo "connected sucessfully";
    }
    else{
        die ("connection failure" . mysqli_connect_error());
    }
?>