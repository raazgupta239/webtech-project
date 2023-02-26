<?php
session_start();

?>
<?php
$email = $pass = "";
$Emailerr = $Passworderr = "";
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    //Email validation
    if (empty($_POST['email'])) {
        $Emailerr = "Email cant be empty";
    } else {
        $email = input_data($_POST["email"]);
        if (!preg_match('/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/', $email)) {
            $Emailerr = "email format should be matched";
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
    <link rel="stylesheet" href="logins.css">
</head>

<body>
    <section>
        <div id="form">
            <h1>Login</h1>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

                <div id="username">
                    <label>&emsp;&emsp;Email:<input type="text" name="email" id="email"></label>
                    <p>
                        <?php echo $Emailerr; ?>
                    </p>
                </div>
                <div id="password">
                    <label>&nbsp; Password:<input type="password" name="password" id="password"></label>
                    <p>
                        <?php echo $Passworderr; ?>
                    </p>
                </div>
                <input type="checkbox" name="" id=""> Remember me?<a href="" id="anchor"> Forgot</a> password?
                <br>
                <div id="button">
                    <input type="submit" value="Login" name="submit" id="buttona">
                    <p id="parav" style="margin-left:40px;"></p>
                </div>
            </form>
        </div>
    </section>
</body>

</html>
<?php
include 'databaseuser.php';
include 'database.php';
if (isset($_POST['submit'])) {
if ($Emailerr == "" && $Passworderr == "") {
    $Email = $_POST['email'];
    $Pass = $_POST['password'];
    $pass_hash = md5($Pass);

    $emailq = "select * from registration where email ='$Email' and password ='$pass_hash'";
    $query = mysqli_query($conn,$emailq);
    $emailcount = mysqli_num_rows($query);
    if ($emailcount==1) {
        $array=mysqli_fetch_assoc($query);
        $_SESSION['username']= $array['username'];
        echo "<script>";
        echo "document.getElementById('parav').innerHTML='Correct credentials !!!<br>Welcome Admin!!!'";
        echo "</script>";
        header("Location:home.php");
        exit();
        // $sqlis = "insert into users (email,password) values('$Email','$Pass')";
        // if (mysqli_query($conn, $sqlis)) {
        // } 
       
        } else {
                echo "<script>";
                echo "document.getElementById('parav').innerHTML='Incorrect credentials !!!<br>Please Login !!!'";
                echo "</script>";
                
         }

    }
    
}

?>