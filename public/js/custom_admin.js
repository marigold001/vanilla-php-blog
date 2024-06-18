document.addEventListener("DOMContentLoaded", function() {
    // Get the current URL path
    var currentPath = window.location.pathname;
    console.log(currentPath);
    // Get all <a> elements within .nav-mobile .nav-item elements
    var navLinks = document.querySelectorAll(".nav-mobile .nav-link");

    // Function to remove 'active' class from all .nav-item elements
    function removeActiveClasses() {
        navLinks.forEach(function(link) {
            link.classList.remove("active");
        });
    }

    // Function to set 'active' class based on current URL
    function setActiveClass() {
        navLinks.forEach(function(link) {
            if (link.getAttribute('href') === currentPath) {
                link.classList.add("active");
                console.log("Match");
            }
        });
    }

    // Remove 'active' class from all .nav-link elements
    removeActiveClasses();

    // Set 'active' class based on current URL
    setActiveClass();

});
