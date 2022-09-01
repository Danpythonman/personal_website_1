<?php
    $request_info = [];

    // This project is not in the root folder, so we have to remove the base folder,
    // which is '/personal_website'.
    $request_info['base_url_directory'] = '/personal_website';
    $request_info['endpoint'] = str_replace($request_info['base_url_directory'], '', $_SERVER['REQUEST_URI']);

    switch ($request_info['endpoint']) {
        case '':
        case '/':
            $title = 'Daniel Di Giovanni';
            $request_info['router_path'] = __DIR__ . '/home/home.php';
            $request_info['site_area'] = 'home';
            break;
        case '/about':
        case '/about/':
            $title = 'About Me | Daniel Di Giovanni';
            $request_info['router_path'] = __DIR__ . '/about/about.php';
            $request_info['site_area'] = 'about';
            break;
        case '/education':
        case '/education/':
            $title = 'Education | Daniel Di Giovanni';
            $request_info['router_path'] = __DIR__ . '/education/education.php';
            $request_info['site_area'] = 'education';
            break;
        case '/resume':
        case '/resume/':
            $title = 'Resume | Daniel Di Giovanni';
            $request_info['router_path'] = __DIR__ . '/resume/resume.php';
            $request_info['site_area'] = 'resume';
            break;
        case '/projects':
        case '/projects/':
            $title = 'Projects | Daniel Di Giovanni';
            $request_info['router_path'] = __DIR__ . '/projects/projects.php';
            $request_info['site_area'] = 'projects';
            break;
        case '/contact':
        case '/contact/':
            $title = 'Contact Me | Daniel Di Giovanni';
            $request_info['router_path'] = __DIR__ . '/contact/contact.php';
            $request_info['site_area'] = 'contact';
            break;
        default:
            http_response_code(404);
            $title = 'Error 404';
            $request_info['router_path'] = __DIR__ . '/error404.php';
            $request_info['site_area'] = '404';
    }

    require __DIR__ . '/page.php';
?>
