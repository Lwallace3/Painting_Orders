<?php include_once('Partials/Header.php')?>
    <link rel="stylesheet" href="stylesheets/tables.css">
</head>
<body>
<?php
    $host = //Taken out for git
    $user = //Taken out for git
    $pass = //Taken out for git
    $dbname = //Taken out for git
    $conn = new mysqli($host, $user, $pass, $dbname);

    if ($conn->connect_error) {
        die("Connection Failed.");
    }

    $sql = "SELECT * FROM `Orders`";
    $result = $conn->query($sql);

    if (!$result) {
        die("Query failed");
    }

    if ($result->num_rows > 0) {
        echo "<br><br><table>\n";
        ?>
        <th>Name</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Address</th>
        <th>Painting</th>
        <th>Painting ID</th>
        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["name"] . "</td>";
            echo "<td>" . $row["phone"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["address"] . "</td>";
            echo "<td>" . $row["painting_name"] . "</td>";
            echo "<td>" . $row["painting_id"] . "</td>";
            echo "</tr>\n";
        }
        echo "</table>\n";
    }
    $conn->close();
    ?>
</body>
</html>
