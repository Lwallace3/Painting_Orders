<?php include_once('Partials/Header.php')?>
    <link rel="stylesheet" href="stylesheets/log.css">
</head>
<?php

$host = //Taken out for git
$user = //Taken out for git
$pass = //Taken out for git
$dbname = //Taken out for git
$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection Failed.");
}

$email = $password = "";
$email_err = $password_err = $forgot_password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST"){

    $email = isset($_POST["email"]) ? $conn->real_escape_string($_POST["email"]):"";
    $password = isset($_POST["password"]) ? $conn->real_escape_string($_POST["password"]):"";

    if(empty($email)) {
        $email_err = "Please enter an email";
    }

    if(empty($_POST["password"])){
        $password_err = "Please enter your password.";
    }

    if(!empty($email) && !empty($password)){
        $sqlCheck = "SELECT * FROM `users` WHERE `email` = '$email'";
        $result = $conn->query($sqlCheck);


        if(!$result){
            die("Query Failed");
        }

        if($result->num_rows > 0){
            $exists = $result->fetch_assoc();
            if (password_verify($password, $exists["password"])){
                session_start();
                $_SESSION["loggedin"] = true;
                $_SESSION["id"] = $exists["ID"];
                $_SESSION["email"] = $email;
                header("location: listart.php");
            } else {
                $password_err = "The password is incorrect";
            }
        } else {
            $email_err = "This email is not registered to an account";
        }
    }
}
$conn->close();
?>


<body>
<div id="container">
    <form id= "mainForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label>Username</label><input type="text" name="email" value="<?php echo $email; ?>">
        <span class="errors"><?php echo $email_err; ?></span><br>
        <label>Password</label><input type="password" name="password" value="<?php echo $password; ?>">
        <span class="errors"><?php echo $password_err; ?></span><br>
        <button type="submit">Log In</button><br><br>
    </form>
    <button id-="forgot" onclick="window.location.href='./resetPass.php'">Forgot my Password</button><br>
    <button onclick="window.location.href='./listart.php'">Back</button>

</div>
</body>
</html>
