<!DOCTYPE html 5.0>
<html>
    <head>
        <title> Създай клипборд </title>

        <link href="../styles/create-clipboard.css" rel="stylesheet"></link>
        <?php require 'navbar.php'; ?>
    </head>
    <body>
        <form class="createForm" action="create-clipboard.php" method="post">
            <fieldset class="formFieldset">
                <div class="inputsContainer">
                    <div class="clipName">
                        <label for="name"> Име на клипборд </label>
                        <input type="text" name="name">
                    </div>
                    <div class="types">
                        <div class="types1">
                            <div>
                                <input type="checkbox" id="text" name="type_text" value="text">
                                <label for="text"> текст </label>
                            </div>
                            <div>
                                <input type="checkbox" id="link" name="type_link" value="link">
                                <label for="link"> линк </label>
                            </div>
                            <div>
                                <input type="checkbox" id="image" name="type_image" value="image">
                                <label for="image"> image </label>
                            </div>
                            <div>
                                <input type="checkbox" id="pdf" name="type_pdf" value="pdf">
                                <label for="pdf"> pdf </label>
                            </div>
                        </div>
                        <div class="types2">
                            <div>
                                <input type="checkbox" id="php" name="type_php" value="php">
                                <label for="php"> php </label>
                            </div>
                            <div>
                                <input type="checkbox" id="html" name="type_html" value="html">
                                <label for="html"> html </label>
                            </div>
                            <div>
                                <input type="checkbox" id="css" name="type_css" value="css">
                                <label for="css"> css </label>
                            </div>
                            <div>
                                <input type="checkbox" id="js" name="type_js" value="js">
                                <label for="js"> js </label>
                            </div>
                            <div>
                                <input type="checkbox" id="json" name="type_json" value="json">
                                <label for="json"> json </label>
                            </div>
                        </div>
                    </div>
                    <div class="access">
                        <div>
                            <input type="radio" id="public" name="access" value="public">
                            <label for="public"> публичен </label>
                        </div>
                        <div>
                            <input type="radio" id="public" name="access" value="private">
                            <label for="private"> скрит </label>
                        </div>
                    </div>
                </div>
                <div class="buttonContainer">
                    <button type="submit" class="submitBtn"> Submit </button>
                </div>
            </fieldset>
        </form>

        <?php
            if(!isset($_SESSION)) 
            { 
                session_start(); 
            }

            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                exit();
            }

            $clipboard_name = $_POST['name'];

            $types = array();
            if (isset($_POST['type_text'])) {
                $types[] = $_POST['type_text'];
            }
            if (isset($_POST['type_link'])) {
                $types[] = $_POST['type_link'];
            }
            if (isset($_POST['type_php'])) {
                $types[] = $_POST['type_php'];
            }
            if (isset($_POST['type_html'])) {
                $types[] = $_POST['type_html'];
            }
            if (isset($_POST['type_css'])) {
                $types[] = $_POST['type_css'];
            }
            if (isset($_POST['type_js'])) {
                $types[] = $_POST['type_js'];
            }
            if (isset($_POST['type_json'])) {
                $types[] = $_POST['type_json'];
            }
            if (isset($_POST['type_image'])) {
                $types[] = $_POST['type_image'];
            }
            if (isset($_POST['type_pdf'])) {
                $types[] = $_POST['type_pdf'];
            }

            $access = $_POST['access'] === "public" ? 0 : 1;

            if (!isset($clipboard_name) || empty($types) || !isset($access)) {
                die("Invalid form submitted.");
            }

            $types_param = "";
            for ($i = 0; $i < count($types) - 1; $i++) {
                $types_param .= ($types[$i] . ", "); 
            }
            $types_param .= $types[count($types) - 1];

            
            // $servername = "localhost";
            // $username = "root";
            // $password = "";
            // $dbname = "shared_clipboard";

            // // Create connection
            // $conn = new mysqli($servername, $username, $password, $dbname);

            // // Check connection
            // if ($conn->connect_error) {
            //     die("Connection failed: " . $conn->connect_error);
            // }

            $clipboards_query = "INSERT INTO CLIPBOARDS (CLIPBOARD_NAME, TYPES, IS_PRIVATE) VALUES (\"" . $clipboard_name . "\", \"" . $types_param . "\", " . $access . ")";
            $clip_id_query = "SELECT ID FROM CLIPBOARDS ORDER BY ID DESC LIMIT 1";
            
            mysqli_query($conn, $clipboards_query);
            $result = mysqli_query($conn, $clip_id_query);
            $clipboard_id = mysqli_fetch_array($result)['ID'];

            $user_id = "";
            if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] && isset($_SESSION['user_id'])) {
                $user_id = $_SESSION['user_id'];
            } else {
                die("Not logged in!");
            }

            $subscriptions_query = "INSERT INTO SUBSCRIPTIONS (USER_ID, CLIPBOARD_ID) VALUES (" . $user_id . ", " . $clipboard_id . ")";
            mysqli_query($conn, $subscriptions_query);

            mysqli_close($conn);
        ?>
    </body>
</html>