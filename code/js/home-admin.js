let user_id, clipboard_id;

function unhide_subscription_area(user, clipboard) {
    const hidden_form = document.getElementById("subscription_area");
    //hidden_form.style.display = "block";

    hidden_form.removeAttribute("hidden");

    user_id = user;
    clipboard_id = clipboard;
}

async function add_user_to_clipboard() {
    let formData = new FormData();
    formData.append("user_id", user_id)
    formData.append("clipboard_id", clipboard_id);

    await fetch("../php/add_user_to_clipboard.php", {
        method: "POST",
        body: formData
    });

    hide_subscription_area();
}

function hide_subscription_area() {
    const hidden_form = document.getElementById("subscription_area");
    hidden_form.setAttribute("hidden", "hidden");
}