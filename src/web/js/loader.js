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
    gsap.to(".page-cover-title", {
        y: "-30px",
        duration: 0.8,
        ease: "power4.inOut",
        opacity: 0,
        delay: 0.2
    })
}

function translateOut(event){
    event.preventDefault();
    gsap.fromTo(".page-cover-title", {
        y: "30px",
        opacity: 0
    },
    {
        y: "0",
        duration: 0.8,
        ease: "power4.inOut",
        opacity: 1,
        display: "block",
    });
    gsap.fromTo(".page-cover", {
        opacity: 0
    },
    {
        duration: 0.8,
        ease: "power4.inOut",
        opacity: 1,
        display: "block",
        onComplete: () => {
            const url = event.target.href;
            window.location.href = url;
        }
    });
}