<?php //session_start();
// $session_value = (isset($_SESSION['id'])) ? $_SESSION['id'] : ''; ?>

<!--<html>-->
<!--<head>-->
<!---->
<!--    <title>Painting Orders</title>-->
<!--    <meta name="viewport" content="width=device-width, initial-scale=1">-->
<!--    <link rel="stylesheet" href="stylesheets/index6.css">-->
<!--    <link href="https://fonts.googleapis.com/css?family=Roboto+Mono&display=swap" rel="stylesheet">-->
<!--    <script src="https://kit.fontawesome.com/0fc2b33ba9.js" crossorigin="anonymous"></script>-->
<!--    <div class="topnav">-->
<!--        <a class="active" href="index.php">Home</a>-->
<!--        <a>--><?php //if(isset($_SESSION["email"])){echo htmlspecialchars($_SESSION["email"]);}?><!--</a>-->
<!--        <a class="right-side" --><?php //if(isset($_SESSION["loggedin"])){ echo "hidden";}?><!-- href="login.php">Sign in</a>-->
<!--        <a class="right-side" --><?php //if(isset($_SESSION["loggedin"])){ echo "hidden";}?><!-- href="register.php">Sign up</a>-->
<!--        <a class="right-side" --><?php //if(empty($session_value)){ echo "hidden";}?><!-- href="userViewOrders.php">View Orders</a>-->
<!--        <a class="right-side" --><?php //if(empty($session_value)){ echo "hidden";}?><!-- href="logout.php">Sign Out</a>-->
<!--    </div>-->
<?php include_once('Partials/Header.php')?>
    <link rel="stylesheet" href="stylesheets/index.css">
</head>
<body>
<section id="section1">
    <h1>Painting Orders</h1>
    <a href="#section2"><h3>View our art<br> <i class="fas fa-caret-down"></i></h3></a>

    <ul>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
    </ul>
</section>
<section id="section2" style="overflow-x:auto;">
    <h2><u>Our Art!</u></h2><br>
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

        if (isset($_GET["page"])) {
            $page = $_GET["page"];
        } else {
            $page = 1;
        };

        $resultsPerPage = 12;
        $startFrom = ($page - 1) * $resultsPerPage;
        $sql = "SELECT * FROM `paintings` ORDER BY ID ASC LIMIT $startFrom," . $resultsPerPage;

        $result = $conn->query($sql);
        if (!$result) {
            die("Query failed");
        }

        if ($result->num_rows > 0) {
            echo "<div class='grid-container'>";
            while ($row = $result->fetch_assoc()) {
                echo "<div class='grid-item'><img src=data:image/jpeg;base64," . base64_encode($row["image"]) . " height='50' width='50'><br>";
                echo "<div class='segment'><u> " . $row["name"] . "</u><br><br>";
                echo "Width(mm): " . $row["width"] . "<br>";
                echo "Height(mm): " . $row["height"] . "<br>";
                echo "£" . $row["price"] . "<br><br>";
                echo "<button type='submit' formaction='details.php' name='id' value='" . $row["ID"] . "'>More Info!</button>";
                echo "<button type='submit' name='id' value='" . $row["ID"] . "'>Order Now!</button></div></div>";
            }
            echo "</div>\n";
        }

        $sql = "SELECT COUNT(ID) AS total FROM `paintings`";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $numOfPages = ceil($row["total"] / $resultsPerPage); // calculate total pages with results

        echo "<br>Page: ";
        for ($i = 1; $i <= $numOfPages; $i++) {  // print links for all pages
            echo "<a href='listart.php?page=" . $i . "#section2'";
            if ($i == $page) {
                echo " class='curPage'";
            }
            echo ">" . $i . "</a>, ";
        };

        $conn->close();
        ?>
    </form>
</section>
</body>
</html>