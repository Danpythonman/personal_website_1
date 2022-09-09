<nav id="navigation-header">
    <div id="navbar">
        <div id="navtitle">
            <a id="navtitle-link" href="<?= '/' . getenv('BASE_URL_DIRECTORY') ?>">Daniel Di Giovanni</a>
        </div>
        <div id="nav-icon">
            <!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
            <svg id="open-nav-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                <path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/>
            </svg>
            <svg id="close-nav-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                <path d="M310.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L160 210.7 54.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L114.7 256 9.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 301.3 265.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L205.3 256 310.6 150.6z"/>
            </svg>
        </div>
        <ul id="navbar-links-desktop">
            <li class="navitem">
                <a class="navlink<?= $uri_path_array[0] == 'about' ? ' bold-navlink' : '' ?>" href="<?= '/' . getenv('BASE_URL_DIRECTORY') . '/about' ?>">About Me</a>
            </li>
            <li class="navitem">
                <a class="navlink<?= $uri_path_array[0] == 'education' ? ' bold-navlink' : '' ?>" href="<?= '/' . getenv('BASE_URL_DIRECTORY') . '/education' ?>">Education</a>
            </li>
            <li class="navitem">
                <a class="navlink<?= $uri_path_array[0] == 'resume' ? ' bold-navlink' : '' ?>" href="<?= '/' . getenv('BASE_URL_DIRECTORY') . '/resume' ?>">Resume</a>
            </li>
            <li class="navitem">
                <a class="navlink<?= $uri_path_array[0] == 'projects' ? ' bold-navlink' : '' ?>" href="<?= '/' . getenv('BASE_URL_DIRECTORY') . '/projects' ?>">Projects</a>
            </li>
            <li class="navitem">
                <a class="navlink<?= $uri_path_array[0] == 'contact' ? ' bold-navlink' : '' ?>" href="<?= '/' . getenv('BASE_URL_DIRECTORY') . '/contact' ?>">Contact Me</a>
            </li>
        </ul>
    </div>
    <div id="mobile-nav-menu">
        <ul id="navbar-links-mobile">
            <li class="navitem-mobile">
                <a class="navlink<?= $uri_path_array[0] == 'about' ? ' bold-navlink' : '' ?>" href="<?= '/' . getenv('BASE_URL_DIRECTORY') . '/about' ?>">About Me</a>
            </li>
            <li class="navitem-mobile">
                <a class="navlink<?= $uri_path_array[0] == 'education' ? ' bold-navlink' : '' ?>" href="<?= '/' . getenv('BASE_URL_DIRECTORY') . '/education' ?>">Education</a>
            </li>
            <li class="navitem-mobile">
                <a class="navlink<?= $uri_path_array[0] == 'resume' ? ' bold-navlink' : '' ?>" href="<?= '/' . getenv('BASE_URL_DIRECTORY') . '/resume' ?>">Resume</a>
            </li>
            <li class="navitem-mobile">
                <a class="navlink<?= $uri_path_array[0] == 'projects' ? ' bold-navlink' : '' ?>" href="<?= '/' . getenv('BASE_URL_DIRECTORY') . '/projects' ?>">Projects</a>
            </li>
            <li class="navitem-mobile">
                <a class="navlink<?= $uri_path_array[0] == 'contact' ? ' bold-navlink' : '' ?>" href="<?= '/' . getenv('BASE_URL_DIRECTORY') . '/contact' ?>">Contact Me</a>
            </li>
        </ul>
    </div>
</nav>
