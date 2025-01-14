let formValidated = false;
let usernameValidated = false;
let emailValidated = false;
let passwordValidated = false;
let confirmPasswordValidated = false;
let checkboxValidated = false;
let captchaValidated = false;
let inputErrorVisible = false;
let confirmPasswordErrorVisible = false;
let usernameChanged = false;
let emailChanged = false;
let passwordChanged = false;
let confirmPasswordChanged = false;
const username = document.getElementById("username");
const email = document.getElementById("email");
const password = document.getElementById("password");
const confirmPassword = document.getElementById("password_confirm");
const checkbox = document.getElementById("policy-checkbox");
const checkboxLabel = document.getElementsByClassName("checkbox-group");
const captcha = document.getElementById("captcha");
const greenColor = "#28a745";
const redColor = "#dc3545";
function showError(element, message){
    if (!inputErrorVisible) {
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
}
function confirmPasswordShowError(element, message){
    if (!confirmPasswordErrorVisible) {
        element.style.border = "4px solid " + redColor;
        let errorLabel2 = element.nextElementSibling;
        if (!errorLabel2 || !errorLabel2.classList.contains("inline-error")) {
            errorLabel2 = document.createElement("label");
            errorLabel2.className = "inline-error";
            errorLabel2.innerText = message;
            element.parentNode.appendChild(errorLabel2);
        }
        confirmPasswordErrorVisible = true;
    }
}
function clearError(element){
    element.style.border = "4px solid " + greenColor;
    let errorLabel = element.nextElementSibling;
    if (errorLabel && errorLabel.classList.contains("inline-error")) {
        errorLabel.remove();
    }
    inputErrorVisible = false;
}
function confirmPasswordClearError(element){
    element.style.border = "4px solid " + greenColor;
    let errorLabel2 = element.nextElementSibling;
    if (errorLabel2 && errorLabel2.classList.contains("inline-error")) {
        errorLabel2.remove();
    }
    confirmPasswordErrorVisible = false;
}
function validateUsername(){
    const usernameRegex = /^[a-zA-Z0-9]{4,20}$/;
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
            showError(username, "A felhasználónévnek 4-20 karakter hosszúnek kell lennie.");
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
    validateConfirmPassword();
}

function validateConfirmPassword(){
    if(confirmPasswordChanged){
        if(password.value !== confirmPassword.value || !passwordValidated){
            confirmPasswordShowError(confirmPassword, "A jelszavak nem egyeznek meg.");
            confirmPasswordValidated = false;
        }
        else {
            confirmPasswordClearError(confirmPassword);
            confirmPasswordValidated = true;
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
    }
}
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
function registrationResponse(){
    let registrationPopup = `<div class="registration-wrapper">
    <div class="registration-popup">
    <h3>Sikeres regisztráció</h3>
    <p>Jó kódolást kívánunk!</p>
    </div>
    </div>`;
    document.body.appendChild(registrationPopup);
}
function closePopup(){
    document.querySelector("div.registration-wrapper").style.opacity = 0;
    document.querySelector("div.registration-wrapper").style.transition = "opacity, 0.3s";
    setTimeout(() => {
        document.querySelector("div.registration-wrapper").remove();
    }, 1000);
}
function removeCaptchaError(){
    let captchaerror = document.body.querySelector("div.captcha-error");
    if(captchaerror){
        captchaerror.remove();
    }
}
username.addEventListener("input", () => {
    usernameChanged = true;
    if (inputErrorVisible) {
        clearError(username);
    }
    validateUsername();
    removeCaptchaError();
});
email.addEventListener("input", () => {
    emailChanged = true;
    if (inputErrorVisible) {
        clearError(email);
    }
    validateEmail();
    removeCaptchaError();
});
password.addEventListener("input", () => {
    passwordChanged = true;
    if (inputErrorVisible) {
        clearError(password);
    }
    validatePassword();
    removeCaptchaError();
});
confirmPassword.addEventListener("input", () => {
    confirmPasswordChanged = true;
    if (inputErrorVisible) {
        clearError(confirmPassword);
    }
    validateConfirmPassword();
    removeCaptchaError();
});
checkbox.addEventListener("click", () => {
    validateCheckbox();
    removeCaptchaError();
});

document.addEventListener("click", (event) => {
    if(event.target.closest("svg")) {
        closePopup();
    }
    if(event.target.closest("div.button-container > button")) {
        closePopup();
    }
});

document.getElementById("registrationForm").addEventListener("submit", (event) => {
    if (!formValidated) {
        event.preventDefault();
    }
});

/* ---------------------------------- todo! --------------------------------- */
async function registration(username, email, password) {
    try{
        const response = await fetch("/vizsgaremek/src/web/upload_likes.php",{
            method: "POST",
            headers:{
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                username: username,
                email: email,
                password: password
            })
        });
        if(!response.ok){
            throw new Error(response.text);
        }
        else{
            document.body.innerHTML += `<div class="registration-wrapper">
                                                <div class="registration-popup">
                                                    <div class="title-container">
                                                        <h3>Sikeres regisztráció!</h3>
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
                                                        <a id="button_login" href="./login.php">Bejelentkezés</a>
                                                    </div>
                                                </div>
                                            </div>`;
        }
    }
    catch(error){
        console.error(error);
    }
}