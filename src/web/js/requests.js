<<<<<<< HEAD
async function acceptRequest(requestId) {
    try {
        const response = await fetch("/vizsgaremek/src/api/accept_request.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "JavaScript-Fetch-Request": "accept-request"
            },
            body: JSON.stringify({ requestId })
        });
        const data = await response.json();
        if(data.success) {
            location.reload();
        }
        else {
            showError(data.message || "Hiba történt a felkérés elvállalása közben.");
        }
    }
    catch(error) {
        showError("Hiba történt a felkérés elvállalása közben.");
    }
}

async function submitSolution() {
    const code = prompt("Kérjük, illessze be a megoldás kódját:");
    if(!code) return;
    try {
        const response = await fetch("/vizsgaremek/src/api/submit_solution.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "JavaScript-Fetch-Request": "submit-solution"
            },
            body: JSON.stringify({ 
                requestId: requestid,
                code: code
            })
        });
        const data = await response.json();
        if(data.success) {
            console.log("asd");
        }
        else {
            showError(data.message || "Hiba történt a megoldás beküldése közben.");
        }
    }
    catch(error) {
        showError("Hiba történt a megoldás beküldése közben.");
    }
}

async function acceptSolution(requestId) {
    try {
        const response = await fetch("/vizsgaremek/src/api/accept_solution.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "JavaScript-Fetch-Request": "accept-solution"
            },
            body: JSON.stringify({ requestId })
        });
        const data = await response.json();
        if(data.success) {
            location.reload();
        }
        else {
            showError(data.message || "Hiba történt a megoldás elfogadása közben.");
        }
    }
    catch(error) {
        showError("Hiba történt a megoldás elfogadása közben.");
    }
}

async function rejectSolution(requestId) {
    const reason = prompt("Kérjük, adja meg az elutasítás okát:");
    if(!reason) return;
    try {
        const response = await fetch("/vizsgaremek/src/api/reject_solution.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "JavaScript-Fetch-Request": "reject-solution"
            },
            body: JSON.stringify({ 
                requestId,
                reason
            })
        });
        const data = await response.json();
        if(data.success) {
            location.reload();
        }
        else {
            showError(data.message || "Hiba történt a megoldás elutasítása közben.");
        }
    }
    catch (error) {
        showError("Hiba történt a megoldás elutasítása közben.");
    }
}

function showError(message) {
    alert(message);
}

document.addEventListener("DOMContentLoaded", () => {
    const acceptRequestButton = document.querySelector(".accept-request");
    const submitSolutionButton = document.querySelector(".submit-solution");
    const acceptSolutionButton = document.querySelector(".accept-solution");
    const rejectSolutionButton = document.querySelector(".reject-solution");
    if(acceptRequestButton) {
        acceptRequestButton.addEventListener("click", () => acceptRequest(requestid));
    }
    if(submitSolutionButton) {
        submitSolutionButton.addEventListener("click", () => submitSolution());
    }
    if(acceptSolutionButton) {
        acceptSolutionButton.addEventListener("click", () => acceptSolution(requestid));
    }
    if(rejectSolutionButton) {
        rejectSolutionButton.addEventListener("click", () => rejectSolution(requestid));
    }
})
=======
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
        console.error(error);
    }
}

if(document.contains(document.querySelector(".upload-button"))) {
    document.querySelector(".upload-button").addEventListener("click", fetchRequest);
}
>>>>>>> 6ddc53096dcecddf0fe15ad01063e2dbf417fd68
