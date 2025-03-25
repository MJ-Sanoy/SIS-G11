document.addEventListener("DOMContentLoaded", function () {
    const tickerSpan = document.querySelector(".ticker span");

    // Ensure the ticker starts immediately
    tickerSpan.style.animation = "ticker-scroll 10s linear infinite";
});