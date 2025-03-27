function disableScroll() {
    window.addEventListener("wheel", preventDefault, { passive: false });
    window.addEventListener("touchmove", preventDefault, { passive: false });
    window.addEventListener("keydown", preventKeyboardScroll, { passive: false });
    console.log("Scrolling Disabled");
}

function enableScroll() {
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

document.addEventListener("DOMContentLoaded", function () {
    disableScroll();
});
    