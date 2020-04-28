<?php include_once('Partials/Header.php')?>
<link rel="stylesheet" href="stylesheets/log.css">
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
$email_err = $password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = isset($_POST["email"]) ? $conn->real_escape_string($_POST["email"]):"";
    $password = isset($_POST["password"]) ? $conn->real_escape_string($_POST["password"]):"";

    if(!isset($email)){
        $email_err = "<br>Please provide a email";
    } else if(!isset($password)) {
        $password_err = "<br>Please provide a password";
    } else {
        $sqlCheck = "SELECT ID FROM `users` WHERE `email` = '$email'";
        $result = $conn->query($sqlCheck);

        if (!$result) {
            die("Query failed");
        }

        if($result->num_rows > 0){
            $passwordHashed = password_hash($password, PASSWORD_DEFAULT);
            $sqlInsert = "UPDATE `users` SET `password` = '$passwordHashed' WHERE `users`.`email` = '$email'";
            $result = $conn->query($sqlInsert);
            header("location: login.php");
        } else {
            $email_err = "This email isn't linked to an account";
        }

    }
}
$conn->close();
?>


</head>
<body>
<div id="container">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label>Email Address</label><input type="email" name="email" required value="<?php echo "$email" ?>">
        <span class="errors"><?php echo $email_err; ?></span><br>
        <label>New Password</label><input type="password" name="password" required value="<?php echo "$password" ?>">
        <span class="errors"><?php echo $password_err; ?></span><br>
        <button type="submit">Change Password</button><br><br>
    </form>
    <button onclick="window.location.href='./register.php'">Sign Up</button>
    <button onclick="window.location.href='listart.php'">Back</button>
</div>
</body>
</html>