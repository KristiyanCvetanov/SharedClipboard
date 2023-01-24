function addTextarea(submitFunc, areaPlaceholder, areaClassName) {
    let inputSection = document.getElementById("input-section");
    inputSection.innerHTML = "";

    let textarea = document.createElement("textarea"); 
    textarea.className = areaClassName;
    textarea.id = "text-box";
    textarea.setAttribute("placeholder", "Добави " + areaPlaceholder + "...");
    inputSection.appendChild(textarea);

    let input = document.createElement("button");
    input.className = "submitbtn";
    input.setAttribute("type", "submit");
    input.setAttribute("onclick", submitFunc);
    input.innerHTML = "Submit";
    inputSection.appendChild(input);
}

function submitText() {
    // TODO: submit text from textarea with POST request (request handled in php)
    alert("text");
}

function submitLink() {
    // TODO: submit link from textarea with POST request (request handled in php)
    alert("link");
}

function submitPhp() {
    // TODO: submit php code from textarea with POST request (request handled in php)
    alert("php");
}

function submitHtml() {
    // TODO: submit html code from textarea with POST request (request handled in php)
    alert("html");
}

function submitCss() {
    // TODO: submit css code from textarea with POST request (request handled in php)
    alert("css");
}

function submitJs() {
    // TODO: submit javascript code from textarea with POST request (request handled in php)
    alert("javascript");
}

function submitJson() {
    // TODO: submit json from textarea with POST request (request handled in php)
    alert("json");
}

function addFiles(fileTypes) {
    let inputSection = document.getElementById("input-section");
    inputSection.innerHTML = "";
    let fileType = getFileType(fileTypes);

    let fileForm = document.createElement("form");
    fileForm.className = "fileForm";
    fileForm.id = "fileForm";
    inputSection.appendChild(fileForm);

    let formFieldset = document.createElement("fieldset");
    formFieldset.className = "formFieldset";
    formFieldset.id = "formFieldset";
    fileForm.appendChild(formFieldset);

    let fileList = document.createElement("ul");
    fileList.className = "fileList";
    fileList.id = "fileList";
    formFieldset.appendChild(fileList);

    let paragraph = document.createElement("p");
    paragraph.className = "paragraph";
    paragraph.id = "paragraph";
    paragraph.innerHTML = "Добавете " + fileType + "...";
    formFieldset.appendChild(paragraph);

    let inputFiles = document.createElement("input");
    inputFiles.className = "browseFileBtn";
    inputFiles.id = "browseFileBtn";
    inputFiles.setAttribute("multiple", "");
    inputFiles.setAttribute("type", "file");
    inputFiles.setAttribute("accept", fileTypes);
    inputSection.appendChild(inputFiles);

    let inputSubmit = document.createElement("input");
    inputSubmit.className = "submitFileBtn";
    inputSubmit.id = "submitFileBtn";
    inputSubmit.setAttribute("type", "submit");
    inputSubmit.setAttribute("onclick", "someFunction()");
    inputSection.appendChild(inputSubmit);

    inputFiles.addEventListener('change', () => {
        paragraph.innerHTML = "";
        addToFileList(fileList, inputFiles.files);
    });

    window.addEventListener('paste', e => {
        if (e.clipboardData.files.length == 0) {
            return;
        }
        
        paragraph.innerHTML = "";
        inputFiles.files = e.clipboardData.files;
        addToFileList(fileList, inputFiles.files);
    });
}

function getFileType(fileTypes) {
    if (fileTypes === ".pdf") {
        return "pdf файлове"
    } else {
        return "снимки"
    }
}

function addToFileList(fileList, inputFiles) {
    fileList.innerHTML = "";

    for (i = 0; i < inputFiles.length; i++) {
        let bullet = document.createElement("li");
        bullet.innerHTML = inputFiles.item(i).name;
        fileList.appendChild(bullet);
    } 
}
