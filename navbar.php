<nav id="navigation-header">
    <div id="navbar">
        <div id="navtitle">
            <a id="navtitle-link" href="<?= '/' . BASE_URL_DIRECTORY ?>">Daniel Di Giovanni</a>
        </div>
        <div id="nav-icon">
            <div id="top-hamburger-menu-bar" class="hamburger-menu-bar"></div>
            <div id="middle-hamburger-menu-bar" class="hamburger-menu-bar"></div>
            <div id="bottom-hamburger-menu-bar" class="hamburger-menu-bar"></div>
        </div>
        <ul id="navbar-links-desktop">
            <li class="navitem-desktop">
                <a class="navlink<?= $uri_path_array[0] == 'about' ? ' bold-navlink' : '' ?>" href="<?= '/' . BASE_URL_DIRECTORY . 'about' ?>">About Me</a>
            </li>
            <li class="navitem-desktop">
                <a class="navlink<?= $uri_path_array[0] == 'resume' ? ' bold-navlink' : '' ?>" href="<?= '/' . BASE_URL_DIRECTORY . 'resume' ?>">Resume</a>
            </li>
            <li class="navitem-desktop">
                <a class="navlink<?= $uri_path_array[0] == 'projects' ? ' bold-navlink' : '' ?>" href="<?= '/' . BASE_URL_DIRECTORY . 'projects' ?>">Projects</a>
            </li>
            <li class="navitem-desktop">
                <a class="navlink<?= $uri_path_array[0] == 'contact' ? ' bold-navlink' : '' ?>" href="<?= '/' . BASE_URL_DIRECTORY . 'contact' ?>">Contact Me</a>
            </li>
        </ul>
    </div>
    <div id="mobile-nav-menu">
        <ul id="navbar-links-mobile">
            <li class="navitem-mobile">
                <a class="navlink<?= $uri_path_array[0] == 'about' ? ' bold-navlink' : '' ?>" href="<?= '/' . BASE_URL_DIRECTORY . 'about' ?>">About Me</a>
            </li>
            <li class="navitem-mobile">
                <a class="navlink<?= $uri_path_array[0] == 'resume' ? ' bold-navlink' : '' ?>" href="<?= '/' . BASE_URL_DIRECTORY . 'resume' ?>">Resume</a>
            </li>
            <li class="navitem-mobile">
                <a class="navlink<?= $uri_path_array[0] == 'projects' ? ' bold-navlink' : '' ?>" href="<?= '/' . BASE_URL_DIRECTORY . 'projects' ?>">Projects</a>
            </li>
            <li class="navitem-mobile">
                <a class="navlink<?= $uri_path_array[0] == 'contact' ? ' bold-navlink' : '' ?>" href="<?= '/' . BASE_URL_DIRECTORY . 'contact' ?>">Contact Me</a>
            </li>
        </ul>
    </div>
</nav>
