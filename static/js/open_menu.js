// User clicks on icon in navigation header
document.getElementById("nav-icon").addEventListener("click", () => {
    const navigationIcon = document.getElementById("nav-icon");
    const mobileNavigationMenu = document.getElementById("navbar-links-mobile");

    // Toggle the "open-menu" class for the navigation icon. This will add "open-menu"
    // as a class if it is not in the icon's class list, or it will remove it from the
    // class list if it is there already.
    navigationIcon.classList.toggle("open-menu");

    // If the navigation icon contains "open-menu" as a class, then open the menu.
    // Otherwise, close the menu.
    if (navigationIcon.classList.contains("open-menu")) {
        // Open the menu
        mobileNavigationMenu.style.display = "flex";
    } else {
        // Close the menu
        mobileNavigationMenu.style.display = "none";
    }
});

// User clicks on the main content of the page (not on the navigation header)
document.getElementById("main-content").addEventListener("click", () => {
    const navigationIcon = document.getElementById("nav-icon");
    const mobileNavigationMenu = document.getElementById("navbar-links-mobile");

    // Close the menu
    navigationIcon.classList.remove("open-menu");
    mobileNavigationMenu.style.display = "none";
});
