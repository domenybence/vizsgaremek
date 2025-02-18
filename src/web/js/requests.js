async function fetchRequest() {
    try {
        const response = await fetch("/vizsgaremek/src/php_functions/accept_request_fetch.php",{
            method: "POST",
            headers:{
                "Content-Type": "application/json",
                "Javascript-Fetch-Request": "accreq-fetch-req"
            },
            body: JSON.stringify({
                userid: userId,
                requestid: Number(requestId)
            })
        });
        const result = await response.json();
        if(result.result == "error") {
            throw new Error("Hiba történt!");
        }
    }
    catch(error) {
        console.log(error);
    }
}

if(document.contains(document.querySelector(".upload-button"))) {
    document.querySelector(".upload-button").addEventListener("click", fetchRequest);
}