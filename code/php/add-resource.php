<!DOCTYPE html 5.0>
<html>
    <head>
        <title> Добави ресурс </title>

        <link href="../styles/add-resource.css" rel="stylesheet"></link>
    </head>
<!-- import nav? create nav? -->
    <body>
        <script src="../js/add-resource.js"></script>

        <article class="resource-article">
            <section class="dropdown-section">
                <h2> Изберете тип на ресурса </h2>
                <button class="dropbtn"> Тип ресурс </button>
                <ul class="dropdown-content">
                    <li><a href="#" onclick="addTextarea('submitText()', 'текст', 'text-box')"> text </a></li>
                    <li><a href="#" onclick="addTextarea('submitLink()', 'линк', 'text-box')"> link </a></li>
                    <li><a href="#" onclick="addTextarea('submitPhp()', 'php код', 'code-block')"> source/php </a></li>
                    <li><a href="#" onclick="addTextarea('submitHtml()', 'html код', 'code-block')"> source/html </a></li>
                    <li><a href="#" onclick="addTextarea('submitCss()', 'css код', 'code-block')"> source/css </a></li>
                    <li><a href="#" onclick="addTextarea('submitJs()', 'javascript код', 'code-block')"> source/js </a></li>
                    <li><a href="#" onclick="addTextarea('submitJson()', 'json ресурс', 'code-block')"> json </a></li>
                    <li><a href="#" onclick="addImage()"> image </a></li>
                    <li><a href="#" onclick="addPdf()"> pdf </a></li>
                </ul>
            </section>
            <section class="input-section" id="input-section"></section>
        </article>
    </body>
</html>
