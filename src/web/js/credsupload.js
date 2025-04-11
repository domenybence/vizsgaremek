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
    console.log(pointsInput.value);
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
                getPoints();
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


async function getPoints() {
    let userId = document.getElementById('id').innerHTML;
    if(userId != "")
    {
        try {
            const response = await fetch("/src/api/get_points.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "JavaScript-Fetch-Request": "get-points"
                },
                body: JSON.stringify({
                    id: userId
                })
            });

            const data = await response.json();
           
           
            document.getElementById('pointsdisplay').innerHTML ="Egyenleg: " +  data.user.points + " pont";
            
            
        }
        catch(error) {
            console.log(error);
        }

    }
    
}

