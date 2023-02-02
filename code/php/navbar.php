<!DOCTYPE html 5.0>
<html>
    <head>
        <link href="../styles/navbar.css" rel="stylesheet"></link>
    </head>
    <body>
        <script src="../js/navbar.js"></script>

        <?php
            if(!isset($_SESSION)) 
            { 
                session_start(); 
            }

            $user_id = "";
            if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] && isset($_SESSION['user_id'])) {
                    $user_id = $_SESSION['user_id'];
            } else {
                exit();
            }

            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "shared_clipboard";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $user_query = "SELECT IS_ADMIN FROM USERS WHERE ID = " . $user_id;
            $result = mysqli_query($conn, $user_query);

            $home_href = "";
            if ($row = mysqli_fetch_array($result)) {
                if ($row['IS_ADMIN']) {
                    $home_href = "home-admin.php";
                } else {
                    $home_href = "home-user.php";
                }
            } else {
                exit();
            }
        ?>

        <nav class="navigation">
            <ul class="navlist">
                <li><a href=<?php echo $home_href ?> class='active'> Home </a></li>

                <?php  
                    $current_page = basename($_SERVER['PHP_SELF']);

                    if (strcmp($current_page, 'clipboard.php') == 0) {
                        $clipboard_id = $_GET['clipboard_id'];
                        $types = $_GET['types'];

                        $clipboard_param = "?clipboard_id=" . $clipboard_id;
                        $types_param = "";
                        foreach ($types as $type) {
                            $types_param .= "&types[]=" . $type;
                        }

                        echo "<li><a href='add-resource.php" . $clipboard_param . $types_param . "'> Добави ресурс </a></li>";
                    } else if (strcmp($current_page, 'home-user.php') == 0) {
                        echo "<li><a href='#subscribe-anchor'> Абонирай се </a></li>";
                        echo "<li><a href='create-clipboard.php'> Създай клипборд </a></li>";
                    } else if (strcmp($current_page, 'home-admin.php') == 0) {
                        echo "<li><a href='create-clipboard.php'> Създай клипборд </a></li>";
                    }
                ?>
                <li><a href="./login_and_signup/login_page.php" onclick="logout()"> Logout </a></li>
                
            </ul>
        </nav>
    </body>
</html>