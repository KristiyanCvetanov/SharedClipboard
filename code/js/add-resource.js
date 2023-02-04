let all_users = [];
function addDescriptionArea(inputSection) {
    let descriptionArea = document.createElement("textarea");
    descriptionArea.className = "description-box";
    descriptionArea.id = "description-box";
    descriptionArea.setAttribute("placeholder", "Добави коментар...");
    inputSection.appendChild(descriptionArea);
}

function addTextarea(type, areaPlaceholder, areaClassName) {
    let inputSection = document.getElementById("input-section");
    inputSection.innerHTML = "";

    let textarea = document.createElement("textarea"); 
    textarea.className = areaClassName;
    textarea.id = "text-box";
    textarea.setAttribute("placeholder", "Добави " + areaPlaceholder + "...");
    inputSection.appendChild(textarea);

    addDescriptionArea(inputSection);

    let input = document.createElement("button");
    input.className = "submitbtn";
    input.setAttribute("type", "button");
    input.setAttribute("onclick", "submitTextarea(\"" + type + "\")");
    input.innerHTML = "Submit";
    inputSection.appendChild(input);
}

async function submitTextarea(type) {
    let input = document.getElementById("text-box").value;
    let description = document.getElementById("description-box").value;

    let params = (new URL(document.location)).searchParams;
    let clipboardId = params.get("clipboard_id");

    let formData = new FormData();
    formData.append("clipboard_id", clipboardId);
    formData.append("input", input);
    formData.append("type", type);
    formData.append("description", description);

    await fetch("../php/submit-text-resource.php", {
        method: "POST",
        body: formData
    });

    document.getElementById("input-section").innerHTML = "";

    await pushNotifications(all_users, clipboardId);
}

function addFiles(fileTypes) {
    let inputSection = document.getElementById("input-section");
    inputSection.innerHTML = "";
    let fileType = getFileType(fileTypes);

    let fileForm = document.createElement("form");
    fileForm.className = "fileForm";
    fileForm.id = "fileForm";
    fileForm.name = "fileForm";
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

    addDescriptionArea(inputSection);

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
    inputSubmit.name = "submitFileBtn";
    inputSubmit.setAttribute("type", "button");
    inputSubmit.setAttribute("value", "Submit");

    if (fileTypes === ".pdf") {
        inputSubmit.setAttribute("onclick", "submitFile(\"pdf\")");
    } else {
        inputSubmit.setAttribute("onclick", "submitFile(\"image\")");
    }

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

async function submitFile(type) {
    let file = document.getElementById("browseFileBtn").files[0];
    let description = document.getElementById("description-box").value;

    if (!file) {
        throw "No file is selected to be submitted.";
    }

    let params = (new URL(document.location)).searchParams;
    let clipboardId = params.get("clipboard_id");

    let formData = new FormData();
    formData.append("file", file);
    formData.append("new_path", "../../resources/" + file.name);
    formData.append("type", type);
    formData.append("clipboard_id", clipboardId);
    formData.append("description", description);

    let response = await fetch("../php/submit-file-resource.php", {
        method: "POST",
        body: formData
    });

    if (!response.ok) {
        throw "Bad response from server, could not persist file.";
    }
    console.log(response);

    //await pushNotifications();
}

async function pushNotifications(users, clipboard_id) {
    for (var i of users) {
        console.log(i);
        let formData = new FormData();
        formData.append("user_id", i)
        formData.append("clipboard_id", clipboard_id);
        formData.append("count", "1");

        await fetch("../php/push_notifications.php", {
            method: "POST",
            body: formData
        });
    }
}

function set_users(users) {
    all_users = []
    console.log(users.at(0));
    for (var i of users) {
        console.log(i);
        all_users.push(i);
    }

}
