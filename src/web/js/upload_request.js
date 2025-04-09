document.addEventListener("DOMContentLoaded", () => {
    const createButton = document.getElementById("create-request-btn");
    const messageContainer = document.getElementById("message-container");
    const categorySelect = document.getElementById("request-category");
    const preloader = document.querySelector(".page-cover");
    
    const deadlineInput = document.getElementById("request-deadline");
    if (deadlineInput) {
        const today = new Date();
        const formattedDate = today.toISOString().split("T")[0];
        deadlineInput.min = formattedDate;
        
        const tomorrow = new Date();
        tomorrow.setDate(tomorrow.getDate() + 1);
        deadlineInput.value = tomorrow.toISOString().split("T")[0];
        deadlineInput.setAttribute("lang", "hu");
        document.documentElement.setAttribute("lang", "hu");
    }
    
    if (preloader) preloader.style.display = "flex";
    
    fetchCategories();
    
    createButton?.addEventListener("click", createRequest);
    
    async function fetchCategories() {
        try {
            const response = await fetch("/src/api/get_categories.php", {
                method: "GET",
                headers: {
                    "Content-Type": "application/json",
                    "JavaScript-Fetch-Request": "get-categories"
                }
            });
            
            const data = await response.json();
            
            if(data.success) {
                populateCategoryDropdown(data.categories);
            }
            else {
                showError("Kategóriák betöltése sikertelen.");
            }
        }
        catch(error) {
            showError("Hiba történt a kategóriák betöltése közben.");
        }
    }
    
    function populateCategoryDropdown(categories) {
        categorySelect.innerHTML = "";
        
        if(categories && categories.length > 0) {
            categories.forEach(category => {
                const option = document.createElement("option");
                option.value = category.id;
                option.textContent = category.nev;
                categorySelect.appendChild(option);
            });
        }
        else {
            const option = document.createElement("option");
            option.value = "";
            option.textContent = "Nincs elérhető kategória";
            categorySelect.appendChild(option);
        }
    }
    
    function showError(message) {
        messageContainer.innerHTML = "";
        const errorDiv = document.createElement("div");
        errorDiv.className = "error-message";
        errorDiv.textContent = message;
        errorDiv.style.color = "red";
        errorDiv.style.padding = "10px";
        errorDiv.style.marginTop = "10px";
        messageContainer.appendChild(errorDiv);
    }
    
    function showSuccess(message) {
        messageContainer.innerHTML = "";
        const successDiv = document.createElement("div");
        successDiv.className = "success-message";
        successDiv.textContent = message;
        successDiv.style.color = "green";
        successDiv.style.padding = "10px";
        successDiv.style.marginTop = "10px";
        messageContainer.appendChild(successDiv);
    }
    
    function validateForm() {
        const title = document.getElementById("request-title").value.trim();
        const category = document.getElementById("request-category").value;
        const price = document.getElementById("request-price").value;
        const deadline = document.getElementById("request-deadline").value;
        const description = document.getElementById("request-description").value.trim();
        
        if(!title) {
            showError("A cím nem lehet üres!");
            return false;
        }
        
        if(!category) {
            showError("Kérjük, válasszon kategóriát!");
            return false;
        }
        
        if(price === "" || isNaN(price) || parseInt(price) < 0) {
            showError("A díjazás nem lehet negatív szám!");
            return false;
        }
        
        if(!deadline) {
            showError("A határidő nem lehet üres!");
            return false;
        }
        
        const deadlineDate = new Date(deadline);
        const today = new Date();
        today.setHours(0, 0, 0, 0);
        
        if(deadlineDate < today) {
            showError("A határidő nem lehet korábbi, mint a mai nap!");
            return false;
        }
        
        if(!description) {
            showError("A leírás nem lehet üres!");
            return false;
        }
        
        return true;
    }
    
    async function createRequest() {
        if(!validateForm()) {
            return;
        }
        
        const title = document.getElementById("request-title").value.trim();
        const categoryId = document.getElementById("request-category").value;
        const price = parseInt(document.getElementById("request-price").value);
        const deadline = document.getElementById("request-deadline").value;
        const description = document.getElementById("request-description").value.trim();
        
        try {
            const response = await fetch("/src/api/create_request.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "JavaScript-Fetch-Request": "create-request"
                },
                body: JSON.stringify({
                    title,
                    categoryId,
                    price,
                    deadline,
                    description
                })
            });
            const data = await response.json();
            
            if(data.success) {
                showSuccess("A felkérés sikeresen létrehozva!");
                
                document.getElementById("request-title").value = "";
                document.getElementById("request-price").value = "";
                document.getElementById("request-deadline").value = "";
                document.getElementById("request-description").value = "";
                
                setTimeout(() => {
                    translateOut("/felkeresek/bongeszes");
                }, 2000);
            }
            else {
                showError(data.message || "Hiba történt a felkérés létrehozása közben.");
            }
        }
        catch(error) {
            showError("Hiba történt a felkérés létrehozása közben.");
        }
    }
});
