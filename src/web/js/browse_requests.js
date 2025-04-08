document.addEventListener("DOMContentLoaded", () => {
    const requestCards = document.querySelectorAll(".request-card");
    
    requestCards.forEach(card => {
        card.addEventListener("click", (event) => {
            event.preventDefault();
            const targetUrl = `/felkeresek/${card.dataset.requestId}`;
            const pageCover = document.querySelector(".page-cover");
            pageCover.style.display = "block";
            gsap.to(".page-cover", {
                opacity: 1,
                duration: 0.8,
                ease: "power4.inOut",
                onComplete: () => {
                    window.location.href = targetUrl;
                }
            });
        });
    });
});