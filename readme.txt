<?php
    $name = $email = $phone = $pass = $cpass = "";
    $Nameerr = $Emailerr = $Phoneerr = $Passworderr = $CPassworderr = "";
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        //Name validation
        if (empty($_POST['username'])) {
            $Nameerr = "Name cant be empty";
        } else {
            $name = input_data($_POST['username']);
            if (!preg_match('/^(?=.{5,10}$)(?!.*[._-]{2})[a-z][a-z0-9._-]*[a-z0-9]$/',$name)) {
                $Nameerr = "name format should be matched";
            }
        }
        //Email validation
        if (empty($_POST['email'])) {
            $Emailerr = "Email cant be empty";
        } else {
            $email = input_data($_POST["email"]);
            if (!preg_match('/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/', $email)) {
                $Emailerr =  "email format should be matched";
            }
        }
        if (empty($_POST['password'])) {
            $Passworderr = "Password  cant be empty";
        } else {
            $pass = input_data($_POST['password']);
            if (!preg_match('/^\S*(?=\S{6,})(?=\S*\d)(?=\S*[A-Z])(?=\S*[a-z])(?=\S*[!@#$%^&*? ])\S*$/', $pass)) {
                $Passworderr = "Password format should be matched";
            }
        }
        if (empty($_POST['cpassword'])) {
            $CPassworderr = "confirm Password  cant be empty";
        } else {
            $cpass = input_data($_POST['cpassword']);
            if (!preg_match('/^\S*(?=\S{6,})(?=\S*\d)(?=\S*[A-Z])(?=\S*[a-z])(?=\S*[!@#$%^&*? ])\S*$/', $cpass)) {
                $CPassworderr = "Password and confirm password mismatch";
            }
        }
    }

    function input_data($data)
    {
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="signup.css">
</head>
<body>
        <section>
                <div id="form">
                <h1>Sign Up!!!</h1>
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" >
                        
                        <div id="username">
                            <label>&emsp;&emsp;&emsp;&emsp;Username:<input type="text" name="username" id="username"></label>
                            <p><?php echo $Nameerr;?></p>
                        </div>
                        <div id="email">
                        <label>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Email:<input type="email" name="email" id="email"></label>
                        <p><?php echo $Emailerr;?></p>
                        </div>
                        <div id="password">
                        <label>&emsp;&emsp;&emsp;&emsp;Password:<input type="password" name="password" id="password"></label><p><?php echo $Passworderr;?></p>
                        </div>
                        <div id="password">
                            <label> Confirm Password:<input type="password" name="cpassword" id="password"></label><p><?php echo $CPassworderr;?></p>
                        </div>
                        &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="" id="">Remember me?
                        <div id="button">
                            &emsp;&emsp;&emsp;&emsp;&emsp; <input type="submit" name="submit" value="Create My Account" id="button1">
                        </div>
                    <p id="para">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Already member? <a href="login.php" target="_blank">Login</a> here.</p>
                    </form>
            </div>
        </section>
</body>
</html>
<?php
include 'database.php';
if (isset($_POST['submit'])) {
    if ($Nameerr == "" && $Emailerr == "" && $Phoneerr == "" && $Passworderr == "" && $CPassworderr == "")
    {
    $uname=$_POST['username'];
    $email=$_POST['email'];
    $pass=$_POST['password'];


    $sql="insert into registration(username,email,password) values('$uname','$email','$pass')";
    if (mysqli_query($conn,$sql))
    {
        echo "sucessfully signed in";
        header("Location:login.php");
    }
    else{
        echo "not connected";
    }
}
}
?>



$emailquery= "select * from registration where email='$email'";
    $query=mysqli_query($conn,$emailquery);
    $emailcount=mysqli_num_rows($query);
    if($emailcount>0){
        $errorerr ="please login fisrt";
    }





    $email=$_POST['email'];
    $pass=$_POST['password'];
    $pass_hash= md5($pass);

        $emailq="select * from registration where email ='$email'";
        $query=mysqli_query($conn,$emailq);
        $emailcount= mysqli_num_rows($query);
        if($emailcount==1){

            $sql="insert into users (email,password) values('$email','$pass')";
            if (mysqli_query($conn,$sql))
            {
            echo "<script>";
            // echo "alert('hello admin')";
            echo "document.getElementById('parav').innerHTML='correct credentials !!!<br>hello admin !!!'";
            echo "</script>";
                // echo "sucessfully signed in";
                // header("Location:gallery.php");
            }
            
        else{
            echo "<script>";
            echo "document.getElementById('parav').innerHTML='Incorrect credentials !!!<br> Please login again !!!'";
            echo "</script>";
        }
    }
}
}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style> 
    *{
        margin: 0px;
        padding:0px;
    }
    button{
        background-color: gray;
        width: 150px;
        border-radius: 12px;
        border: 2px solid red;
        position: relative;
        left: 900px;
        top:-25px;
        /* width:100%; */
    }
    button:hover{
        background-color: greenyellow;

        cursor: default;
    }
    #nav{
        position: relative;
        top:-px;
        background-color: gray;
        /* border-radius: 10px; */
        
    }
    #nav:{
    }
</style>
</head>
<body>
    <div id="nav"><center><h1 style="text-align: center;">Hello, This is <?php echo $_SESSION['username'];?></h1></center></div>
    <hr>
    <a href="logout.php"> <button>Logout</button></a>
    

</body>
</html>