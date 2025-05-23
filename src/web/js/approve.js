document.addEventListener("DOMContentLoaded", () => {
    const softwareContainer = document.getElementById("szoftverek");
    const paginationContainer = document.createElement("div");
    paginationContainer.classList.add("pagination-container", "mt-3", "d-flex", "justify-content-center");
    softwareContainer.parentNode.appendChild(paginationContainer);
    //Segédvüggvény
    function $(id) {
        return document.getElementById(id);
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

    let currentPage = 1;
    const itemsPerPage = 9;
    let softwareData = [];
    //Szoftverek adatbázisból való lekérése
    async function fetchSoftware(endpoint, bodyData = null) {
        try {
            const options = bodyData ? {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify(bodyData)
            } : {};

            let response = await fetch(endpoint, options);
            let data = await response.json();

            if (response.ok) {
                softwareData = data;
                currentPage = 1;
                displaySoftware();

                softwareContainer.addEventListener('click', async (event) => {
                    if (event.target.tagName === 'BUTTON' && event.target.hasAttribute('id') && event.target.classList.contains("jovahagyas-btn")) {
                        const itemId = event.target.getAttribute('id');
                        console.log(itemId);
                        if (!itemId) return;

                        const response = await fetch("./jovahagyas",{
                            method: "POST",
                            headers:{
                                "Content-Type": "application/json"
                            },
                            body: JSON.stringify({
                                id: itemId 
                            })
                        });
                          const data = await response.json();
                            console.log(data);
                            showToast(data);
                            fetchSoftware("./jovahagyando");

                        currentPage = 1;
                        displaySoftware();
                    }
                });

            } else {
               
            }
        } catch (error) {
            console.error(error);
            
        }
    }
    //Szoftverek megjelenítése
    function displaySoftware() {
        softwareContainer.innerHTML = "<ul class='list-group'>";
        let start = (currentPage - 1) * itemsPerPage;
        let end = start + itemsPerPage;
        let paginatedItems = softwareData.slice(start, end);
      
        paginatedItems.forEach((item) => {
          let listItem = `
            <li class="list-group-item d-flex justify-content-between align-items-center">
              <div>
                <h5 class="mb-1">${item.nev}</h5>
                <p class="mb-1">${item.katnev}</p>
              </div>
              <div>
                <a href="./kod/${item.id}" class="btn btn-dark">Megtekintés</a>
                <button class="btn jovahagyas-btn" type="button" data-id="${item.id}">Jóváhagyás</button>
                <button class="btn disapprove-btn mx-2" type="button" data-id="${item.id}">Elutasítás</button>
              </div>
            </li>`;
          softwareContainer.innerHTML += listItem;
        });
      
        softwareContainer.innerHTML += "</ul>";
      
        setupPagination();
      }

    function setupPagination() {
        paginationContainer.innerHTML = "";
        let pageCount = Math.ceil(softwareData.length / itemsPerPage);

        for (let i = 1; i <= pageCount; i++) {
            let btn = document.createElement("button");
            btn.classList.add("btn", "btn-outline-dark", "mx-1");
            btn.textContent = i;
            if (i === currentPage) btn.classList.add("btn-primary");

            btn.addEventListener("click", () => {
                currentPage = i;
                displaySoftware();
            });

            paginationContainer.appendChild(btn);
        }
    }

    //Koszinusz szimilaritás
    function wordCountMap(str) {
        let words = str.split(' ');
        let wordCount = {};
        words.forEach((w) => {
            wordCount[w] = (wordCount[w] || 0) + 1;

        });
        return wordCount;
    }

    function addWordsToDictionary(wordCountmap, dict) {
        for (let key in wordCountmap) {
            dict[key] = true;
        }
    }

    function wordMapToVector(map, dict) {
        let wordCountVector = [];
        for (let term in dict) {
            wordCountVector.push(map[term] || 0);
        }
        return wordCountVector;
    }

    function dotProduct(vecA, vecB) {
        let product = 0;
        for (let i = 0; i < vecA.length; i++) {
            product += vecA[i] * vecB[i];
        }
        return product;
    }

    function magnitude(vec) {
        let sum = 0;
        for (let i = 0; i < vec.length; i++) {
            sum += vec[i] * vec[i];
        }
        return Math.sqrt(sum);
    }

    function cosineSimilarity(vecA, vecB) {
        return dotProduct(vecA, vecB) / (magnitude(vecA) * magnitude(vecB));
    }

    function textCosineSimilarity(txtA, txtB) {
        const wordCountA = wordCountMap(txtA);
        const wordCountB = wordCountMap(txtB);
        let dict = {};
        addWordsToDictionary(wordCountA, dict);
        addWordsToDictionary(wordCountB, dict);
        const vectorA = wordMapToVector(wordCountA, dict);
        const vectorB = wordMapToVector(wordCountB, dict);
        return cosineSimilarity(vectorA, vectorB);
    }


    $("keresobtn").addEventListener("click", async () => {
        const query = document.getElementById("kereso").value.trim().toLowerCase();
        if (!query) return;

        let response = await fetch("./src/web/index.php/jovahagyando");
        let data = await response.json();

        softwareData = data.filter(
            (item) => item.nev.toLowerCase().includes(query) || textCosineSimilarity(query, item.nev) > 0.4
        );

        currentPage = 1;
        displaySoftware();
        document.getElementById("kereso").value = "";
    });



    // Event listenerek
    softwareContainer.addEventListener('click', async (event) => {
        // Elfogadás gomb megnyomás kezelése
        if (event.target.classList.contains("jovahagyas-btn")) {
            const itemId = event.target.dataset.id;
            if (!itemId) return;

            try {
                const response = await fetch("./src/web/index.php/jovahagyas", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        id: itemId 
                    })
                });

                const data = await response.json();
                if (data === "Sikeres művelet!") {
                    showSuccessMessage("Kód sikeresen jóváhagyva!");
                    // Item eltüntetése
                    event.target.closest('li').remove();
                    // softwareData array frissítése
                    softwareData = softwareData.filter(item => item.id != itemId);
                    displaySoftware();
                } else {
                    showErrorMessage("Hiba történt a jóváhagyás során!");
                }
            } catch (error) {
                console.error(error);
                showErrorMessage("Hiba történt a jóváhagyás során!");
            }
        }
        
        // Elutasítás gomb megnyomás kezelése
        if (event.target.classList.contains("disapprove-btn")) {
            const itemId = event.target.dataset.id;
            if (!itemId) return;

            if (confirm("Biztosan el szeretné utasítani és törölni ezt a kódot?")) {
                try {
                    const response = await fetch("./src/web/index.php/kod_torles", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({
                            id: itemId 
                        })
                    });

                    const data = await response.json();
                    if (data === "Sikeres művelet!") {
                        showSuccessMessage("Kód sikeresen elutasítva és törölve!");
                        // Item eltüntetése
                        event.target.closest('li').remove();
                        // softwareData array frissítése
                        softwareData = softwareData.filter(item => item.id != itemId);
                        displaySoftware();
                    } else {
                        showErrorMessage("Hiba történt az elutasítás során!");
                    }
                } catch (error) {
                    console.error(error);
                    showErrorMessage("Hiba történt az elutasítás során!");
                }
            }
        }
    });

    function showSuccessMessage(message) {
        const alertDiv = document.createElement('div');
        alertDiv.className = 'alert alert-success alert-dismissible fade show';
        alertDiv.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        `;
        document.querySelector('.container').prepend(alertDiv);
        
       
        setTimeout(() => {
            alertDiv.classList.remove('show');
            setTimeout(() => alertDiv.remove(), 300);
        }, 3000);
    }

    function showErrorMessage(message) {
        const alertDiv = document.createElement('div');
        alertDiv.className = 'alert alert-danger alert-dismissible fade show';
        alertDiv.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        `;
        document.querySelector('.container').prepend(alertDiv);
        
        
        setTimeout(() => {
            alertDiv.classList.remove('show');
            setTimeout(() => alertDiv.remove(), 300);
        }, 3000);
    }
    
    fetchSoftware("./src/web/index.php/jovahagyando");

});
