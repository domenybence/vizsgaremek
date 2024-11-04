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

username.addEventListener("focus", () => {
    usernameActivated = true;
});
email.addEventListener("focus", () => {
    emailActivated = true;
});
password.addEventListener("focus", () => {
    passwordActivated = true;
});
confirmPassword.addEventListener("focus", () => {
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
                errorLabel.innerText = "Invalid username. Must be 4-15 alphanumeric characters.";
                username.parentNode.appendChild(errorLabel);
            }
        }
    }

    if (emailActivated) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
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
                errorLabel.innerText = "Please enter a valid email.";
                email.parentNode.appendChild(errorLabel);
            }
        }
    }

    if (passwordActivated) {
        const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d\s@$!%*?&]{8,}$/;
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
                errorLabel.innerText = "Password must be at least 8 characters, with uppercase, lowercase, number, and special character.";
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
                errorLabel.innerText = "Passwords do not match.";
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


