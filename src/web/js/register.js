let formValidated = "";
let usernameValidated = "";
let emailValidated = "";
let passwordValidated = "";
let confirmPasswordValidated = "";

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

function registrationValidate() {

    let formValidated = false;
    if(!formValidated) {

        usernameValidated = false;
        emailValidated = false;
        passwordValidated = false;
        confirmPasswordValidated = false;
        
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

    console.log(formValidated);

    const usernameValue = document.getElementById("username").value;
    const emailValue = document.getElementById("email").value;
    const passwordValue = document.getElementById("password").value;
    const confirmPasswordValue = document.getElementById("password_confirm").value;
    
    label.className = "inline-error";
    if (!formValidated) {
        event.preventDefault();
    }

    const inlinegroup = document.querySelectorAll("div.inline-group");
    const labels = document.querySelectorAll("label.inline-error");

    if(!usernameValidated){
        if(usernameValue == "" && !usernameErrorVisible) {
            let label = document.createElement("label");
            label.className = "inline-error";
            usernameErrorVisible = true;
            label.innerText = "Kérem adja meg a felhasználónevet!";
            inlinegroup[0].appendChild(label);
            console.log("asd");
        }
        else if(!usernameErrorVisible) {
            let label = document.createElement("label");
            label.className = "inline-error";
            usernameErrorVisible = true;
            label.innerText = "Kérem a kritériáknak megfelelő felhasználónevet adjon meg!";
            inlinegroup[0].appendChild(label);
            console.log("asd1");
        }
    }
    else if(usernameValidated && usernameErrorVisible){
        usernameErrorVisible = false;
        inlinegroup[0].removeChild(labels[0]);
        console.log("asd2");
    }
    if(!emailValidated){
        if(emailValue == "" && !emailErrorVisible) {
            let label = document.createElement("label");
            label.className = "inline-error";
            emailErrorVisible = true;
            label.innerText = "Kérem adja meg az email címét!";
            inlinegroup[1].appendChild(label);
        }
        else if(!emailErrorVisible) {
            let label = document.createElement("label");
            label.className = "inline-error";
            emailErrorVisible = true;
            label.innerText = "Kérem létező email-t adjon meg!";
            inlinegroup[1].appendChild(label);
        }
    }
    else if(emailValidated && emailErrorVisible){
        emailErrorVisible = false;
        inlinegroup[1].removeChild(labels[0]);
    }
    if(!passwordValidated){
        if(passwordValue == "" && !passwordErrorVisible) {
            let label = document.createElement("label");
            passwordErrorVisible = true;
            label.innerText = "Kérem adja meg a jelszavát!";
            inlinegroup[2].appendChild(label);
        }
        else if(!passwordErrorVisible) {
            let label = document.createElement("label");
            passwordErrorVisible = true;
            label.innerText = "Kérem a kritériáknak megfelelő jelszót adjon meg!";
            inlinegroup[2].appendChild(label);
        }
    }
    else if(passwordValidated && passwordErrorVisible){
        passwordErrorVisible = false;
        inlinegroup[2].removeChild(labels[0]);
    }
    if(!confirmPasswordValidated){
        let label = document.createElement("label");
        confirmPasswordErrorVisible = true;
        label.innerText = "Kérem erősítse meg a jelszavát!";
        inlinegroup[3].appendChild(label);
    }
});

window.onerror = function(message) {
    const errordiv = document.createElement("div");
    errordiv.className = "error-group";
    errordiv.innerText = message;
    document.body.appendChild(errordiv);
};