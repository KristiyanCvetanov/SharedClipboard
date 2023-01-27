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
                     $current_page = basename($_SERVER['PHP_SELF']);

                     if (strcmp($current_page, 'clipboard.php') == 0) {
                        echo "<li><a href='add-resource.php'> Добави ресурс </a></li>";
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