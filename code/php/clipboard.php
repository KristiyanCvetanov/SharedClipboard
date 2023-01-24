<!DOCTYPE html 5.0>
<html>
    <head>
        <title> Клипборд </title>

        <link href="../styles/clipboard.css" rel="stylesheet"></link>
    </head>
    <!-- import nav? create nav? -->
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
            
            echo "<table class='clipTable'>
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
            $clipboard_id = "1"; // $_GET['id'];
            $types = array("text", "link"); // $_GET['types'];

            foreach ($types as $type) {
                $table_name = "resource_" . $type;
                $result = mysqli_query($conn, "SELECT * FROM " . $table_name . " WHERE CLIPBOARD_ID = " . $clipboard_id);
                
                while($row = mysqli_fetch_array($result)) {
                    echo "<tr class='tableRow'>";
                    echo "<td>" . $type . "</td>";
                    echo "<td class='contentData'>" . $row['CONTENT'] . "</td>";
                    echo "<td>" . $row['DESCRIPTION'] . "</td>";
                    echo "<td> <a href='#' onclick='exportResource(\"" . $type . "\", \"" . $row['CONTENT'] . "\")'> Export " . $type . " </a> </td>";
                    echo "</tr>";
                }
            }

            echo "</tbody>";
            echo "</table>";

            mysqli_close($conn);
        ?>
    </body>
</html>