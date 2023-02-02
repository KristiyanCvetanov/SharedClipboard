<!DOCTYPE html 5.0>
<html>
    <head>
        <title> Клипборд </title>

        <link href="../styles/dynamic-table.css" rel="stylesheet"></link>
        <?php require 'navbar.php'; ?>
    </head>
    <body>
        <script src="../js/clipboard.js"></script>
        <?php
            $files_downloaded = 1;
            $server_name = "localhost";
            $username = "root";
            $password = "";
            $dbname = "shared_clipboard";

            // Create connection
            $conn = new mysqli($server_name, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            
            echo "<div class='clipContainer'>
                    <table class='clipTable'>
                        <thead class='tableHeader'>
                            <tr>
                                <th class='headerElement'> Type </th>
                                <th class='headerElement'> Content </th>
                                <th class='headerElement'> Description </th>
                                <th class='headerElement'> Export </th>
                            </tr>
                        </thead>";
            echo "<tbody class='tableBody'>";

            // Get clipboard id and types for the query to work
            $clipboard_id = $_GET['clipboard_id'];
            $types = $_GET['types'];

            foreach ($types as $type) {
                $table_name = "resource_" . $type;
                $result = mysqli_query($conn, "SELECT * FROM " . $table_name . " WHERE CLIPBOARD_ID = " . $clipboard_id);
                
                while($row = mysqli_fetch_array($result)) {
                    $content = htmlentities($row['CONTENT']);
                    $link_anchor_left = "";
                    $link_anchor_right = "";
                    
                    // if type is link, add anchor to content
                    if (strcmp($type, "link") == 0) {
                        $link_anchor_left = "<a href='" . $row['CONTENT'] . "' target='_blank'>";
                        $link_anchor_right = "</a>";
                    }

                    echo "<tr class='tableRow'>";
                    echo "<td>" . $type . "</td>";
                    echo "<td class='borderData'>" . $link_anchor_left . $content . $link_anchor_right . "</td>";
                    echo "<td class='contentDescription'>" . $row['DESCRIPTION'] . "</td>";
                    echo "<td> <a href='#' onclick='exportResource(\"" . $type . "\", \"" . $content . "\")'> Export " . $type . " </a> </td>";
                    echo "</tr>";
                }
            }

            echo "</tbody>";
            echo "</table>";
            echo "</div>";

            mysqli_close($conn);
        ?>
    </body>
</html>