<!DOCTYPE html 5.0>
<html>
    <head>
        <title> Добави ресурс </title>

        <link href="../styles/add-resource.css" rel="stylesheet"></link>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <?php require 'navbar.php'; ?>
    </head>
    <body>
        <script src="../js/add-resource.js"></script>

        <article class="resource-article">
            <form class="dropdown-section">
                <h2> Изберете тип на ресурса </h2>
                <button class="dropbtn"> Тип ресурс </button>
                <ul class="dropdown-content">
                    <?php
                        $clipboard_id = $_GET['clipboard_id'];
                        $types = $_GET['types'];

                        foreach($types as $type) {
                            switch($type) {
                                case "text":
                                    echo "<li><a href=\"#\" onclick=\"addTextarea('text', 'текст', 'text-box')\"> text </a></li>";
                                    break;
                                case "link":
                                    echo "<li><a href=\"#\" onclick=\"addTextarea('link', 'линк', 'text-box')\"> link </a></li>";
                                    break;
                                case "php":
                                    echo "<li><a href=\"#\" onclick=\"addTextarea('php', 'php код', 'code-block')\"> source/php </a></li>";
                                    break;
                                case "html":
                                    echo "<li><a href=\"#\" onclick=\"addTextarea('html', 'html код', 'code-block')\"> source/html </a></li>";
                                    break;
                                case "css":
                                    echo "<li><a href=\"#\" onclick=\"addTextarea('css', 'css код', 'code-block')\"> source/css </a></li>";
                                    break;
                                case "js":
                                    echo "<li><a href=\"#\" onclick=\"addTextarea('js', 'javascript код', 'code-block')\"> source/js </a></li>";
                                    break;
                                case "json":
                                    echo "<li><a href=\"#\" onclick=\"addTextarea('json', 'json ресурс', 'code-block')\"> json </a></li>";
                                    break;
                                case "image":
                                    echo "<li><a href=\"#\" onclick=\"addFiles('.jpg, .png, .jpeg')\"> image </a></li>";
                                    break;
                                case "pdf":
                                    echo "<li><a href=\"#\" onclick=\"addFiles('.pdf')\"> pdf </a></li>";
                                    break;
                            }
                        }
                     ?>
                </ul>
            </form>
            <form class="input-section" id="input-section"></form>
        </article>
    </body>
</html>
