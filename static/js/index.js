/**
 * Toggles the the mobile navigation menu. Should be executed when the
 * navigation menu icon is clicked.
 *
 * This is done by toggling the "open-menu" class on the navigation menu icon
 * (which toggles between hamburger icon and close icon) and changing the
 * display of the mobile navigation menu.
 */
function toggleMobileNavigationMenu() {
    const navigationIcon = document.getElementById("nav-icon");
    const mobileNavigationMenu = document.getElementById("navbar-links-mobile");

    navigationIcon.classList.toggle("open-menu");
    if (navigationIcon.classList.contains("open-menu")) {
        // Open the menu
        mobileNavigationMenu.style.display = "flex";
    } else {
        // Close the menu
        mobileNavigationMenu.style.display = "none";
    }
}

// User clicks on icon in navigation header
document.getElementById("nav-icon").addEventListener("click", toggleMobileNavigationMenu);

/**
 * Closes the mobile navigation menu. Should be executed when the main content
 * of page is clicked.
 *
 * This removes the "open-menu" class on the navigation menu icon and setting
 * display to none for the mobile navigation menu.
 */
function closeMobileNavigationMenu() {
    const navigationIcon = document.getElementById("nav-icon");
    const mobileNavigationMenu = document.getElementById("navbar-links-mobile");

    // Close the menu
    navigationIcon.classList.remove("open-menu");
    mobileNavigationMenu.style.display = "none";
}

// User clicks on the main content of the page (not on the navigation header)
document.getElementById("main-content").addEventListener("click", closeMobileNavigationMenu);
