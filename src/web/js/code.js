let likechecked = false;
let dislikechecked = false;

const likeempty = document.querySelector(".like-svg-empty");
const likefull = document.querySelector(".like-svg-full");
const dislikeempty = document.querySelector(".dislike-svg-empty");
const dislikefull = document.querySelector(".dislike-svg-full");

function likeChecked() {
    if (likechecked) {
        likechecked = false;
        likeempty.style.display = "block";
        likefull.style.display = "none";
    }
    else {
        likechecked = true;
        dislikechecked = false;
        likeempty.style.display = "none";
        likefull.style.display = "block";
        dislikeempty.style.display = "block";
        dislikefull.style.display = "none";
    }
}

function dislikeChecked() {
    if (dislikechecked) {
        dislikechecked = false;
        dislikeempty.style.display = "block";
        dislikefull.style.display = "none";
    }
    else {
        dislikechecked = true;
        likechecked = false;
        dislikeempty.style.display = "none";
        dislikefull.style.display = "block";
        likeempty.style.display = "block";
        likefull.style.display = "none";
    }
}

document.querySelector(".svg-like-wrapper").addEventListener("click", likeChecked);
document.querySelector(".svg-dislike-wrapper").addEventListener("click", dislikeChecked);
