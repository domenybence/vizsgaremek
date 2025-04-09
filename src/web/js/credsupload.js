document.getElementById("price").addEventListener("input", () => {
    const priceValue = parseFloat(document.getElementById("price").value) || 0;
    const pointsValue = priceValue * price;
    document.getElementById("points").value = pointsValue;
});
document.getElementById("points").addEventListener("input", () => {
    const pointsValue = parseFloat(document.getElementById("points").value) || 0;
    const priceValue = pointsValue / price;
    document.getElementById("price").value = priceValue;
});

document.querySelector(".button-input").addEventListener("click", async () => {
    const pointsInput = document.getElementById("points");
    const messageContainer = document.getElementById("message-container");
    messageContainer.innerHTML = "";  
    try {
        const response = await fetch("/src/php_functions/creds_fetch.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Javascript-Fetch-Request": "purchase-fetch-req"
            },
            body: JSON.stringify({
                amount: pointsInput.value,
            })
        });
        if(!response.ok){
            throw new Error(response.status, response.statusText);
        }
        else{
            let data = await response.json();
            if(data["result"] == "success"){
                const successMessage = document.createElement("div");
                successMessage.id = "responseMessage"
                successMessage.textContent = "Sikeres feltöltés!";
                successMessage.style.color = "green";
                messageContainer.appendChild(successMessage);
            }
        }
    }
    catch(error) {
        const errorMessage = document.createElement("div");
        errorMessage.id = "responseMessage"
        errorMessage.textContent = "Hiba történt a tranzakció során!";
        errorMessage.style.color = "red";
        messageContainer.appendChild(errorMessage);
    }
});