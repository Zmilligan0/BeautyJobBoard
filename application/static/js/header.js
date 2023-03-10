document.querySelector("#ham-menu").addEventListener("click", () => {
    document.querySelector("#navbar-menu").classList.toggle("active-nav");
});
document.querySelector("main").addEventListener("click", () => {
    document.querySelector("#navbar-menu").classList.remove("active-nav");
});
if (document.querySelector("footer")) {
    document.querySelector("footer").addEventListener("click", () => {
        document.querySelector("#navbar-menu").classList.remove("active-nav");
    });
}
