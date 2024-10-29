let formValidated = false;

function registrationValidate(event) {
    if(formValidated === false) {
        event.preventDefault();
        let formValidated = false;
        const username = document.getElementById("username");
        const email = document.getElementById("email");
        const password = document.getElementById("password");
        const confirmPassword = document.getElementById("password_confirm");
        const usernameValue = document.getElementById("username").value;
        const emailValue = document.getElementById("email").value;
        const passwordValue = document.getElementById("password").value;
        const confirmPasswordValue = document.getElementById("password_confirm").value;

        const greenColor = "#90EE90";
        const redColor = "#d0706b";
        const defaultColor = "#EEEEEE";
        const defaultBorderColor = "#cccccc";
        
        let usernameValidated = false;
        let emailValidated = false;
        let passwordValidated = false;
        
        const usernameRegex = /^[a-zA-Z0-9]{4,15}$/;
        const emailRegex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d\s@$!%*?&]{8,}$/;
        if(usernameValue != ""){
            if(usernameRegex.test(usernameValue)){
                username.style.backgroundColor = greenColor;
                username.style.borderColor = greenColor;
                usernameValidated = true;
            }
            else{
                username.style.backgroundColor = redColor;
                username.style.borderColor = redColor;
                usernameValidated = false;
            }
        }
        else{
            username.style.backgroundColor = defaultColor;
            username.style.borderColor = defaultBorderColor;
            usernameValidated = false;
        }
        if(emailValue != ""){
            if(emailRegex.test(emailValue)){
                email.style.backgroundColor = greenColor;
                email.style.borderColor = greenColor;
                emailValidated = true;
            }
            else{
                email.style.backgroundColor = redColor;
                email.style.borderColor = redColor;
                emailValidated = false;
            }
        }
        else{
            email.style.backgroundColor = defaultColor;
            email.style.borderColor = defaultBorderColor;
            emailValidated = false;
        }
        if(passwordValue != ""){
            if(passwordRegex.test(passwordValue)){
                password.style.backgroundColor = greenColor;
                password.style.borderColor = greenColor;
                passwordValidated = true;
            }
            else{
                password.style.backgroundColor = redColor;
                password.style.borderColor = redColor;
                passwordValidated = false;
            }
        }
        else{
            password.style.backgroundColor = defaultColor;
            password.style.borderColor = defaultBorderColor;
            passwordValidated = false;
        }
        if(confirmPasswordValue != ""){
            if(confirmPasswordValue == passwordValue && passwordValidated){
                confirmPassword.style.backgroundColor = greenColor;
                confirmPassword.style.borderColor = greenColor;
            }
            else{
                confirmPassword.style.backgroundColor = redColor;
                confirmPassword.style.borderColor = redColor;
            }
        }
        else{
            confirmPassword.style.backgroundColor = defaultColor;
            confirmPassword.style.borderColor = defaultBorderColor;
        }
    }
}

document.getElementById("registrationForm").addEventListener("input", (event) => {
    registrationValidate(event); 
});