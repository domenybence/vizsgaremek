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
const defaultColor = "#EEEEEE";
const defaultBorderColor = "#cccccc";

let usernameErrorVisible = false;
let emailErrorVisible = false;
let passwordErrorVisible = false;
let confirmPasswordErrorVisible = false;

let usernameValue = "";
let emailValue = "";
let passwordValue = "";
let confirmPasswordValue = "";
function registrationValidate(event) {
    if(!formValidated) {
        event.preventDefault();
        formValidated = false;
        
        let usernameValue = document.getElementById("username").value;
        let emailValue = document.getElementById("email").value;
        let passwordValue = document.getElementById("password").value;
        let confirmPasswordValue = document.getElementById("password_confirm").value;
        
        const usernameRegex = /^[a-zA-Z0-9]{4,15}$/;
        const emailRegex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d\s@$!%*?&]{8,}$/;
        if(usernameValue != ""){
            if(usernameRegex.test(usernameValue)){
                username.style.border = "4px solid" + greenColor;
                usernameValidated = true;
            }
            else{
                username.style.border = "4px solid" + redColor;
                usernameValidated = false;
            }
        }
        else{
            username.style.border = "2px solid" + defaultBorderColor;
            usernameValidated = false;
        }
        if(emailValue != ""){
            if(emailRegex.test(emailValue)){
                email.style.border = "4px solid" + greenColor;
                emailValidated = true;
            }
            else{
                email.style.border = "4px solid" + redColor;
                emailValidated = false;
            }
        }
        else{
            email.style.border = "2px solid" + defaultBorderColor;
            emailValidated = false;
        }
        if(passwordValue != ""){
            if(passwordRegex.test(passwordValue)){
                password.style.border = "4px solid" + greenColor;
                passwordValidated = true;
            }
            else{
                password.style.border = "4px solid" + redColor;
                passwordValidated = false;
            }
        }
        else{
            password.style.border = "2px solid" + defaultBorderColor;
            passwordValidated = false;
        }
        if(confirmPasswordValue != ""){
            if(passwordValue == confirmPasswordValue && passwordValidated == true){
                confirmPassword.style.border = "4px solid" + greenColor;
                confirmPasswordValidated = true;
            }
            else{
                confirmPassword.style.border = "4px solid" + redColor;
                confirmPasswordValidated = false;
            }
        }
        else{
            confirmPassword.style.border = "2px solid" + defaultBorderColor;
            confirmPasswordValidated = false;
        }
        if (usernameValidated === true && emailValidated === true && passwordValidated === true && confirmPasswordValidated === true) {
            formValidated = true;
        }        
    }
}

document.getElementById("registrationForm").addEventListener("input", registrationValidate);
document.getElementById("registrationForm").addEventListener("submit", (event) => {
    const label = document.createElement("label");
    let usernameValue = document.getElementById("username").value;
    let emailValue = document.getElementById("email").value;
    let passwordValue = document.getElementById("password").value;
    let confirmPasswordValue = document.getElementById("password_confirm").value;
    label.className = "inline-text";
    label.style.color = redColor;
    label.style.fontSize = "14px";
    if (!formValidated) {
        event.preventDefault();
    }

    /* ------------ TODO CLASS COLORS, ONCLICK VALIDATING, SEE IN CSS ----------- */
    if(!usernameValidated){
        if(usernameValue == "" && usernameErrorVisible == false) {
            usernameErrorVisible = true;
            label.innerText = "Kérem adja meg a felhasználónevet!";
            document.querySelectorAll("div.inline-group")[0].appendChild(label);
        }
        else if(usernameErrorVisible === false) {
            usernameErrorVisible = true;
            label.innerText = "Kérem a kritériáknak megfelelő felhasználónevet adjon meg!";
            document.querySelectorAll("div.inline-group")[0].appendChild(label);
        }
    }
    else{
        usernameErrorVisible = false;
        if(usernameErrorVisible == true) {
            document.querySelectorAll("div.inline-group")[0].removeChild(label);
        }
    }
});