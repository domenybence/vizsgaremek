window.addEventListener("load", function (){
    translateIn();
    const links = document.querySelectorAll("a");
    for (const link of links) {
        links.addEventListener("click", translateOut);
    }
});

function translateIn(){
    const color = document.querySelectorAll(".row");
    const color2 = document.querySelectorAll(".row2");
    const reversedColor = Array.from(color).reverse();
    const reversedColor2 = Array.from(color2).reverse();
    for (let index = 0; index < reversedColor.length; index++) {
        const row = reversedColor[index];
        const row2 = reversedColor2[index];
        gsap.to(row, {
            x: "100%",
            duration: 1.5,
            ease: "power4.inOut",
            delay: index * 0.03
        });
        gsap.to(row2, {
            x: "100%",
            duration: 1.5,
            ease: "power4.inOut",
            delay: index * 0.03
        });
    }
    gsap.delayedCall(1.5 + color.length * 0.03, () => {
        document.querySelector(".page-cover").style.display = "none";
    });
}

function translateOut(){

}