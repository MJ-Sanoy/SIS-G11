document.addEventListener("DOMContentLoaded", function () {
    const tables = document.querySelectorAll("table");
    const forms = document.querySelectorAll("form");

    forms.forEach(form => {
        const wrapper = document.createElement("div");
        wrapper.style.overflowX = "auto";
        wrapper.style.width = "100%";

        form.parentNode.insertBefore(wrapper, form.nextSibling);
        wrapper.appendChild(form);
    });
});
