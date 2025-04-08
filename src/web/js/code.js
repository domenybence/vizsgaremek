let likechecked;
let dislikechecked;

if(document.body.contains(document.querySelector(".svg-like-wrapper")) && isOwned) {
    if(document.querySelector(".svg-like-wrapper").classList.contains("checked")){
        likechecked = true;
    }
    else{
        likechecked = false;
    }
    if(document.querySelector(".svg-dislike-wrapper").classList.contains("checked")){
        dislikechecked = true;
    }
    else{
        dislikechecked = false;
    }
    
    document.querySelector(".svg-like-wrapper").addEventListener("click", likeChecked);
    document.querySelector(".svg-dislike-wrapper").addEventListener("click", dislikeChecked);
}

async function fetchLikeValue(value){
    if (!isOwned) {
        alert("A kód értékeléséhez először meg kell vásárolnia azt!");
        return;
    }
    try{
        const response = await fetch("/src/web/upload_likes.php",{
            method: "POST",
            headers:{
                "Content-Type": "application/json",
                "Javascript-Fetch-Request": "likes-fetch-req"
            },
            body: JSON.stringify({
                userid: userId,
                codeid: codeId,
                value: value
            })
        });
        if(!response.ok){
            throw new Error(response.status, response.statusText);
        }
        else{
            let data = await response.json();
            if(data["likeCount"] === null){
                document.querySelector(".likes").innerHTML = "0";
            }
            else{
                document.querySelector(".likes").innerHTML = data["likeCount"];
            }
        }
    }
    catch(error){
        console.error(error);
    }
}

if(document.body.contains(document.querySelector(".checkout"))) {
    document.querySelector(".checkout").addEventListener("click", fetchPurchase);
}

async function fetchPurchase(){
    const numcodeid = Number(codeId);
    try{
        const response = await fetch("/src/php_functions/purchase_fetch.php",{
            method: "POST",
            headers:{
                "Content-Type": "application/json",
                "Javascript-Fetch-Request": "codepurchase-fetch-req"
            },
            body: JSON.stringify({
                userid: userId,
                codeid: numcodeid
            })
        });
        if(!response.ok){
            throw new Error(response.status, response.statusText);
        }
        else{
            let data = await response.json();
            if(data["result"] == "success") {
                if(!document.body.classList.contains(".modal-wrapper")) {
                    document.body.insertAdjacentHTML("beforeend",
                        `<div class="modal-wrapper">
                            <div class="modal-popup">
                                <div class="title-container">
                                    <h3>Sikeres vásárlás!</h3>
                                    <svg xmlns="http://www.w3.org/2000/svg" id="svg_x" width="35" height="35" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                                    </svg>
                                </div>
                                <hr>
                                <div class="content">
                                    <p>Reméljük a kóddal meg lesz elégedve.</p>
                                </div>
                                <hr>
                                <div class="button-container">
                                    <a id="button_okay" href="">Tovább</a>
                                </div>
                            </div>
                        </div>`);
                        document.querySelector("#button_okay").addEventListener("click", translateOut);
                }
            }
            else if(data["result"] == "error") {
                if(!document.body.classList.contains(".modal-wrapper")) {
                    document.body.insertAdjacentHTML("beforeend",
                        `<div class="modal-wrapper">
                            <div class="error-modal-popup">
                                <div class="error-title-container">
                                    <h3>Sikertelen vásárlás!</h3>
                                    <svg xmlns="http://www.w3.org/2000/svg" id="svg_x" width="35" height="35" fill="currentColor" class="bi bi-x" viewBox="0 0 16
                                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                                </svg>
                            </div>
                            <hr>
                            <div class="content">
                                <p>Nincs elegendő pontja a kód megvásárlásához.</p>
                            </div>
                            <hr>
                            <div class="button-container">
                                <a id="button_not_okay" href="">Tovább</a>
                            </div>
                        </div>
                    </div>`);
                document.querySelector("#button_not_okay").addEventListener("click", translateOut);
                }
            }
            else if(data["result"] == "insufficient_points") {
                if(!document.body.classList.contains(".modal-wrapper")) {
                    document.body.insertAdjacentHTML("beforeend",
                        `<div class="modal-wrapper">
                            <div class="error-modal-popup">
                                <div class="error-title-container">
                                    <h3>Sikertelen vásárlás!</h3>
                                    <svg xmlns="http://www.w3.org/2000/svg" id="svg_x" width="35" height="35" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                                    </svg>
                                </div>
                                <hr>
                                <div class="content">
                                    <p>Nincs elegendő pontja a kód megvásárlásához.</p>
                                </div>
                                <hr>
                                <div class="button-container">
                                    <a id="button_points" href="/pontfeltoltes" class="modal-button">Pontok feltöltése</a>
                                    <button id="button_close" class="modal-button secondary">Bezárás</button>
                                </div>
                            </div>
                        </div>`);
                    
                    document.querySelector("#svg_x").addEventListener("click", closeErrorModal);
                    document.querySelector("#button_close").addEventListener("click", closeErrorModal);
                    document.querySelector("#button_points").addEventListener("click", function() {
                        translateOut("/pontfeltoltes");
                    });
                }
            }
        }
    }
    catch(error){
        console.error(error);
        showGenericErrorModal("Hiba történt a vásárlás során. Kérjük, próbálja meg később.");
    }
}

function closeErrorModal() {
    const modalWrapper = document.querySelector(".modal-wrapper");
    if (modalWrapper) {
        modalWrapper.style.opacity = 0;
        modalWrapper.style.transition = "opacity 0.3s ease";
        setTimeout(() => {
            modalWrapper.remove();
        }, 300);
    }
}

function showGenericErrorModal(message) {
    if(!document.body.classList.contains(".modal-wrapper")) {
        document.body.insertAdjacentHTML("beforeend",
            `<div class="modal-wrapper">
                <div class="error-modal-popup">
                    <div class="error-title-container">
                        <h3>Hiba történt!</h3>
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
                        <button id="button_close" class="modal-button">Bezárás</button>
                    </div>
                </div>
            </div>`);
        
        document.querySelector("#svg_x").addEventListener("click", closeErrorModal);
        document.querySelector("#button_close").addEventListener("click", closeErrorModal);
    }
}

async function likeChecked(){
    if (!isOwned) {
        alert("A kód értékeléséhez először meg kell vásárolnia azt!");
        return;
    }
    likechecked = !likechecked;
    if(likechecked){
        dislikechecked = false;
        await fetchLikeValue(1);
    }
    else{
        await fetchLikeValue(null);
    }
    updateState();
}

async function dislikeChecked(){
    if (!isOwned) {
        if(!document.body.classList.contains(".modal-wrapper")) {
            document.body.insertAdjacentHTML("beforeend",
                `<div class="modal-wrapper">
                    <div class="error-modal-popup">
                        <div class="error-title-container">
                            <h3>Sikertelen vásárlás!</h3>
                            <svg xmlns="http://www.w3.org/2000/svg" id="svg_x" width="35" height="35" fill="currentColor" class="bi bi-x" viewBox="0 0 16
                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                        </svg>
                    </div>
                    <hr>
                    <div class="content">
                        <p>A kód értékeléséhez először meg kell vásárolnia azt!.</p>
                    </div>
                    <hr>
                    <div class="button-container">
                        <a id="button_not_okay" href="">Tovább</a>
                    </div>
                </div>
            </div>`);
        document.querySelector("#button_not_okay").addEventListener("click", translateOut);
        return;
    }
    dislikechecked = !dislikechecked;
    if(dislikechecked){
        likechecked = false;
        await fetchLikeValue(0);
    }
    else{
        await fetchLikeValue(null);
    }
    updateState();
    }
}


document.addEventListener("click", (event) => {
    if(event.target.closest("div.button-container > svg")) {
        closePopup();
    }
    if(event.target.closest("div.button-container > button")) {
        closePopup();
    }
});

function closePopup(){
    document.querySelector("div.modal-wrapper").style.opacity = 0;
    document.querySelector("div.modal-wrapper").style.transition = "opacity, 0.3s";
    setTimeout(() => {
        document.querySelector("div.modal-wrapper").remove();
    }, 300);
}

if(document.body.contains(document.getElementById("delete-code-btn"))) {
    document.getElementById("delete-code-btn").addEventListener("click", confirmDeleteCode);
}

function confirmDeleteCode() {
    if(!document.body.classList.contains(".modal-wrapper")) {
        document.body.insertAdjacentHTML("beforeend",
            `<div class="modal-wrapper">
                <div class="error-modal-popup">
                    <div class="error-title-container">
                        <h3>Kód törlése</h3>
                        <svg xmlns="http://www.w3.org/2000/svg" id="svg_x" width="35" height="35" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                        </svg>
                    </div>
                    <hr>
                    <div class="content">
                        <p>Biztosan törölni szeretné ezt a kódot? Ez a művelet nem visszavonható.</p>
                    </div>
                    <hr>
                    <div class="button-container">
                        <button id="cancel-delete-btn" class="modal-button secondary">Mégsem</button>
                        <button id="confirm-delete-btn" class="modal-button" style="background-color: #dc3545;">Törlés</button>
                    </div>
                </div>
            </div>`);
        
        document.querySelector("#svg_x").addEventListener("click", closeErrorModal);
        document.querySelector("#cancel-delete-btn").addEventListener("click", closeErrorModal);
        document.querySelector("#confirm-delete-btn").addEventListener("click", deleteCode);
    }
}

async function deleteCode() {
    try {
        const response = await fetch("/src/web/index.php/kod_torles", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                id: codeId
            })
        });

        const data = await response.json();
        
        if (data === "Sikeres művelet!") {
            if(!document.body.classList.contains(".modal-wrapper")) {
                closeErrorModal();
                document.body.insertAdjacentHTML("beforeend",
                    `<div class="modal-wrapper">
                        <div class="modal-popup">
                            <div class="title-container">
                                <h3>Sikeres törlés</h3>
                                <svg xmlns="http://www.w3.org/2000/svg" id="svg_success_x" width="35" height="35" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                                </svg>
                            </div>
                            <hr>
                            <div class="content">
                                <p>A kód sikeresen törölve lett.</p>
                            </div>
                            <hr>
                            <div class="button-container">
                                <a id="redirect_btn" href="/konyvtar" class="modal-button">Tovább</a>
                            </div>
                        </div>
                    </div>`);
                document.querySelector("#svg_success_x").addEventListener("click", () => {
                    translateOut("/konyvtar");
                });
                document.querySelector("#redirect_btn").addEventListener("click", () => {
                    translateOut("/konyvtar");
                });
            }
        }
        else {
            showGenericErrorModal("Hiba történt a kód törlése közben.");
        }
    }
    catch (error) {
        console.error(error);
        showGenericErrorModal("Hiba történt a kód törlése közben.");
    }
}

function updateState() {
    if(likechecked) {
        document.querySelector(".svg-like-wrapper").classList.add("checked");
    }
    else {
        document.querySelector(".svg-like-wrapper").classList.remove("checked");
    }
    if(dislikechecked) {
        document.querySelector(".svg-dislike-wrapper").classList.add("checked");
    }
    else {
        document.querySelector(".svg-dislike-wrapper").classList.remove("checked");
    }
}
