let formValidated = false;
let usernameValidated = false;
let emailValidated = false;
let passwordValidated = false;
let confirmPasswordValidated = false;

const username = document.getElementById("username");
const email = document.getElementById("email");
const password = document.getElementById("password");
const confirmPassword = document.getElementById("password_confirm");

const greenColor = "#28a745";
const redColor = "#dc3545";

let usernameActivated = false;
let emailActivated = false;
let passwordActivated = false;
let confirmPasswordActivated = false;

username.addEventListener("input", () => {
    usernameActivated = true;
});
email.addEventListener("input", () => {
    emailActivated = true;
});
password.addEventListener("input", () => {
    passwordActivated = true;
});
confirmPassword.addEventListener("input", () => {
    confirmPasswordActivated = true;
});


function registrationValidate() {
    if (usernameActivated) {
        const usernameRegex = /^[a-zA-Z0-9]{4,15}$/;
        if (usernameRegex.test(username.value)) {
            username.style.border = "4px solid" + greenColor;
            usernameValidated = true;
            let errorLabel = username.nextElementSibling;
            if (errorLabel && errorLabel.classList.contains("inline-error")) {
                errorLabel.remove();
            }
        }
        else {
            username.style.border = "4px solid" + redColor;
            usernameValidated = false;
            let errorLabel = username.nextElementSibling;
            if (!errorLabel || !errorLabel.classList.contains("inline-error")) {
                errorLabel = document.createElement("label");
                errorLabel.className = "inline-error";
                errorLabel.innerText = "A felhasználónévnek 5-14 karakter hosszúnek kell lennie.";
                username.parentNode.appendChild(errorLabel);
            }
        }
    }

    if (emailActivated) {
        const emailRegex = /^[\w\.\-]+@([\w\-]+\.)+[a-zA-Z]{2,20}$/;
        if (emailRegex.test(email.value)) {
            email.style.border = "4px solid" + greenColor;
            emailValidated = true;
            let errorLabel = email.nextElementSibling;
            if (errorLabel && errorLabel.classList.contains("inline-error")) {
                errorLabel.remove();
            }
        }
        else {
            email.style.border = "4px solid" + redColor;
            emailValidated = false;
            let errorLabel = email.nextElementSibling;
            if (!errorLabel || !errorLabel.classList.contains("inline-error")) {
                errorLabel = document.createElement("label");
                errorLabel.className = "inline-error";
                errorLabel.innerText = "Kérem valós email címet adjon meg.";
                email.parentNode.appendChild(errorLabel);
            }
        }
    }

    if (passwordActivated) {
        const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d\s@$!%*?&]{8,20}$/;
        if (passwordRegex.test(password.value)) {
            password.style.border = "4px solid" + greenColor;
            passwordValidated = true;
            let errorLabel = password.nextElementSibling;
            if (errorLabel && errorLabel.classList.contains("inline-error")) {
                errorLabel.remove();
            }
        }
        else {
            password.style.border = "4px solid" + redColor;
            passwordValidated = false;
            let errorLabel = password.nextElementSibling;
            if (!errorLabel || !errorLabel.classList.contains("inline-error")) {
                errorLabel = document.createElement("label");
                errorLabel.className = "inline-error";
                errorLabel.innerText = "A jelszónak legalább 8 karaker hosszúnak kell lennie, kis- és nagybetűk, valamint speciális karakterek tartalmazásával.";
                password.parentNode.appendChild(errorLabel);
            }
        }
    }

    if (confirmPasswordActivated) {
        if (password.value === confirmPassword.value && passwordValidated) {
            confirmPassword.style.border = "4px solid" + greenColor;
            confirmPasswordValidated = true;
            let errorLabel = confirmPassword.nextElementSibling;
            if (errorLabel && errorLabel.classList.contains("inline-error")) {
                errorLabel.remove();
            }
        }
        else {
            confirmPassword.style.border = "4px solid" + redColor;
            confirmPasswordValidated = false;
            let errorLabel = confirmPassword.nextElementSibling;
            if (!errorLabel || !errorLabel.classList.contains("inline-error")) {
                errorLabel = document.createElement("label");
                errorLabel.className = "inline-error";
                errorLabel.innerText = "A jelszavak nem egyeznek meg.";
                confirmPassword.parentNode.appendChild(errorLabel);
            }
        }
    }

    if(usernameValidated && emailValidated && passwordValidated && confirmPasswordValidated){
        formValidated = true;
    }
}

document.getElementById("registrationForm").addEventListener("input", registrationValidate);

document.getElementById("registrationForm").addEventListener("submit", (event) => {
    if (!formValidated){
        event.preventDefault();
    }
    registrationValidate();
});


let errorVisible = false;
window.onerror = function(message) {
    if(!errorVisible){
        errorVisible = true;
        let errordiv = document.createElement("div");
        console.log(document.body.contains(errordiv));
        errordiv.className = "error-group";
        errordiv.innerText = message;
        document.body.appendChild(errordiv);
    }
    else{
        errordiv.innerText = message;
    }
};