<?php
    // Get the URI path from the server superglobal
    $uri_path = $_SERVER['REQUEST_URI'];

    // If the URI path begins with a slash, then remove that slash from the path
    if ($uri_path[0] == '/') {
        $uri_path = substr($uri_path, 1);
    }

    // If the URI path ends with a slash, then remove that slash from the path
    if ($uri_path[strlen($uri_path) - 1] == '/') {
        $uri_path = substr($uri_path, 0, strlen($uri_path) - 1);
    }

    // Separate the URI path by the slashes to turn it into an array of strings.
    // Each array element is a part of the path.
    $uri_path_array = explode('/', $uri_path);

    // If a base URL directory is defined, remove it from the array.
    if ($uri_path_array[0] == getenv('BASE_URL_DIRECTORY')) {
        $uri_path_array = array_slice($uri_path_array, 1);
    }

    // If the URL path array is empty (which means the home page was requested),
    // then set the only element of the array to an empty string.
    if (count($uri_path_array) === 0) {
        $uri_path_array[] = '';
    }

    // Router
    switch ($uri_path_array[0]) {
        case '':
            $page_info['title'] = 'Daniel Di Giovanni';
            $page_info['path_to_php_file'] = __DIR__ . '/home/home.php';
            break;
        case 'about':
            $page_info['title'] = 'About Me | Daniel Di Giovanni';
            $page_info['path_to_php_file'] = __DIR__ . '/about/about.php';
            break;
        case 'education':
            $page_info['title'] = 'Education | Daniel Di Giovanni';
            $page_info['path_to_php_file'] = __DIR__ . '/education/education.php';
            break;
        case 'resume':
            $page_info['title'] = 'Resume | Daniel Di Giovanni';
            $page_info['path_to_php_file'] = __DIR__ . '/resume/resume.php';
            break;
        case 'projects':
            $page_info['title'] = 'Projects | Daniel Di Giovanni';
            $page_info['path_to_php_file'] = __DIR__ . '/projects/projects.php';
            break;
        case 'contact':
            $page_info['title'] = 'Contact Me | Daniel Di Giovanni';
            $page_info['path_to_php_file'] = __DIR__ . '/contact/contact.php';
            break;
        default:
            http_response_code(404);
            $page_info['title'] = 'Error 404';
            $request_info['path_to_php_file'] = __DIR__ . '/error404.php';
    }
?>
