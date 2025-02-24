document.addEventListener("DOMContentLoaded", () => {
    const requestCards = document.querySelectorAll(".request-card");
    requestCards.forEach(card => {
        card.addEventListener("click", () => {
            window.location.href = `/vizsgaremek/felkeres/${card.dataset.requestId}`;
        });
    });
});