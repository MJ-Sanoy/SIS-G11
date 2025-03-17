document.addEventListener("DOMContentLoaded", function () {
    const nav = document.querySelector(".nav");

    // Show navigation smoothly after page load
    setTimeout(() => {
        nav.classList.add("active");
    }, 200); // Delay for a smoother effect
});
