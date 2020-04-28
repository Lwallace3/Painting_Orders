<?php include_once('Partials/Header.php')?>
    <link rel="stylesheet" href="stylesheets/log.css">
<?php
$host = //Taken out for git
$user =//Taken out for git
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
        $email_err = "Please provide a email";
    } else if(!isset($password)) {
        $password_err = "Please provide a password";
    } else {
        $sqlCheck = "SELECT ID FROM `users` WHERE `email` = '$email'";
        $result = $conn->query($sqlCheck);

        if (!$result) {
            die("Query failed");
        }

        if(!($result->num_rows > 0)){
            $passwordHashed = password_hash($password, PASSWORD_DEFAULT);
            $sqlInsert = "INSERT INTO `users` (`ID`, `email`, `password`) VALUES (NULL, '$email', '$passwordHashed')";
            $result = $conn->query($sqlInsert);
            header("location: listart.php");
        } else {
            $email_err = "This email already exists";
        }

    }
}
$conn->close();
?>


    </head>
    <body>
    <div id="container">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label>Email Address</label><input required type="email" name="email" value="<?php echo "$email" ?>">
             <span class="errors"><?php echo $email_err; ?></span><br>
            <label>Password</label><input required type="password" name="password" value="<?php echo "$password" ?>">
            <span class="errors"><?php echo $password_err; ?></span><br>
            <button type="submit">Register</button><br><br>
        </form>
        <button onclick="window.location.href='listart.php'">Back</button>
    </div>
    </body>
</html>