let inputErrorVisible = false;
let usernameChanged = false;
let passwordChanged = false;

const username = document.getElementById("username");
const password = document.getElementById("password");
const rememberMe = document.getElementById("rememberme");
const loginForm = document.getElementById("loginForm");
const greenColor = "#28a745";
const redColor = "#dc3545";

function showError(element, message) {
    element.style.border = "4px solid " + redColor;
    let errorLabel = element.nextElementSibling;
    if (!errorLabel || !errorLabel.classList.contains("inline-error")) {
        errorLabel = document.createElement("label");
        errorLabel.className = "inline-error";
        errorLabel.innerText = message;
        element.parentNode.appendChild(errorLabel);
    }
    inputErrorVisible = true;
}

function clearError(element) {
    element.style.border = "4px solid " + greenColor;
    let errorLabel = element.nextElementSibling;
    if (errorLabel && errorLabel.classList.contains("inline-error")) {
        errorLabel.remove();
    }
    inputErrorVisible = false;
}

function validateUsername() {
    if (!usernameChanged || username.value.trim() == "") {
        showError(username, "Kérjük adja meg a felhasználónevét.");
        return false;
    }
    else {
        clearError(username);
        return true;
    }
}

function validatePassword() {
    if (!passwordChanged || password.value.trim() == "") {
        showError(password, "Kérjük adja meg a jelszavát.");
        return false;
    }
    else {
        clearError(password);
        return true;
    }
}

async function login(event) {
    event.preventDefault();
    const isUsernameValid = validateUsername();
    const isPasswordValid = validatePassword();
    if (!isUsernameValid || !isPasswordValid) {
        return;
    }
    
    try {
        const response = await fetch("/src/php_functions/login_fetch.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Javascript-Fetch-Request": "login-fetch-req"
            },
            body: JSON.stringify({
                username: username.value,
                password: password.value,
                rememberme: rememberMe.checked
            })
        });
        const result = await response.json();
        
        if (result.result == "success") {
            if(!document.body.classList.contains("login-wrapper")) {
                document.body.insertAdjacentHTML("beforeend", `<div class="login-wrapper">
                                                <div class="login-popup">
                                                <div class="title-container">
                                                    <h3>Sikeres bejelentkezés!</h3>
                                                    <svg xmlns="http://www.w3.org/2000/svg" id="svg_x" width="35" height="35" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                                                    </svg>
                                                </div>
                                                <hr>
                                                <div class="content">
                                                    <p>Kellemes időtöltést és jó kódolást kívánunk!</p>
                                                </div>
                                                <hr>
                                                <div class="button-container">
                                                    <a id="button_login" href="/">Tovább</a>
                                                </div>
                                            </div>
                                            </div>`);
                                            document.querySelector("#button_login").addEventListener("click", translateOut);
            }
        }
        else if (result.result == "unsuccessful") {
            showError(password, "Hibás felhasználónév vagy jelszó.");
        }
        else {
            showError(password, "Hiba történt a bejelentkezés során.");
        }
    }
    catch (error) {
        showError(password, "Hálózati hiba. Próbálja újra később.");
    }
}

document.addEventListener("click", (event) => {
    if(event.target.closest("svg")) {
        closePopup();
    }
    if(event.target.closest("div.button-container > button")) {
        closePopup();
    }
});

function closePopup(){
    document.querySelector("div.login-wrapper").style.opacity = 0;
    document.querySelector("div.login-wrapper").style.transition = "opacity, 0.3s";
    setTimeout(() => {
        document.querySelector("div.login-wrapper").remove();
    }, 1000);
}

username.addEventListener("input", () => {
    usernameChanged = true;
    if (inputErrorVisible) {
        clearError(username);
    }
    validateUsername();
});

password.addEventListener("input", () => {
    passwordChanged = true;
    if (inputErrorVisible) {
        clearError(password);
    }
    validatePassword();
});

loginForm.addEventListener("submit", login);

document.getElementById("button_submit").addEventListener("click", async function() {
    event.preventDefault();
    const isUsernameValid = validateUsername();
    const isPasswordValid = validatePassword();
    if (!isUsernameValid || !isPasswordValid) {
        return;
    }
    
    try {
        const response = await fetch("/src/php_functions/login_fetch.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "JavaScript-Fetch-Request": "login-fetch-req"
            },
            body: JSON.stringify({
                username: username.value,
                password: password.value,
                rememberme: rememberMe.checked
            })
        });
        const result = await response.json();
        
        if (result.result == "success") {
            translateOut("/");
        }
        else if (result.result == "unsuccessful") {
            showError(password, "Hibás felhasználónév vagy jelszó.");
        }
        else {
            showError(password, "Hiba történt a bejelentkezés során.");
        }
    }
    catch (error) {
        showError(password, "Hálózati hiba. Próbálja újra később.");
    }
});