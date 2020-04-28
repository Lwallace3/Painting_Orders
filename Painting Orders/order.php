<?php include_once('Partials/Header.php')?>
    <link rel="stylesheet" href="stylesheets/orderForm.css">
    <title>Order</title>
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

$userID = $conn->real_escape_string($_GET["id"]);

$sql = "SELECT * FROM `paintings` WHERE `ID` = $userID";
$result = $conn->query($sql);

if (!$result) {
    die("Query failed");
}

$paintingName = $paintingID = "";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $paintingName =  $row["name"];
        $paintingID = $row["ID"];
    }
}

$conn->close();
?>

<body>
<br><br>
<div>
    <h1>Please fill out the order form below</h1>
    <h3>Painting Name: <?php echo "$paintingName"?></h3>
    <h3>Painting ID: <?php echo "$paintingID"?></h3>
    <form action="successful.php" method="POST">
        <input type="hidden" name="paintingName" value="<?php echo "$paintingName"?>"><br>
        <input type="hidden" name="paintingID" value="<?php echo "$paintingID"?>"><br>
        <input placeholder="Name" name="name" type="text"><br>
        <input placeholder="Phone Number" name="phone-number" type="text"><br>
        <input placeholder="Email" name="email" type="email" <?php if(isset($_SESSION["loggedin"])){ echo "value =". $_SESSION["email"]." readonly" ;}?>><br>
        <input placeholder="Postal Address" name="postal-address" type="text"><br>
        <button class='backButton' formaction='index.php'>Back</button>
        <button type="submit" name="order">Order painting</button>
    </form>
</div>
</body>




</html>