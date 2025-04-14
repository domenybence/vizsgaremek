function fetchCategories() {
    fetch("./src/web/index.php/kategoriak")
        .then((response) => response.json())
        .then((categories) => {
            const tableBody = document.getElementById("categories-table-body");
            tableBody.innerHTML = "";

            categories.forEach((category) => {
                const row = document.createElement("tr");
                row.innerHTML = `
                    <td>${category.id}</td>
                    <td>${category.nev}</td>
                    <td>${category.compiler_azonosito}</td>
                    <td>${category.kep}</td>
                    <td>
                        <button class="edit-category-btn" onclick="openCategoryEditModal(${category.id})">Szerkesztés</button>
                        <button class="delete-category-btn" onclick="openCategoryDeleteModal(${category.id})">Törlés</button>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        })
        .catch((error) =>
            console.error("Hiba a kategóriák betöltése közben:", error)
        );
}

fetchCategories();

function setupNewCategoryFormSubmitHandler() {
    const form = document.getElementById("new-category-form");

    form.removeEventListener("submit", form.submitHandler);

    form.submitHandler = async function (e) {
        e.preventDefault();

        const nev = document.getElementById("new-category-name").value;
        const compiler_azonosito = document.getElementById(
            "new-category-compiler"
        ).value;
        const kep = document.getElementById("new-category-image").value;

        if (!nev || !compiler_azonosito || !kep) {
            showToast("Kérem töltse ki az összes mezőt!", true);
            return;
        }

        try {
            const response = await fetch("/src/api/create_category.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "JavaScript-Fetch-Request": "create-category",
                },
                body: JSON.stringify({
                    nev: nev,
                    compiler_azonosito,
                    kep,
                }),
            });

            const data = await response.json();

            if (data.success) {
                closeModalWithAnimation("new-category-modal");
                showToast("Kategória sikeresen feltöltve.");
                fetchCategories();
            } else {
                showToast("Hiba a kategória feltöltésekor: " + data.message, true);
            }
        } catch (error) {
            console.error("Error creating category:", error);
            showToast("Hiba a kategória feltöltésekor.", true);
        }
    };

    form.addEventListener("submit", form.submitHandler);
}

function openNewCategoryEditModal() {
    setupNewCategoryFormSubmitHandler();

    document.getElementById("new-category-modal").style.display = "flex";
}

function setupCategoryFormSubmitHandler() {
    const form = document.getElementById("category-form");

    form.removeEventListener("submit", form.submitHandler);

    form.submitHandler = async function (e) {
        e.preventDefault();

        const id = document.getElementById("category-id").value;
        const nev = document.getElementById("category-name").value;
        const compiler_azonosito =
            document.getElementById("category-compiler").value;
        const kep = document.getElementById("category-image").value;

        if (!id || !nev || !compiler_azonosito || !kep) {
            showToast("Kérem töltse ki az összes mezőt!", true);
            return;
        }

        try {
            const response = await fetch("/src/api/update_category.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "JavaScript-Fetch-Request": "update-category",
                },
                body: JSON.stringify({
                    id: id,
                    nev,
                    compiler_azonosito,
                    kep,
                }),
            });

            const data = await response.json();

            if (data.success) {
                closeModalWithAnimation("category-modal");
                showToast("Kategória sikeresen frissítve.");
                fetchCategories();
            } else {
                showToast("Hiba a kategória frissítésekor: " + data.message, true);
            }
        } catch (error) {
            console.error("Error updating category:", error);
            showToast("Hiba a kategória frissítésekor.", true);
        }
    };

    form.addEventListener("submit", form.submitHandler);
}

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

function closeModalWithAnimation(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.style.display = "none";
    }
}

function openCategoryEditModal(categoryId) {
    async function getData() {
        const url = "./src/web/index.php/kat";
        try {
            const response = await fetch(url, {
                method: "POST",
                body: JSON.stringify({ kategoria: categoryId }),
            });
            if (!response.ok) {
                throw new Error(`Response status: ${response.status}`);
            }

            const json = await response.json();
            document.getElementById("category-id").value = json[0].id;
            document.getElementById("category-name").value = json[0].nev;
            document.getElementById("category-compiler").value =
                json[0].compiler_azonosito;
            document.getElementById("category-image").value = json[0].kep;

            setupCategoryFormSubmitHandler();

        } catch (error) {
            console.error(error.message);
        }
    }
    getData();

    document.getElementById("category-modal").style.display = "flex";
}

function openCategoryDeleteModal(categoryId) {
    document
        .getElementById("confirm-category-delete-btn")
        .setAttribute("data-category-id", categoryId);

    const confirmBtn = document.getElementById("confirm-category-delete-btn");

    confirmBtn.removeEventListener("click", confirmBtn.deleteHandler);

    confirmBtn.deleteHandler = () => {
        deleteCategory(categoryId);
    };

    confirmBtn.addEventListener("click", confirmBtn.deleteHandler);

    document.getElementById("confirm-category-modal").style.display = "flex";
}

async function deleteCategory(categoryId) {
    try {
        const response = await fetch("/src/api/delete_category.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "JavaScript-Fetch-Request": "delete-category",
            },
            body: JSON.stringify({ id: categoryId }),
        });

        const data = await response.json();

        closeModalWithAnimation("confirm-modal");

        if (data.success) {
            showToast("Kategória sikeresen törölve.");
            fetchCategories();
        } else {
            showToast("Hiba a kategória törlésekor: " + data.message, true);
        }
    }
    catch (error) {
        console.error("Error kategória user:", error);
        closeModalWithAnimation("confirm-modal");
        showToast("Hiba a kategória törlésekor.", true);
    }
}

document.addEventListener("DOMContentLoaded", function () {
    const sidebarItems = document.querySelectorAll(".sidebar-item");
    const tabContents = document.querySelectorAll(".tab-content");

    let searchTerm = "";

    sidebarItems.forEach((item) => {
        item.addEventListener("click", function () {
            const tabName = this.getAttribute("data-tab");

            sidebarItems.forEach((item) => item.classList.remove("active"));
            this.classList.add("active");

            tabContents.forEach((tab) => {
                tab.classList.remove("active");
                if (tab.id === `${tabName}-tab`) {
                    tab.classList.add("active");
                }
            });
        });
    });

    initializeAdmin();
    
    function initializeAdmin() {
        if (window.adminInitialized) return;
        window.adminInitialized = true;
        
        const searchButton = document.getElementById("search-button");
        const searchInput = document.getElementById("user-search");
        
        if (searchButton) {
            searchButton.addEventListener("click", function() {
                searchTerm = searchInput ? searchInput.value.trim() : "";
                fetchUsers();
            });
        }

        if (searchInput) {
            searchInput.addEventListener("keypress", function(e) {
                if (e.key === "Enter") {
                    searchTerm = this.value.trim();
                    fetchUsers();
                }
            });
        }
        
        fetchUsers();
    }

    async function fetchUsers() {
        const tableBody = document.getElementById("users-table-body");
        const tableContainer = document.querySelector(".users-table-container");

        let loadingOverlay = document.querySelector(".table-loading-overlay");
        if (!loadingOverlay) {
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
            const url = `/src/api/get_users.php${searchTerm ? "?search=" + encodeURIComponent(searchTerm) : ""}`;
            const response = await fetch(url, {
                method: "GET",
                headers: {
                    "JavaScript-Fetch-Request": "get-users"
                }
            });
            
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            
            const data = await response.json();

            if (!data.success) {
                throw new Error(data.message || "Failed to fetch users");
            }

            if (!data.users || !Array.isArray(data.users)) {
                throw new Error("Invalid data format: users array is missing");
            }

            displayUsers(data.users);
        } catch (error) {
            console.error("Error fetching users:", error);
            showToast("Hiba történt a felhasználók betöltésekor: " + error.message, true);
            tableBody.innerHTML = '<tr><td colspan="7" class="table-loading">Hiba történt a betöltés során.</td></tr>';
        } finally {
            setTimeout(() => {
                loadingOverlay.style.opacity = "0";
                setTimeout(() => {
                    loadingOverlay.style.display = "none";
                    loadingOverlay.style.opacity = "1";
                }, 300);
            }, 200);
        }
    }

    function displayUsers(usersList) {
        const tableBody = document.getElementById("users-table-body");
        const currentUserId = parseInt(
            document.body.getAttribute("data-current-userid")
        );

        gsap.to(tableBody, {
            opacity: 0,
            duration: 0.1,
            onComplete: () => {
                tableBody.innerHTML = "";

                if (usersList.length === 0) {
                    tableBody.innerHTML =
                        '<tr><td colspan="7" class="table-loading">Nincs találat</td></tr>';
                } else {
                    usersList.forEach((user) => {
                        const row = document.createElement("tr");
                        const isCurrentUser = parseInt(user.id) === currentUserId;

                        if (isCurrentUser) {
                            row.classList.add("current-user-row");
                        }

                        let roleText = "";
                        if (user.role === "admin") {
                            roleText = "Adminisztrátor";
                        } else if (user.role === "moderator") {
                            roleText = "Moderátor";
                        } else {
                            roleText = "Felhasználó";
                        }

                        const actionButtons = isCurrentUser
                            ? '<span class="disabled-actions">Saját fiók</span>'
                            : `<button class="edit-btn" data-id="${user.id}">Szerkesztés</button>
                             <button class="delete-btn" data-id="${user.id}">Törlés</button>`;

                        row.innerHTML = `
                            <td>${user.id}</td>
                            <td>${user.username}${isCurrentUser ? " (Te)" : ""
                            }</td>
                            <td>${user.email}</td>
                            <td>${roleText}</td>
                            <td>${user.points}</td>
                            <td>${user.registrationDate}</td>
                            <td class="table-actions">
                                ${actionButtons}
                            </td>
                        `;

                        tableBody.appendChild(row);
                    });

                    document.querySelectorAll(".edit-btn").forEach((btn) => {
                        btn.addEventListener("click", () =>
                            openEditModal(btn.getAttribute("data-id"))
                        );
                    });

                    document.querySelectorAll(".delete-btn").forEach((btn) => {
                        btn.addEventListener("click", () =>
                            openDeleteModal(btn.getAttribute("data-id"))
                        );
                    });
                }

                gsap.to(tableBody, {
                    opacity: 1,
                    duration: 0.2,
                });
            },
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

        document.getElementById("modal-title").textContent =
            "Felhasználó szerkesztése";
        document.getElementById("user-modal").style.display = "flex";

        fetch(`/src/api/get_user.php?id=${userId}`, {
            headers: {
                "JavaScript-Fetch-Request": "get-user",
            },
        })
            .then((response) => response.json())
            .then((data) => {
                modalBody.innerHTML = originalContent;

                if (data.success) {
                    document.getElementById("user-id").value = data.user.id;
                    document.getElementById("username").value = data.user.username;
                    document.getElementById("email").value = data.user.email;
                    document.getElementById("role").value = data.user.role;
                    document.getElementById("points").value = data.user.points;
                    document.getElementById("password").value = "";

                    setupFormSubmitHandler();
                } else {
                    closeModalWithAnimation("user-modal");
                    showToast("Hiba a felhasználó betöltésekor: " + data.message, true);
                }
            })
            .catch((error) => {
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

        form.submitHandler = async function (e) {
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
                const response = await fetch("/src/api/update_user.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "JavaScript-Fetch-Request": "update-user",
                    },
                    body: JSON.stringify({
                        id: userId,
                        username,
                        email,
                        role,
                        points: parseInt(points),
                        password: password || null,
                    }),
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
            const response = await fetch("/src/api/delete_user.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "JavaScript-Fetch-Request": "delete-user",
                },
                body: JSON.stringify({ id: userId }),
            });

            const data = await response.json();

            closeModalWithAnimation("confirm-modal");

            if (data.success) {
                showToast("Felhasználó sikeresen törölve.");
                fetchUsers();
            } else {
                showToast("Hiba a felhasználó törlésekor: " + data.message, true);
            }
        } catch (error) {
            console.error("Error deleting user:", error);
            closeModalWithAnimation("confirm-modal");
            showToast("Hiba a felhasználó törlésekor.", true);
        }
    }

    document.getElementById("user-form").addEventListener("submit", function (e) {
        e.preventDefault();
    });

    document
        .getElementById("confirm-delete-btn")
        .addEventListener("click", function () { });

    document.querySelectorAll(".modal").forEach((modal) => {
        modal.addEventListener("click", function (event) {
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
