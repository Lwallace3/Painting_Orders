<?php include_once('Partials/Header.php')?>
    <link rel="stylesheet" href="stylesheets/display.css">
</head>
<body>


<form action="order.php" method="get">
    <?php
    $host = //Taken out for git
    $user = //Taken out for git
    $pass = //Taken out for git
    $dbname = //Taken out for git
    $conn = new mysqli($host, $user, $pass, $dbname);

    if ($conn->connect_error) {
        die("Connection Failed.");
    }

    $sql = "SELECT * FROM `paintings`";
    $result = $conn->query($sql);

    if (!$result) {
        die("Query failed");
    }

    $userID = $conn->real_escape_string($_GET["id"]);

    $sql = "SELECT * FROM `paintings` WHERE `ID` = $userID";
    $result = $conn->query($sql);

    if (!$result) {
        die("Query failed");
    }

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<br><h3><u>" . $row["name"] . "</u></h3>";
            echo "<p>ID: " . $row["ID"] . "</p>";
            echo "<p>Date of Completion: " . $row["completionDate"] . "</p>";
            echo "<p>Width: " . $row["width"] . "mm     ";
            echo "Height: " . $row["height"] . "mm</p>";
            echo "<p>Price: £" . $row["price"] . "</p>";
            echo "<p><u><b>Description</b></u></p><p>" . $row["description"] . "</p><br>";
            echo "<img src=data:image/jpeg;base64," . base64_encode($row["image"]) . " height='50' width='50'><br>";
            echo "<button class='backButton' formaction='listart.php'>Back</button>";
            echo "<button type='submit' name='id' value='" . $row["ID"] . "'>Order Now!</button>";
        }
    }

    $conn->close();
    ?>
</form>
</body>
</html>