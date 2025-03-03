document.addEventListener("DOMContentLoaded", () => {
    const acceptRequestButton = document.querySelector(".accept-request");
    const submitSolutionButton = document.querySelector(".submit-solution");
    const acceptSolutionButton = document.querySelector(".accept-solution");
    const rejectSolutionButton = document.querySelector(".reject-solution");
    const saveSolutionButton = document.getElementById("save-solution");
    const editRequestButton = document.getElementById("edit-request-btn");
    const cancelEditButton = document.getElementById("cancel-edit-btn");
    const saveEditButton = document.getElementById("save-edit-btn");
    const editForm = document.getElementById("edit-form");

    acceptRequestButton?.addEventListener("click", () => acceptRequest(requestid));
    submitSolutionButton?.addEventListener("click", () => submitSolution());
    acceptSolutionButton?.addEventListener("click", () => acceptSolution(requestid));
    rejectSolutionButton?.addEventListener("click", () => rejectSolution(requestid));
    saveSolutionButton?.addEventListener("click", () => saveSolution());
    editRequestButton?.addEventListener("click", toggleEditForm);
    cancelEditButton?.addEventListener("click", toggleEditForm);
    
    if(editForm) {
        editForm.addEventListener("submit", function(e) {
            e.preventDefault();
            saveRequestEdits();
        });
    }
    
    if(saveEditButton) {
        saveEditButton.addEventListener("click", function(e) {
            e.preventDefault();
            saveRequestEdits();
        });
    }
});

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
        console.error(error);
        showError("Hiba történt a felkérés elvállalása közben.");
    }
}

async function saveSolution() {
    try {
        const code = window.monacoEditor.getValue();
        
        const response = await fetch("/vizsgaremek/src/api/save_solution.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "JavaScript-Fetch-Request": "save-solution"
            },
            body: JSON.stringify({ 
                requestId: requestid,
                code: code
            })
        });
        
        const data = await response.json();
        
        if(data.success) {
            showMessage("A kód sikeresen elmentve!");
        }
        else {
            showError(data.message || "Hiba történt a kód mentése közben.");
        }
    }
    catch(error) {
        console.error(error);
        showError("Hiba történt a kód mentése közben.");
    }
}

async function submitSolution() {
    try {
        const code = window.monacoEditor.getValue();
        
        if(!code.trim()) {
            showError("Kérjük, adjon meg kódot a beküldéshez!");
            return;
        }
        
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
            alert("A megoldás sikeresen beküldve!");
            location.reload();
        }
        else {
            showError(data.message || "Hiba történt a kód beküldése során.");
        }
    }
    catch(error) {
        console.error(error);
        showError("Hiba történt a kód beküldése során.");
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
            showMessage(data.message);
            setTimeout(() => {
                location.reload();
            }, 2000);
        }
        else {
            showError(data.message || "Hiba történt a megoldás elfogadása közben.");
        }
    }
    catch(error) {
        console.error(error);
        showError("Hiba történt a megoldás elfogadása közben.");
    }
}

async function rejectSolution(requestId) {
    showRejectModal(requestId);
}

function showRejectModal(requestId) {
    if (!document.querySelector(".modal-overlay")) {
        const modalCode = `
        <div class="modal-overlay">
            <div class="failed-registration-popup">
                <div class="failed-title-container">
                    <h3>Megoldás elutasítása</h3>
                    <svg xmlns="http://www.w3.org/2000/svg" id="svg_x" width="35" height="35" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                    </svg>
                </div>
                <hr>
                <div class="content">
                    <p>Kérjük, adja meg az elutasítás okát:</p>
                    <textarea id="rejection-reason" class="form-control" rows="4" style="width: 100%; margin-top: 10px;"></textarea>
                </div>
                <hr>
                <div class="button-container">
                    <button id="cancel-reject-btn" class="button secondary">Mégsem</button>
                    <button id="confirm-reject-btn" class="button danger">Elutasítás</button>
                </div>
            </div>
        </div>`;

        document.body.insertAdjacentHTML("beforeend", modalCode);
        document.querySelector("#svg_x").addEventListener("click", closeRejectModal);
        document.querySelector("#cancel-reject-btn").addEventListener("click", closeRejectModal);
        document.querySelector("#confirm-reject-btn").addEventListener("click", () => {
            const reason = document.querySelector("#rejection-reason").value.trim();
            if (!reason) {
                const existingError = document.querySelector(".reject-error-message");
                if (existingError) {
                    existingError.remove();
                }
                
                const errorMessage = document.createElement("div");
                errorMessage.className = "reject-error-message";
                errorMessage.textContent = "Az elutasítás oka nem lehet üres!";
                errorMessage.style.color = "red";
                errorMessage.style.marginTop = "10px";
                document.querySelector(".content").appendChild(errorMessage);
            } else {
                closeRejectModal();
                submitRejection(requestId, reason);
            }
        });
    }
}

function closeRejectModal() {
    const modal = document.querySelector(".modal-overlay");
    if (modal) {
        modal.style.opacity = 0;
        modal.style.transition = "opacity 0.3s ease";
        setTimeout(() => {
            modal.remove();
        }, 300);
    }
}

async function submitRejection(requestId, reason) {
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
            showMessage(data.message);
            setTimeout(() => {
                location.reload();
            }, 2000);
        }
        else {
            showError(data.message || "Hiba történt a megoldás elutasítása közben.");
        }
    } catch (error) {
        showError("Hiba történt a megoldás elutasítása közben.");
    }
}

function showError(message) {
    const errorDiv = document.createElement("div");
    errorDiv.className = "error-message";
    errorDiv.textContent = message;
    errorDiv.style.color = "red";
    errorDiv.style.padding = "10px";
    errorDiv.style.marginTop = "10px";
    
    const messageContainer = document.querySelector(".button-container");
    if(messageContainer) {
        const existingMessage = messageContainer.querySelector(".error-message, .success-message");
        if(existingMessage) {
            existingMessage.remove();
        }
        
        messageContainer.appendChild(errorDiv);
        
        setTimeout(() => {
            errorDiv.remove();
        }, 5000);
    }
}

function showMessage(message) {
    const messageDiv = document.createElement("div");
    messageDiv.className = "success-message";
    messageDiv.textContent = message;
    messageDiv.style.color = "green";
    messageDiv.style.padding = "10px";
    messageDiv.style.marginTop = "10px";
    
    const messageContainer = document.querySelector(".button-container");
    if(messageContainer) {
        const existingMessage = messageContainer.querySelector(".error-message, .success-message");
        if(existingMessage) {
            existingMessage.remove();
        }
        
        messageContainer.appendChild(messageDiv);
        
        setTimeout(() => {
            messageDiv.remove();
        }, 5000);
    }
}

function toggleEditForm() {
    const editForm = document.getElementById("edit-form");
    
    if(editForm.style.display === "none") {
        editForm.style.display = "block";
        document.getElementById("edit-request-btn").style.display = "none";
    }
    else {
        editForm.style.display = "none";
        document.getElementById("edit-request-btn").style.display = "block";
    }
}

async function saveRequestEdits() {
    const titleInput = document.getElementById("edit-title");
    const priceInput = document.getElementById("edit-price");
    const deadlineInput = document.getElementById("edit-deadline");
    const descriptionInput = document.getElementById("edit-description");
    
    if(!titleInput || !priceInput || !deadlineInput || !descriptionInput) {
        showError("Űrlap elemek nem találhatók!");
        return;
    }
    
    if(!titleInput.value.trim()) {
        showError("A cím nem lehet üres!");
        return;
    }
    
    if(priceInput.value === "" || isNaN(priceInput.value) || parseInt(priceInput.value) < 0) {
        showError("A díjazás nem lehet negatív szám!");
        return;
    }
    
    if(!deadlineInput.value) {
        showError("A határidő nem lehet üres!");
        return;
    }
    
    if(!descriptionInput.value.trim()) {
        showError("A leírás nem lehet üres!");
        return;
    }
    
    try {
        const response = await fetch("/vizsgaremek/src/api/edit_request.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "JavaScript-Fetch-Request": "edit-request"
            },
            body: JSON.stringify({
                requestId: requestid,
                title: titleInput.value.trim(),
                price: parseInt(priceInput.value),
                deadline: deadlineInput.value,
                description: descriptionInput.value.trim()
            })
        });
        
        const data = await response.json();
        
        if(data.success) {
            document.getElementById("request-title").textContent = titleInput.value.trim();
            document.getElementById("price-display").textContent = `${parseInt(priceInput.value).toLocaleString()} pont`;
            const deadlineDate = new Date(deadlineInput.value);
            document.getElementById("deadline-display").textContent = deadlineDate.toLocaleDateString('hu-HU', {year: "numeric", month: "long", day: "numeric"});
            document.getElementById("description-display").innerHTML = descriptionInput.value.trim().replace(/\n/g, '<br>');
            toggleEditForm();    
            showMessage("A felkérés sikeresen frissítve!");
        }
        else {
            showError(data.message || "Hiba történt a felkérés frissítése közben.");
        }
    }
    catch(error) {
        showError("Hiba történt a felkérés frissítése közben.");
    }
}