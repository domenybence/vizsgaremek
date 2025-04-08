document.addEventListener("DOMContentLoaded", () => {
    const acceptRequestButton = document.querySelector(".accept-request");
    const submitSolutionButton = document.querySelector(".submit-solution");
    const acceptSolutionButton = document.querySelector(".accept-solution");
    const rejectSolutionButton = document.querySelector(".reject-solution");
    const saveSolutionButton = document.getElementById("save-solution");
    const editRequestBtn = document.getElementById("edit-request-btn");
    const cancelEditBtn = document.getElementById("cancel-edit-btn");
    const saveEditBtn = document.getElementById("save-edit-btn");
    const deleteRequestBtn = document.getElementById("delete-request-btn");
    const editForm = document.getElementById("edit-form");

    if(userRole === "admin" || userRole === "moderator") {
        showAdminControls();
    }

    acceptRequestButton?.addEventListener("click", () => acceptRequest(requestid));
    submitSolutionButton?.addEventListener("click", () => submitSolution());
    acceptSolutionButton?.addEventListener("click", () => acceptSolution(requestid));
    rejectSolutionButton?.addEventListener("click", () => rejectSolution(requestid));
    saveSolutionButton?.addEventListener("click", () => saveSolution());
    editRequestBtn?.addEventListener("click", toggleEditForm);
    cancelEditBtn?.addEventListener("click", toggleEditForm);
    deleteRequestBtn?.addEventListener("click", () => deleteRequest(requestid));
    
    if(editForm) {
        editForm.addEventListener("submit", function(e) {
            e.preventDefault();
            saveRequestEdits();
        });
    }
    
    if(saveEditBtn) {
        saveEditBtn.addEventListener("click", function(e) {
            e.preventDefault();
            saveRequestEdits();
        });
    }
});

function showAdminControls() {
    let editSection = document.querySelector(".edit-section");
    if (!editSection) {
        editSection = document.createElement("div");
        editSection.className = "edit-section";
        document.querySelector(".content").appendChild(editSection);
    }
    
    const editBtn = document.getElementById("edit-request-btn");
    
    if (!document.getElementById("admin-delete-request-btn")) {
        const deleteBtn = document.createElement("button");
        deleteBtn.id = "admin-delete-request-btn";
        deleteBtn.className = "button danger";
        deleteBtn.textContent = "Felkérés törlése";
        deleteBtn.style.marginLeft = "10px";
        deleteBtn.addEventListener("click", () => deleteRequest(requestid));
        
        if(editBtn) {
            editBtn.parentNode.insertBefore(deleteBtn, editBtn.nextSibling);
        }
        else {
            const newEditBtn = document.createElement("button");
            newEditBtn.id = "edit-request-btn";
            newEditBtn.className = "button primary";
            newEditBtn.textContent = "Felkérés szerkesztése";
            newEditBtn.addEventListener("click", toggleEditForm);
            
            editSection.appendChild(newEditBtn);
            editSection.appendChild(deleteBtn);
        }
    }
    if(!document.getElementById("edit-form")) {
        createAdminEditForm();
    }
}

function createAdminEditForm() {
    const contentDiv = document.querySelector(".content");
    if(!contentDiv) return;
    
    const editForm = document.createElement("div");
    editForm.id = "edit-form";
    editForm.className = "edit-form";
    editForm.style.display = "none";
    
    const currentTitle = document.getElementById("request-title").textContent;
    const currentPrice = document.getElementById("price-display").textContent.replace(/[^\d]/g, "");
    const currentDeadline = document.getElementById("deadline-display").getAttribute("data-raw-date") || "";
    const currentDescription = document.getElementById("description-display").innerHTML.replace(/<br>/g, "\n");
    
    editForm.innerHTML = `
        <h3>Felkérés szerkesztése</h3>
        <div class="form-group">
            <label for="edit-title">Cím</label>
            <input type="text" id="edit-title" class="form-control" value="${currentTitle}">
        </div>
        <div class="form-group">
            <label for="edit-price">Díjazás (pont)</label>
            <input type="number" id="edit-price" class="form-control" value="${currentPrice}">
        </div>
        <div class="form-group">
            <label for="edit-deadline">Határidő</label>
            <input type="date" id="edit-deadline" class="form-control" value="${currentDeadline}">
        </div>
        <div class="form-group">
            <label for="edit-description">Leírás</label>
            <textarea id="edit-description" class="form-control" rows="6">${currentDescription}</textarea>
        </div>
        <div class="button-group">
            <button id="cancel-edit-btn" class="button secondary">Mégse</button>
            <button id="save-edit-btn" class="button success">Mentés</button>
        </div>
    `;
    
    contentDiv.appendChild(editForm);
    
    document.getElementById("cancel-edit-btn").addEventListener("click", toggleEditForm);
    document.getElementById("save-edit-btn").addEventListener("click", (e) => {
        e.preventDefault();
        saveRequestEdits();
    });
}

async function acceptRequest(requestId) {
    try {
        const response = await fetch("/src/api/accept_request.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "JavaScript-Fetch-Request": "accept-request"
            },
            body: JSON.stringify({ requestId })
        });
        const data = await response.json();     
        if(data.success) {
            translateOut(window.location.href);
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
        
        const response = await fetch("/src/api/save_solution.php", {
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

function submitSolution() {
    const code = window.monacoEditor.getValue();
    
    if(!code.trim()) {
        showError("Kérjük, adjon meg kódot a beküldéshez!");
        return;
    }
    
    fetch("/src/api/submit_solution.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "JavaScript-Fetch-Request": "submit-solution"
        },
        body: JSON.stringify({ 
            requestId: requestid,
            code: code
        })
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            showBasicSuccessDialog("A megoldás sikeresen beküldve!");
            setTimeout(() => {
                translateOut(window.location.href);
            }, 1500);
        } else {
            showError(data.message || "Hiba történt a kód beküldése során.");
        }
    })
    .catch(() => {
        showError("Hiba történt a kód beküldése során.");
    });
}

async function acceptSolution(requestId) {
    try {
        const response = await fetch("/src/api/accept_solution.php", {
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
            translateOut();
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

function rejectSolution(requestId) {
    const existingModal = document.querySelector(".modal-overlay");
    if(existingModal) existingModal.remove();
    
    const modalCode = `
    <div class="modal-overlay">
        <div class="modal-error-popup">
            <div class="modal-header">
                <h3>Kód elutasítása</h3>
                <svg xmlns="http://www.w3.org/2000/svg" id="svg_x" width="35" height="35" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                </svg>
            </div>
            <hr>
            <div class="content">
                <p>Biztosan el szeretné utasítani a beküldött kódot?</p>
            </div>
            <hr>
            <div class="button-container">
                <button id="cancel-reject-btn" class="button secondary">Mégsem</button>
                <button id="confirm-reject-btn" class="button danger">Elutasítás</button>
            </div>
        </div>
    </div>`;

    document.body.insertAdjacentHTML("beforeend", modalCode);
    
    document.querySelector("#svg_x").addEventListener("click", closeModal);
    document.querySelector("#cancel-reject-btn").addEventListener("click", closeModal);
    document.querySelector("#confirm-reject-btn").addEventListener("click", function() {
        closeModal();
        
        fetch("/src/api/reject_solution.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "JavaScript-Fetch-Request": "reject-solution"
            },
            body: JSON.stringify({ 
                requestId,
                reason: "Megoldás elutasítva"
            })
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                showMessage(data.message);
                setTimeout(() => {
                    location.reload();
                }, 2000);
            } else {
                showError(data.message || "Hiba történt a megoldás elutasítása közben.");
            }
        })
        .catch(() => {
            showError("Hiba történt a megoldás elutasítása közben.");
        });
    });
}

function deleteRequest(requestId) {
    const existingModal = document.querySelector(".modal-overlay");
    if(existingModal) existingModal.remove();
    
    const modalCode = `
    <div class="modal-overlay">
        <div class="modal-error-popup">
            <div class="modal-header">
                <h3>Megerősítés</h3>
                <svg xmlns="http://www.w3.org/2000/svg" id="svg_x" width="35" height="35" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                </svg>
            </div>
            <hr>
            <div class="content">
                <p>Biztosan törölni szeretné ezt a felkérést?</p>
            </div>
            <hr>
            <div class="button-container">
                <button id="cancel-confirm-btn" class="button secondary">Mégsem</button>
                <button id="confirm-btn" class="button danger">Megerősítés</button>
            </div>
        </div>
    </div>`;

    document.body.insertAdjacentHTML("beforeend", modalCode);
    
    document.querySelector("#svg_x").addEventListener("click", closeModal);
    document.querySelector("#cancel-confirm-btn").addEventListener("click", closeModal);
    
    document.querySelector("#confirm-btn").addEventListener("click", function() {
        closeModal();
        
        const preloader = document.querySelector(".page-cover");
        if (preloader) preloader.style.display = "flex";
        
        fetch("/src/api/delete_request.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "JavaScript-Fetch-Request": "delete-request"
            },
            body: JSON.stringify({ requestId })
        })
        .then(response => response.json())
        .then(data => {
            if (preloader) preloader.style.display = "none";
            
            if(data.success) {
                showSuccessAndRedirect(data.message);
            } else {
                showError(data.message || "Hiba történt a felkérés törlése közben.");
            }
        })
        .catch(() => {
            if (preloader) preloader.style.display = "none";
            showError("Hiba történt a felkérés törlése közben.");
        });
    });
}

function showSuccessAndRedirect(message) {
    const existingModal = document.querySelector(".modal-overlay");
    if(existingModal) existingModal.remove();
    
    const modalCode = `
    <div class="modal-overlay">
        <div class="modal-success-popup">
            <div class="modal-header">
                <h3>Sikeres művelet!</h3>
                <svg xmlns="http://www.w3.org/2000/svg" id="svg_x" width="35" height="35" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                </svg>
            </div>
            <hr>
            <div class="content">
                <p>${message}</p>
            </div>
            <hr>
            <div class="button-container">
                <button id="success-ok-btn" class="button success">OK</button>
            </div>
        </div>
    </div>`;

    document.body.insertAdjacentHTML("beforeend", modalCode);
    
    document.querySelector("#svg_x").addEventListener("click", () => {
        closeModal();
        translateOut("/felkeresek/bongeszes");
    });
    
    document.querySelector("#success-ok-btn").addEventListener("click", () => {
        closeModal();
        translateOut("/felkeresek/bongeszes");
    });
}

function showBasicConfirmDialog(message, confirmCallback) {
    const existingModal = document.querySelector(".modal-overlay");
    if(existingModal) existingModal.remove();
    
    const modalCode = `
    <div class="modal-overlay">
        <div class="modal-error-popup">
            <div class="modal-header">
                <h3>Megerősítés</h3>
                <svg xmlns="http://www.w3.org/2000/svg" id="svg_x" width="35" height="35" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                </svg>
            </div>
            <hr>
            <div class="content">
                <p>${message}</p>
            </div>
            <hr>
            <div class="button-container">
                <button id="cancel-confirm-btn" class="button secondary">Mégsem</button>
                <button id="confirm-btn" class="button danger">Megerősítés</button>
            </div>
        </div>
    </div>`;

    document.body.insertAdjacentHTML("beforeend", modalCode);
    
    document.querySelector("#svg_x").addEventListener("click", closeModal);
    document.querySelector("#cancel-confirm-btn").addEventListener("click", closeModal);
    document.querySelector("#confirm-btn").addEventListener("click", function() {
        closeModal();
        if(confirmCallback) confirmCallback();
    });
}

function showBasicSuccessDialog(message) {
    const existingModal = document.querySelector(".modal-overlay");
    if(existingModal) existingModal.remove();
    
    const modalCode = `
    <div class="modal-overlay">
        <div class="modal-success-popup">
            <div class="modal-header">
                <h3>Sikeres művelet!</h3>
                <svg xmlns="http://www.w3.org/2000/svg" id="svg_x" width="35" height="35" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                </svg>
            </div>
            <hr>
            <div class="content">
                <p>${message}</p>
            </div>
            <hr>
            <div class="button-container">
                <button id="success-ok-btn" class="button success">OK</button>
            </div>
        </div>
    </div>`;

    document.body.insertAdjacentHTML("beforeend", modalCode);
    
    document.querySelector("#svg_x").addEventListener("click", closeModal);
    document.querySelector("#success-ok-btn").addEventListener("click", closeModal);
}

function closeModal() {
    const modal = document.querySelector(".modal-overlay");
    if(modal) {
        modal.style.opacity = 0;
        modal.style.transition = "opacity 0.3s ease";
        setTimeout(() => {
            modal.remove();
        }, 300);
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
    const editButton = document.getElementById("edit-request-btn");
    
    const isFormVisible = window.getComputedStyle(editForm).display !== "none";
    
    if (!isFormVisible) {
        editForm.style.display = "block";
        editButton.style.display = "none";
    } else {
        editForm.style.display = "none";
        editButton.style.display = "";
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
        const response = await fetch("/src/api/edit_request.php", {
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
            document.getElementById("deadline-display").textContent = deadlineDate.toLocaleDateString("hu-HU", {year: "numeric", month: "long", day: "numeric"});
            document.getElementById("description-display").innerHTML = descriptionInput.value.trim().replace(/\n/g, "<br>");
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