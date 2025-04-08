window.addEventListener("load", function (){
    translateIn();
    const links = document.querySelectorAll("a");
    for (const link of links) {
        link.addEventListener("click", translateOut);
    }
});

function translateIn(){
    gsap.to(".page-cover", {
        duration: 0.8,
        ease: "power4.inOut",
        opacity: 0,
        delay: 0.2,
        onComplete: () => {
            document.querySelector(".page-cover").style.display = "none";
        }
    });
}

function translateOut(event){
    let url;
    if(typeof event === "string") {
        url = event;
    }
    else {
        event.preventDefault();
        url = event.target.href;
    }
    
    gsap.fromTo(".page-cover", {
        opacity: 0
    },
    {
        duration: 0.8,
        ease: "power4.inOut",
        opacity: 1,
        display: "block",
        onComplete: () => {
            window.location.href = url;
        }
    });
}