let formValidated = false;
let usernameValidated = false;
let emailValidated = false;
let passwordValidated = false;
let confirmPasswordValidated = false;
<<<<<<< HEAD
=======
let checkboxValidated = false;
let captchaValidated = false;

let inputErrorVisible = false;

let usernameChanged = false;
let emailChanged = false;
let passwordChanged = false;
let confirmPasswordChanged = false;
>>>>>>> origin/backend

const username = document.getElementById("username");
const email = document.getElementById("email");
const password = document.getElementById("password");
const confirmPassword = document.getElementById("password_confirm");
<<<<<<< HEAD
=======
const checkbox = document.getElementById("aszf-checkbox");
const checkboxLabel = document.getElementsByClassName("checkbox-group");
const captcha = document.getElementById("captcha");
>>>>>>> origin/backend

const greenColor = "#28a745";
const redColor = "#dc3545";

<<<<<<< HEAD
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
                errorLabel.innerText = "A felhasználónévnek 5-14 karakter hosszúnek kell lennie.";
                username.parentNode.appendChild(errorLabel);
            }
        }
    }

    if (emailActivated) {
        const emailRegex = /^[\w\.\-]+@([\w\-]+\.)+[a-zA-Z]{2,}$/;
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

/* ---------------------------------- TODO ---------------------------------- */
window.onerror = function(message) {
    const errordiv = document.createElement("div");
    errordiv.className = "error-group";
    errordiv.innerText = message;
    document.body.appendChild(errordiv);
};
=======
function showError(element, message){
    if (!inputErrorVisible) {
        element.style.border = "4px solid" + redColor;
        let errorLabel = element.nextElementSibling;
        if (!errorLabel || !errorLabel.classList.contains("inline-error")) {
            errorLabel = document.createElement("label");
            errorLabel.className = "inline-error";
            errorLabel.innerText = message;
            element.parentNode.appendChild(errorLabel);
        }
        inputErrorVisible = true;
    }
}

function clearError(element){
    element.style.border = "4px solid" + greenColor;
    let errorLabel = element.nextElementSibling;
    if (errorLabel && errorLabel.classList.contains("inline-error")) {
        errorLabel.remove();
    }
    inputErrorVisible = false;
}

function validateUsername(){
    const usernameRegex = /^[a-zA-Z0-9]{4,15}$/;
    if(!usernameChanged){
        showError(username, "Kérjük adja meg a felhasználónevét.");
        usernameValidated = false;
    }
    else{
        if (usernameRegex.test(username.value)){
            clearError(username);
            usernameValidated = true;
        }
        else {
            showError(username, "A felhasználónévnek 4-14 karakter hosszúnek kell lennie.");
            usernameValidated = false;
        }
    }
}

function validateEmail(){
    if(!emailChanged){
        showError(email, "Kérjük adja meg az email címét.");
        emailValidated = false;
    }
    else {
        const emailRegex = /^[\w\.\-]+@([\w\-]+\.)+[a-zA-Z]{2,20}$/;
        if (emailRegex.test(email.value)){
            clearError(email);
            emailValidated = true;
        }
        else {
            showError(email, "Kérem valós email címet adjon meg.");
            emailValidated = false;
        }
    }
}

function validatePassword(){
    if(!passwordChanged){
        showError(password, "Kérjük adja meg a jelszavát.");
        passwordValidated = false;
    }
    else{
        const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d\s@$!%*?&]{8,20}$/;
        if (passwordRegex.test(password.value)){
            clearError(password);
            passwordValidated = true;
        }
        else{
            showError(password, "A jelszónak legalább 8 karakter hosszúnak kell lennie, kis- és nagybetűk, valamint speciális karakterek tartalmazásával.");
            passwordValidated = false;
        }
    }
}

function validateConfirmPassword(){
    if(!confirmPasswordChanged){
        showError(confirmPassword, "Kérjük erősítse meg a jelszavát.");
    }
    else{
        if (password.value === confirmPassword.value && passwordValidated) {
            clearError(confirmPassword);
            confirmPasswordValidated = true;
        }
        else {
            showError(confirmPassword, "A jelszavak nem egyeznek meg.");
            confirmPasswordValidated = false;
        }
    }    
}

function validateCheckbox(){
    if (checkbox.checked){
        let errorLabel = checkboxLabel[0].querySelector(".inline-error");
        if (errorLabel) {
            errorLabel.remove();
        }
        checkboxValidated = true;
    }
    else{
        if (usernameValidated && emailValidated && passwordValidated && confirmPasswordValidated){
            checkboxValidated = false;
            let errorLabel = checkboxLabel[0].querySelector(".inline-error");
            if (!errorLabel){
                errorLabel = document.createElement("label");
                errorLabel.className = "inline-error";
                errorLabel.innerText = "Kérjük fogadja el az adatvédelmi nyilatkozatot!";
                checkboxLabel[0].appendChild(errorLabel);
            }
        }
    }
}

function validateCaptcha(){
    if(checkboxValidated){
        var captchaResponse = grecaptcha.getResponse();
        if (captchaResponse.length !== 0){
            let errorLabel = captcha.nextElementSibling;
            if (errorLabel && errorLabel.classList.contains("inline-error")) {
                errorLabel.remove();
            }
            inputErrorVisible = false;
            captchaValidated = true;
        }
        else{
            captchaValidated = false;
            if (!inputErrorVisible) {
                let errorLabel = captcha.nextElementSibling;
                if (!errorLabel || !errorLabel.classList.contains("inline-error")) {
                    errorLabel = document.createElement("label");
                    errorLabel.className = "inline-error";
                    errorLabel.innerText = "Kérjük végezze el a reCAPTCHA ellenőrzést!";
                    captcha.parentNode.appendChild(errorLabel);
                }
                inputErrorVisible = true;
            }
        }
    }
}


function registrationValidate(){
    validateUsername();
    validateEmail();
    validatePassword();
    validateConfirmPassword();
    validateCheckbox();
    validateCaptcha();
    
    formValidated = usernameValidated && emailValidated && passwordValidated && confirmPasswordValidated && checkboxValidated && captchaValidated;

    if (!formValidated){
        if (!usernameValidated){
            username.focus();
        }
        else if (!emailValidated){
            email.focus();
        }
        else if (!passwordValidated){
            password.focus();
        }
        else if (!confirmPasswordValidated){
            confirmPassword.focus();
        }
        else if (!checkboxValidated){
            checkbox.focus();
        }
        else if (!captchaValidated){
            captcha.focus();
        }
    }
}

username.addEventListener("input", () => {
    usernameChanged = true;
    if (inputErrorVisible) {
        clearError(username);
    }
    validateUsername();
});
email.addEventListener("input", () => {
    emailChanged = true;
    if (inputErrorVisible) {
        clearError(email);
    }
    validateEmail();
});
password.addEventListener("input", () => {
    passwordChanged = true;
    if (inputErrorVisible) {
        clearError(password);
    }
    validatePassword();
});
confirmPassword.addEventListener("input", () => {
    confirmPasswordChanged = true;
    if (inputErrorVisible) {
        clearError(confirmPassword);
    }
    validateConfirmPassword();
});
checkbox.addEventListener("click", () => {
    validateCheckbox();
});

document.getElementById("registrationForm").addEventListener("submit", (event) => {
    registrationValidate();
    if (!formValidated) {
        event.preventDefault();
    }
});

document.getElementById("registrationForm").addEventListener("input", function(){
    if (!inputErrorVisible) {
        if(document.body.contains(document.querySelector(".registration-successful"))){
            document.querySelector(".registration-successful").style.opacity = 0;
        }
        if(document.body.contains(document.querySelector(".registration-unsuccessful"))){
            document.querySelector(".registration-unsuccessful").style.opacity = 0;
        }
    }
});

let errorVisible = false;
window.onerror = function(message){
    if (!errorVisible) {
        errorVisible = true;
        let errordiv = document.createElement("div");
        errordiv.className = "error-group";
        errordiv.innerText = message;
        document.body.appendChild(errordiv);
    }
    else{
        document.querySelector(".error-group").innerText = message;
    }
};
>>>>>>> origin/backend
