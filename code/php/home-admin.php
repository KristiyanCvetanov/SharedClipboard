<!DOCTYPE html>
<html>
    <head>
        <title> Home </title>

        <link href="../styles/dynamic-table.css" rel="stylesheet"></link>
    </head>
<!-- import nav? create nav? -->
    <body>
        <script src="../js/home-admin.js"></script>
        <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "shared_clipboard";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn -> connect_error) {
                die("Connection failed: " . $conn -> connect_error);
            }

            $user_id = "1"; // $_GET['user_id'];
            $subquery = "SELECT CLIPBOARD_ID FROM subscriptions WHERE USER_ID = " . $user_id;
            $query_private = "SELECT * FROM Clipboards WHERE ID IN (" . $subquery . ") AND IS_PRIVATE IS true";
            $query_public = "SELECT * FROM Clipboards WHERE ID IN (" . $subquery . ") AND IS_PRIVATE IS false";

            /*echo "<div class='allClipboards'>
                    <div class='privateClipboards'>
                        PRIVATE
                    </div>
                    <div class='publicClipboards'>
                        PUBLIC
                    </div>
                   </div>";*/


            echo "<div class='privatesAndPublicsContainer'>
                            <table class='privatesAndPublicsTable'>
                                <thead class='bigTableHeader'>
                                    <tr>
                                        <th colspan=3 class='bigHeaderElement'> Private </th>
                                        <th colspan=2 class='bigHeaderElement'> Public </th>
                                    </tr>
                                    <tr>
                                        <th colspan=1 class='smallHeaderElementLeft'> Name </th>
                                        <th colspan=1 class='smallHeaderElementLeft'> Types </th>
                                        <th colspan=1 class='smallHeaderElementLeft'> Add User </th>
                                        
                                        <th colspan=1 class='smallHeaderElementRight'> Name </th>
                                        <th colspan=1 class='smallHeaderElementRight'> Types </th>
                                    </tr>
                                </thead>
                                
                                <tbody class='bigTableBody'>";
        // get all clipboards that the user is subscribed to (not implemented below)
        $result_private = mysqli_query($conn, $query_private);
        $result_public = mysqli_query($conn, $query_public);

        $current_row_private = 1;
        $current_row_public = 1;

        // visualize table below
        while ($row_private = mysqli_fetch_array($result_private)) {
            // private columns

            $clip_id_param = "clipboard_id=" . $row_private['ID'];
            $types_param = "";
            $types = explode(", ", $row_private['TYPES']);
            $is_private = $row_private['IS_PRIVATE'];

            foreach ($types as $type) {
                $types_param .= "&types[]=" . $type;
            }

            echo "<tr class='tableRow'>";
            echo "<td class='clipName'> <a href='clipboard.php?" . $clip_id_param . $types_param . "'>" . $row_private['CLIPBOARD_NAME'] . "</a> </td>";
            echo "<td class='borderData'>" . $row_private['TYPES'] . "</td>";
            echo "<td class='addUser'> </td>";


            // public columns
            $row_public = mysqli_fetch_array($result_public);

            if ($row_public != NULL) {
                $clip_id_param = "clipboard_id=" . $row_public['ID'];
                $types_param = "";
                $types = explode(", ", $row_public['TYPES']);
                $is_private = $row_public['IS_PRIVATE'];

                foreach ($types as $type) {
                    $types_param .= "&types[]=" . $type;
                }

                echo "<td class='clipName'> <a href='clipboard.php?" . $clip_id_param . $types_param . "'>" . $row_public['CLIPBOARD_NAME'] . "</a> </td>";
                echo "<td class='borderData'>" . $row_public['TYPES'] . "</td>";

            } else {
                echo "<td class='clipName'> </td>";
                echo "<td class='borderData'> </td>";
            }

            echo "</tr>";

        }

        while ($row_public = mysqli_fetch_array($result_public)) {

            $clip_id_param = "clipboard_id=" . $row_public['ID'];
            $types_param = "";
            $types = explode(", ", $row_public['TYPES']);

            foreach ($types as $type) {
                $types_param .= "&types[]=" . $type;
            }

            echo "<tr class='tableRow'>";
            echo "<td class='clipName'> </td>";
            echo "<td class='borderData'> </td>";
            echo "<td class='addUser'> </td>";

            echo "<td class='clipName'> <a href='clipboard.php?" . $clip_id_param . $types_param . "'>" . $row_public['CLIPBOARD_NAME'] . "</a> </td>";
            echo "<td class='borderData'>" . $row_public['TYPES'] . "</td>";
        }


        echo "</tbody>";
        echo "</table>";
        echo "</div>";

        ?>
    </body>
</html>