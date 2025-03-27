function closeModalWithAnimation(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.style.display = "none";
    }
}

document.addEventListener("DOMContentLoaded", function() {
    const sidebarItems = document.querySelectorAll(".sidebar-item");
    const tabContents = document.querySelectorAll(".tab-content");
    
    let currentPage = 1;
    let searchTerm = "";
    let totalPages = 1;
    
    sidebarItems.forEach(item => {
        item.addEventListener("click", function() {
            const tabName = this.getAttribute("data-tab");
            
            sidebarItems.forEach(item => item.classList.remove("active"));
            this.classList.add("active");
            
            tabContents.forEach(tab => {
                tab.classList.remove("active");
                if (tab.id === `${tabName}-tab`) {
                    tab.classList.add("active");
                }
            });
        });
    });
    
    fetchUsers();
    
    document.getElementById("search-button").addEventListener("click", () => {
        searchTerm = document.getElementById("user-search").value.trim();
        currentPage = 1;
        fetchUsers();
    });
    
    document.getElementById("user-search").addEventListener("keypress", (e) => {
        if(e.key === "Enter") {
            searchTerm = e.target.value.trim();
            currentPage = 1;
            fetchUsers();
        }
    });
    
    document.getElementById("prev-page").addEventListener("click", function() {
        if(currentPage > 1) {
            currentPage--;
            fetchUsers();
        }
    });
    
    document.getElementById("next-page").addEventListener("click", function() {
        if(currentPage < totalPages) {
            currentPage++;
            fetchUsers();
        }
    });
    
    async function fetchUsers() {
        const tableBody = document.getElementById("users-table-body");
        const tableContainer = document.querySelector(".users-table-container");
        
        let loadingOverlay = document.querySelector(".table-loading-overlay");
        if(!loadingOverlay) {
            loadingOverlay = document.createElement("div");
            loadingOverlay.className = "table-loading-overlay";
            loadingOverlay.innerHTML = `
                <div class="loading-spinner">
                    <div class="spinner"></div>
                    <p>Adatok betöltése...</p>
                </div>
            `;
            tableContainer.style.position = "relative";
            tableContainer.appendChild(loadingOverlay);
        }
        
        loadingOverlay.style.display = "flex";
        
        try {
            const url = `/vizsgaremek/src/api/get_users.php?page=${currentPage}&limit=10${searchTerm ? '&search=' + encodeURIComponent(searchTerm) : ''}`;
            
            const response = await fetch(url, {
                method: "GET",
                headers: {
                    "JavaScript-Fetch-Request": "get-users"
                }
            });
            const data = await response.json();
            
            if(!data.success) {
                throw new Error(data.message || "Failed to fetch users");
            }
            
            const pagination = {};
            pagination.currentPage = parseInt(data.pagination.currentPage) || 1;
            pagination.totalPages = parseInt(data.pagination.totalPages) || 1;
            pagination.totalCount = parseInt(data.pagination.totalCount) || 0;
            pagination.limit = parseInt(data.pagination.limit) || 10;
            
            if (pagination.totalPages < 1) pagination.totalPages = 1;
            if (pagination.currentPage < 1) pagination.currentPage = 1;
            if (pagination.currentPage > pagination.totalPages) pagination.currentPage = pagination.totalPages;
            
            currentPage = pagination.currentPage;
            totalPages = pagination.totalPages;
            
            displayUsers(data.users);
            renderPagination(pagination);
            
        }
        catch (error) {
            console.error("Error fetching users:", error);
            showToast("Hiba történt a felhasználók betöltésekor: " + error.message, true);
            tableBody.innerHTML = "<tr><td colspan=\"7\" class=\"table-loading\">Hiba történt a betöltés során.</td></tr>";
        }
        finally {
            setTimeout(() => {
                loadingOverlay.style.opacity = "0";
                setTimeout(() => {
                    loadingOverlay.style.display = "none";
                    loadingOverlay.style.opacity = "1";
                }, 300);
            }, 200);
        }
    }
    
    function renderPagination(pagination) {
        const pageNumbers = document.getElementById("page-numbers");
        const prevButton = document.getElementById("prev-page");
        const nextButton = document.getElementById("next-page");
        
        pageNumbers.innerHTML = '';
        
        const totalPages = Math.max(1, pagination.totalPages);
        const currentPage = Math.min(totalPages, Math.max(1, pagination.currentPage));
        
        let startPage = Math.max(1, currentPage - 2);
        let endPage = Math.min(totalPages, currentPage + 2);
        
        if(endPage - startPage < 4 && totalPages > 5) {
            if(currentPage < 3) {
                endPage = Math.min(5, totalPages);
            }
            else if(currentPage > totalPages - 2) {
                startPage = Math.max(1, totalPages - 4);
            }
        }
        
        for(let i = startPage; i <= endPage; i++) {
            const pageBtn = document.createElement("span");
            pageBtn.className = "page-number" + (i === currentPage ? " active" : "");
            pageBtn.textContent = i;
            
            pageBtn.addEventListener("click", function() {
                window.currentPage = i;
                fetchUsers();
            });
            
            pageNumbers.appendChild(pageBtn);
        }
        
        prevButton.disabled = currentPage <= 1;
        nextButton.disabled = currentPage >= totalPages;
        
        if (prevButton.disabled) {
            prevButton.classList.add("disabled");
        }
        else {
            prevButton.classList.remove("disabled");
        }
        
        if (nextButton.disabled) {
            nextButton.classList.add("disabled");
        }
        else {
            nextButton.classList.remove("disabled");
        }
    }
    
    function displayUsers(usersList) {
        const tableBody = document.getElementById("users-table-body");
        
        gsap.to(tableBody, {
            opacity: 0,
            duration: 0.1,
            onComplete: () => {
                tableBody.innerHTML = "";
                
                if(usersList.length === 0) {
                    tableBody.innerHTML = "<tr><td colspan=\"7\" class=\"table-loading\">Nincs találat</td></tr>";
                }
                else {
                    usersList.forEach(user => {
                        const row = document.createElement("tr");
                        
                        let roleText = "";
                        if (user.role === "admin") {
                            roleText = "Adminisztrátor";
                        } else if (user.role === "moderator") {
                            roleText = "Moderátor";
                        } else {
                            roleText = "Felhasználó";
                        }
                        
                        row.innerHTML = `
                            <td>${user.id}</td>
                            <td>${user.username}</td>
                            <td>${user.email}</td>
                            <td>${roleText}</td>
                            <td>${user.points}</td>
                            <td>${user.registrationDate}</td>
                            <td class="table-actions">
                                <button class="edit-btn" data-id="${user.id}">Szerkesztés</button>
                                <button class="delete-btn" data-id="${user.id}">Törlés</button>
                            </td>
                        `;
                        
                        tableBody.appendChild(row);
                    });
                    
                    document.querySelectorAll(".edit-btn").forEach(btn => {
                        btn.addEventListener("click", () => openEditModal(btn.getAttribute("data-id")));
                    });
                    
                    document.querySelectorAll(".delete-btn").forEach(btn => {
                        btn.addEventListener("click", () => openDeleteModal(btn.getAttribute("data-id")));
                    });
                }
                
                gsap.to(tableBody, {
                    opacity: 1,
                    duration: 0.2
                });
            }
        });
    }
    
    function openEditModal(userId) {
        document.getElementById("user-form").reset();
        
        const modalBody = document.querySelector("#user-modal .modal-body");
        const originalContent = modalBody.innerHTML;
        modalBody.innerHTML = `
            <div class="loading-spinner modal-spinner">
                <div class="spinner"></div>
                <p>Felhasználó adatainak betöltése...</p>
            </div>
        `;
        
        document.getElementById("modal-title").textContent = "Felhasználó szerkesztése";
        document.getElementById("user-modal").style.display = "flex";
        
        fetch(`/vizsgaremek/src/api/get_user.php?id=${userId}`, {
            headers: {
                "JavaScript-Fetch-Request": "get-user"
            }
        })
        .then(response => response.json())
        .then(data => {
            modalBody.innerHTML = originalContent;
            
            if(data.success) {
                document.getElementById("user-id").value = data.user.id;
                document.getElementById("username").value = data.user.username;
                document.getElementById("email").value = data.user.email;
                document.getElementById("role").value = data.user.role;
                document.getElementById("points").value = data.user.points;
                document.getElementById("password").value = "";
                
                setupFormSubmitHandler();
            }
            else {
                closeModalWithAnimation("user-modal");
                showToast("Hiba a felhasználó betöltésekor: " + data.message, true);
            }
        })
        .catch(error => {
            console.error("Error fetching user:", error);
            closeModalWithAnimation("user-modal");
            showToast("Hiba a felhasználó betöltésekor.", true);
        });
    }
    
    function openDeleteModal(userId) {
        const confirmBtn = document.getElementById("confirm-delete-btn");
        
        confirmBtn.removeEventListener("click", confirmBtn.deleteHandler);
        
        confirmBtn.deleteHandler = () => {
            deleteUser(userId);
        };
        
        confirmBtn.addEventListener("click", confirmBtn.deleteHandler);
        
        document.getElementById("confirm-modal").style.display = "flex";
    }
    
    function setupFormSubmitHandler() {
        const form = document.getElementById("user-form");
        
        form.removeEventListener("submit", form.submitHandler);
        
        form.submitHandler = async function(e) {
            e.preventDefault();
            
            const userId = document.getElementById("user-id").value;
            const username = document.getElementById("username").value;
            const email = document.getElementById("email").value;
            const role = document.getElementById("role").value;
            const points = document.getElementById("points").value;
            const password = document.getElementById("password").value;
            
            if (!username || !email) {
                showToast("A felhasználónév és email mezők kötelezőek.", true);
                return;
            }
            
            try {
                const response = await fetch("/vizsgaremek/src/api/update_user.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "JavaScript-Fetch-Request": "update-user"
                    },
                    body: JSON.stringify({
                        id: userId,
                        username,
                        email,
                        role,
                        points: parseInt(points),
                        password: password || null
                    })
                });
                
                const data = await response.json();
                
                if (data.success) {
                    closeModalWithAnimation("user-modal");
                    showToast("Felhasználó sikeresen frissítve.");
                    fetchUsers();
                } else {
                    showToast("Hiba a felhasználó frissítésekor: " + data.message, true);
                }
            } catch (error) {
                console.error("Error updating user:", error);
                showToast("Hiba a felhasználó frissítésekor.", true);
            }
        };
        
        form.addEventListener("submit", form.submitHandler);
    }
    
    async function deleteUser(userId) {
        try {
            const response = await fetch("/vizsgaremek/src/api/delete_user.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "JavaScript-Fetch-Request": "delete-user"
                },
                body: JSON.stringify({ id: userId })
            });
            
            const data = await response.json();
            
            closeModalWithAnimation("confirm-modal");
            
            if(data.success) {
                showToast("Felhasználó sikeresen törölve.");
                fetchUsers();
            }
            else {
                showToast("Hiba a felhasználó törlésekor: " + data.message, true);
            }
        }
        catch (error) {
            console.error("Error deleting user:", error);
            closeModalWithAnimation("confirm-modal");
            showToast("Hiba a felhasználó törlésekor.", true);
        }
    }
    
    document.getElementById("user-form").addEventListener("submit", function(e) {
        e.preventDefault();
    });
    
    document.getElementById("confirm-delete-btn").addEventListener("click", function() {
    });
    
    document.querySelectorAll(".modal").forEach(modal => {
        modal.addEventListener("click", function(event) {
            if (event.target === this) {
                closeModalWithAnimation(this.id);
            }
        });
    });
    
    function showToast(message, isError = false) {
        const toast = document.getElementById("toast-message");
        
        if (toast.timeoutId) {
            clearTimeout(toast.timeoutId);
        }
        
        toast.style.visibility = "visible";
        toast.style.opacity = "1";
        toast.style.display = "block";
        
        toast.textContent = message;
        toast.className = "toast-message show" + (isError ? " error" : "");
        
        toast.timeoutId = setTimeout(() => {
            toast.className = "toast-message";
            
            setTimeout(() => {
                if (!toast.className.includes("show")) {
                    toast.style.opacity = "0";
                    toast.style.visibility = "hidden";
                    toast.textContent = "";
                }
            }, 500);
        }, 3000);
    }
    
    fetchUsers();
});