<div class="navbar">
    <ul class="navbar-links">
        <li class="navitem">
            <a class="navlink<?= $request_info['site_area'] == 'home' ? ' bold-navlink' : '' ?>" href="<?= $request_info['base_url_directory'] . '/' ?>">Home</a>
        </li>
        <li class="navitem">
            <a class="navlink<?= $request_info['site_area'] == 'about' ? ' bold-navlink' : '' ?>" href="<?= $request_info['base_url_directory'] . '/about/' ?>">About Me</a>
        </li>
        <li class="navitem">
            <a class="navlink<?= $request_info['site_area'] == 'education' ? ' bold-navlink' : '' ?>" href="<?= $request_info['base_url_directory'] . '/education/' ?>">Education</a>
        </li>
        <li class="navitem">
            <a class="navlink<?= $request_info['site_area'] == 'resume' ? ' bold-navlink' : '' ?>" href="<?= $request_info['base_url_directory'] . '/resume/' ?>">Resume</a>
        </li>
        <li class="navitem">
            <a class="navlink<?= $request_info['site_area'] == 'projects' ? ' bold-navlink' : '' ?>" href="<?= $request_info['base_url_directory'] . '/projects/' ?>">Projects</a>
        </li>
        <li class="navitem">
            <a class="navlink<?= $request_info['site_area'] == 'contact' ? ' bold-navlink' : '' ?>" href="<?= $request_info['base_url_directory'] . '/contact/' ?>">Contact Me</a>
        </li>
    </ul>
</div>
