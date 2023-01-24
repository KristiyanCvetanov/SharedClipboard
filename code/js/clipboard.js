function exportResource(type, content) {
    var element = document.createElement('a');
    element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(content));

    var filename = "resource";
    switch (type) {
        case 'text':
            filename += ".txt";
            break;
        case 'link':
            filename += ".txt";
            break;
        case 'php':
            filename += ".php";
            break;
        case 'html':
            filename += ".html";
            break;
        case 'css':
            filename += ".css";
            break;
        case 'js':
            filename += ".js";
            break;
        case 'json':
            filename += ".json";
            break;
        case 'image':
            filename += ".png";
            break;
        case 'pdf':
            filename += ".pdf";
            break;
        default:
            alert("Error in types.");
    }

    element.setAttribute('download', filename);

    element.style.display = 'none';
    document.body.appendChild(element);

    element.click();

    document.body.removeChild(element);
}