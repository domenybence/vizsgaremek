const likeWrapper = document.querySelector(".svg-like-wrapper");
const dislikeWrapper = document.querySelector(".svg-dislike-wrapper");
let likechecked;
let dislikechecked;
if(likeWrapper.classList.contains("checked")){
    likechecked = true;
}
else{
    likechecked = false;
}
if(dislikeWrapper.classList.contains("checked")){
    dislikechecked = true;
}
else{
    dislikechecked = false;
}

async function fetchLikeValue(value){
    const userId = 8; //todo
    const codeId = 3; //todo
    try{
        const response = await fetch("http://localhost/vizsgaremek/src/php_functions/db_uploadlikes.php",{
            method: 'POST',
            headers:{
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                userid: userId,
                codeid: codeId,
                value: value
            })
        });
        if(!response.ok){
            console.error(response.status, response.statusText);
        }
        else{
            let data = await response.json();
            document.querySelector(".likes").innerHTML = data["likeCount"];
        }
    }
    catch(error){
        console.log(error);
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
        likeWrapper.classList.add("checked");
    }
    else {
        likeWrapper.classList.remove("checked");
    }
    if(dislikechecked){
        dislikeWrapper.classList.add("checked");
    }
    else {
        dislikeWrapper.classList.remove("checked");
    }
}

likeWrapper.addEventListener("click", likeChecked);
dislikeWrapper.addEventListener("click", dislikeChecked);