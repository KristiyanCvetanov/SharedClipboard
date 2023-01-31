<!DOCTYPE html 5.0>
<html>
    <head>
        <link href="../styles/navbar.css" rel="stylesheet"></link>
    </head>
    <body>
    <nav class="navigation">
            <ul class="navlist">
                <li><a href="" class='active'> Home </a></li>
                <?php
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
                     }
                ?>
                <li><a href=""> Logout </a></li>
                
            </ul>
        </nav>

        <?php

        ?>
    </body>
</html>