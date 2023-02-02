async function logout() {
    let response = await fetch("../php/login_and_signup/logout.php", {
        method: "POST"
    });

    console.log(response);
}