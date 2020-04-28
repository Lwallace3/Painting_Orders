<?php session_start();
$session_value = (isset($_SESSION['id'])) ? $_SESSION['id'] : ''; ?>

<html>
<head>

    <title>Painting Orders</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Mono&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/0fc2b33ba9.js" crossorigin="anonymous"></script>
    <div class="topnav">
        <a class="active" href="index.php">Home</a>
        <a><?php if(isset($_SESSION["email"])){echo htmlspecialchars($_SESSION["email"]);}?></a>
        <a class="right-side" <?php if(isset($_SESSION["loggedin"])){ echo "hidden";}?> href="login.php">Sign in</a>
        <a class="right-side" <?php if(isset($_SESSION["loggedin"])){ echo "hidden";}?> href="register.php">Sign up</a>
        <a class="right-side" <?php if(empty($session_value)){ echo "hidden";}?> href="userViewOrders.php">View Orders</a>
        <a class="right-side" <?php if(empty($session_value)){ echo "hidden";}?> href="logout.php">Sign Out</a>
    </div>
