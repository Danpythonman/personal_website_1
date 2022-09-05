// User clicks on icon in navigation header
document.getElementById("nav-icon").addEventListener("click", () => {
    // If open icon is not displayed (meaning close icon is displayed,
    // so the user clicked on the close icon)
    if (window.getComputedStyle(document.getElementById("open-nav-icon")).display == "none") {
        // Close the menu
        document.getElementById("open-nav-icon").style.display = "flex";
        document.getElementById("close-nav-icon").style.display = "none";
        document.getElementById("navbar-links-mobile").style.display = "none";
    } else {
        // Otherwise, open the menu
        document.getElementById("open-nav-icon").style.display = "none";
        document.getElementById("close-nav-icon").style.display = "flex";
        document.getElementById("navbar-links-mobile").style.display = "flex";
    }
});

// User clicks on the main content of the page (not on the navigation header)
document.getElementById("main-content").addEventListener("click", () => {
    // Close the menu
    document.getElementById("open-nav-icon").style.display = "flex";
    document.getElementById("close-nav-icon").style.display = "none";
    document.getElementById("navbar-links-mobile").style.display = "none";
});
