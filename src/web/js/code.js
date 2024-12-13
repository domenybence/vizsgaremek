let likechecked = false;
let dislikechecked = false;

const likeWrapper = document.querySelector(".svg-like-wrapper");
const dislikeWrapper = document.querySelector(".svg-dislike-wrapper");

function likeChecked() {
    likechecked = !likechecked;
    if (likechecked) {
        dislikechecked = false;
    }
    updateLikeDislikeState();
}

function dislikeChecked() {
    dislikechecked = !dislikechecked;
    if (dislikechecked) {
        likechecked = false;
    }
    updateLikeDislikeState();
}

function updateLikeDislikeState() {
    if (likechecked){
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
