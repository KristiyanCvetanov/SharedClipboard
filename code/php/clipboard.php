<!DOCTYPE html 5.0>
<html>
    <head>
        <title> Клипборд </title>

        <link href="../styles/clipboard.css" rel="stylesheet"></link>
    </head>
<!-- import nav? create nav? -->
    <body>
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

            $result = mysqli_query($conn,"SELECT * FROM Clipboards");

            echo "<table class='clipTable'>
                    <th> ID </th>
                    <th> Content </th>
                    <th> Description </th>
                    <th> Export </th>
                    </tr>";

            while($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td>" . $row['ID'] . "</td>";
                echo "<td>" . $row['CLIPBOARD_NAME'] . "</td>";
                echo "<td>" . $row['TYPES'] . "</td>";
                echo "<td>" . $row['IS_PRIVATE'] . "</td>"; 
                echo "</tr>";
            }

            echo "</table>";

            mysqli_close($conn);
        ?>
    </body>
</html>