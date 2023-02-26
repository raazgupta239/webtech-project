<?php
    $name = $email = $phone = $pass = $cpass ="";
    $Nameerr = $Emailerr = $Phoneerr = $Passworderr = $CPassworderr =$error= "";
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
                        &emsp;&emsp;&emsp;&emsp;<input type="checkbox" name="" id="">Remember me?
                        <div id="button">
                            &emsp;&emsp;&emsp;&emsp;<input type="submit" name="submit" value="Create My Account" id="button1" style="margin-left:-20px;">
                        </div>
                    <p id="para">&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Already member? <a href="login.php" target="_blank">Login</a> here.</p><br>
                   <p id="parav" style="margin-left:50px;"> <?php echo $error; ?></p>
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
    $pass_hash= md5($pass);

        $emailq="select * from registration where email ='$email'";
        $query=mysqli_query($conn,$emailq);
        $emailcount= mysqli_num_rows($query);
        if($emailcount>0){
            echo "<script>";
            echo "document.getElementById('parav').innerHTML='User already Exists !!!<br> Please login !!!'";
            echo "</script>";
           

        }
        else{

            
            $sql="insert into registration(username,email,password) values('$uname','$email','$pass_hash')";
            if (mysqli_query($conn,$sql))
            {
            
                header("Location:login.php");
            }
          
        }
}
}
?> 
