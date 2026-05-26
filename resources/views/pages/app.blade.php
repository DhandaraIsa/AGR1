<script>
window.addEventListener("scroll", function () {
    const navbar = document.querySelector(".custom-navbar");

    if (window.scrollY > 50) {
        navbar.style.background = "rgba(2,13,31,0.95)";
        navbar.style.boxShadow = "0 5px 20px rgba(0,0,0,0.3)";
    } else {
        navbar.style.background = "rgba(2,13,31,0.7)";
        navbar.style.boxShadow = "none";
    }
});
</script>