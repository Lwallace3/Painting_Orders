<?php include_once('Partials/Header.php')?>
<link rel="stylesheet" href="stylesheets/tables.css">
</head>
<body>
<?php

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {

    $host = //Taken out for git
    $user = //Taken out for git
    $pass = //Taken out for git
    $dbname = //Taken out for git
    $conn = new mysqli($host, $user, $pass, $dbname);

    if ($conn->connect_error) {
        die("Connection Failed.");
    }

    $email = $_SESSION["email"];

    $sql = "SELECT * FROM `Orders` WHERE `email` = '$email'";
    $result = $conn->query($sql);

    if (!$result) {
        die("Query failed");
    }

    if ($result->num_rows > 0) {
        echo "<br><br><table>\n";
        ?>
        <th>Painting</th>
        <th>Painting ID</th>
        <th>Status</th>
        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["painting_name"] . "</td>";
            echo "<td>" . $row["painting_id"] . "</td>";
            echo "<td> Still drying..</td>";
            echo "</tr>\n";
        }
        echo "</table>\n";
    }
    $conn->close();

} else {
    header("location: listart.php");
}

?>
</body>
</html>
