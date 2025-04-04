function disableScroll() {
    document.body.style.overflow = "hidden";
    document.documentElement.style.overflow = "hidden";
    document.body.style.height = "100%";
    document.documentElement.style.height = "100%";

    window.addEventListener("wheel", preventDefault, { passive: false });
    window.addEventListener("touchmove", preventDefault, { passive: false });
    window.addEventListener("keydown", preventKeyboardScroll, { passive: false });

    console.log("Scrolling Disabled");
}

function enableScroll() {
    document.body.style.overflow = "auto";
    document.documentElement.style.overflow = "auto";
    document.body.style.height = "auto";
    document.documentElement.style.height = "auto";

    window.removeEventListener("wheel", preventDefault);
    window.removeEventListener("touchmove", preventDefault);
    window.removeEventListener("keydown", preventKeyboardScroll);

    console.log("Scrolling Enabled");
}

function preventDefault(event) {
    event.preventDefault();
}

function preventKeyboardScroll(event) {
    const keys = ["ArrowUp", "ArrowDown", "Space", "PageUp", "PageDown"];
    if (keys.includes(event.code)) {
        event.preventDefault();
    }
}

function handleResize() {
    const screenWidth = window.innerWidth;
    console.log(`Screen width: ${screenWidth}`);

    if (screenWidth >= 188 && screenWidth <= 769) {
        enableScroll(); 
        console.log("Enabling scroll (188px - 769px)");
    } else {
        disableScroll(); 
        console.log("Disabling scroll (outside 188px - 769px)");
    }
}

document.addEventListener("DOMContentLoaded", handleResize);
window.addEventListener("resize", handleResize);
