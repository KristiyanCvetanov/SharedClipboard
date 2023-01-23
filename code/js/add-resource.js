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