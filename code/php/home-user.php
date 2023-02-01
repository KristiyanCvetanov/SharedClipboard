<!DOCTYPE html 5.0>
<html>
    <head>
        <title> Home </title>

        <link href="../styles/dynamic-table.css" rel="stylesheet"></link>
        <?php require 'navbar.php'; ?>
    </head>
    <body>
        <script src="../js/home-user.js"></script>
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

            $user_id = "1"; // $_GET['user_id'];
            $subquery = "SELECT CLIPBOARD_ID FROM subscriptions WHERE USER_ID = " . $user_id; 
            $query = "SELECT * FROM Clipboards WHERE ID IN (" . $subquery . ")";

            echo "<div class='clipContainer'>
                    <table class='clipTable'>
                        <thead class='tableHeader'>
                            <tr>
                                <th class='headerElement'> Name </th>
                                <th class='headerElement'> Types </th>
                                <th class='headerElement'> Private </th>
                            </tr>
                        </thead>";
            echo "<tbody class='tableBody'>";

            // get all clipboards that the user is subscribed to (not implemented below)
            $result = mysqli_query($conn, $query);
            $subquery_all_public = "SELECT CLIPBOARD_ID FROM `SUBSCRIPTIONS` WHERE USER_ID=$user_id";
            $query_all_public = "SELECT * FROM CLIPBOARDS WHERE IS_PRIVATE IS false AND ID NOT IN ($subquery_all_public)";
            $result_all_public = mysqli_query($conn, $query_all_public);

            // visualize table below
            while($row = mysqli_fetch_array($result)) {
                $clip_id_param = "clipboard_id=" . $row['ID'];
                $types_param = "";
                $types = explode(", ", $row['TYPES']);

                foreach ($types as $type) {
                    $types_param .= "&types[]=" . $type;
                }

                echo "<tr class='tableRow'>";
                echo "<td class='clipName'> <a href='clipboard.php?" . $clip_id_param . $types_param . "'>" . $row['CLIPBOARD_NAME'] . "</a> </td>";
                echo "<td class='borderData'>" . $row['TYPES'] . "</td>";
                echo "<td>" . (strcmp($row['IS_PRIVATE'], "1") ? "Yes" : "No") . "</td>";
                echo "</tr>";
            }

            echo "</tbody>";
            echo "</table>";
            echo "</div>";
            echo "<a name='introduction-anchor'></a>";


            // ALL  PUBLICS TABLE:
            echo "<div class='clipContainer'>
                        <table class='clipTable'>
                            <thead class='tableHeader'>
                                <tr>
                                    <th class='headerElement'> Name </th>
                                    <th class='headerElement'> Types </th>
                                    <th class='headerElement'> Subscribe </th>
                                </tr>
                            </thead>
                            <tbody class='tableBody'>";
            while ($row = mysqli_fetch_array($result_all_public)) {
                $clipboard_id = $row['ID'];
                $clip_id_param = "clipboard_id=" . $clipboard_id;
                $types_param = "";
                $types = explode(", ", $row['TYPES']);

                foreach ($types as $type) {
                    $types_param .= "&types[]=" . $type;
                }

                echo "<tr class='tableRow'>";
                echo "<td class='clipName'> <a href='clipboard.php?" . $clip_id_param . $types_param . "'>" . $row['CLIPBOARD_NAME'] . "</a> </td>";
                echo "<td class='borderData'>" . $row['TYPES'] . "</td>";
                echo "<td class='addUser'> 
                            <button type='button' id='subscribeBtn' onclick='subscribe($user_id, $clipboard_id)'>Subscribe</button>
                       </td>";
                echo "</tr>";
            }

        mysqli_close($conn);
        ?>
    </body>
</html>