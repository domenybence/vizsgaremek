let likechecked;
let dislikechecked;
if(document.body.contains(document.querySelector(".svg-like-wrapper"))) {
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
}

async function fetchLikeValue(value){
    try{
        const response = await fetch("/vizsgaremek/src/web/upload_likes.php",{
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
        const response = await fetch("/vizsgaremek/src/php_functions/purchase_fetch.php",{
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
            if(data["result"] == "success"){
                if(!document.body.classList.contains(".modal-wrapper")) {
                    document.body.insertAdjacentHTML("beforeend", `<div class="modal-wrapper">
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
                                                                                <a id="button_next" href="">Tovább</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>`);
                                                document.querySelector("#button_next").addEventListener("click", translateOut);
                }
            }
            else if(data["result"] == "error"){
                if(!document.body.classList.contains(".modal-wrapper")) {
                    document.body.insertAdjacentHTML("beforeend",`<div class="error-modal-wrapper">
                                                                        <div class="error-modal-popup">
                                                                            <div class="error-title-container">
                                                                                <h3>Sikertelen vásárlás!</h3>
                                                                                <svg xmlns="http://www.w3.org/2000/svg" id="svg_x" width="35" height="35" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                                                                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                                                                                </svg>
                                                                            </div>
                                                                            <hr>
                                                                            <div class="content">
                                                                                <p>A vásárlás során valami hiba történt!</p>
                                                                            </div>
                                                                            <hr>
                                                                            <div class="error-button-container">
                                                                                <a id="error_button_next" href="">Tovább</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>`);
                }
            }
        }
    }
    catch(error){
        console.error(error);
    }
}

async function likeChecked(){
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

function updateState(){
    if(likechecked) {
        document.querySelector(".svg-like-wrapper").classList.add("checked");
    }
    else {
        document.querySelector(".svg-like-wrapper").classList.remove("checked");
    }
    if(dislikechecked){
        document.querySelector(".svg-dislike-wrapper").classList.add("checked");
    }
    else {
        document.querySelector(".svg-dislike-wrapper").classList.remove("checked");
    }
}

if(document.body.contains(document.querySelector(".svg-like-wrapper"))) {
    document.querySelector(".svg-like-wrapper").addEventListener("click", likeChecked);
    document.querySelector(".svg-dislike-wrapper").addEventListener("click", dislikeChecked);
}