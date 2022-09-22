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
    // Note that if the base URL directory is defined, it ends with a slash.
    // We must get all the characters before the slash (so that we compare
    // just the name of the directory).
    if ($uri_path_array[0] == substr(BASE_URL_DIRECTORY, 0, strlen(BASE_URL_DIRECTORY) - 1)) {
        $uri_path_array = array_slice($uri_path_array, 1);
    }

    // If the URL path array is empty (which means the home page was requested),
    // then set the only element of the array to an empty string.
    if (count($uri_path_array) === 0) {
        $uri_path_array[] = '';
    }

    $page_info['error_404'] = false;

    // Router
    switch ($uri_path_array[0]) {
        case '':
            if (count($uri_path_array) === 1) {
                $page_info['title'] = 'Daniel Di Giovanni';
                $page_info['path_to_php_file'] = __DIR__ . '/pages/home/home.php';
            } else {
                $page_info['error_404'] = true;
            }
            break;
        case 'about':
            if (count($uri_path_array) === 1) {
                $page_info['title'] = 'About Me | Daniel Di Giovanni';
                $page_info['path_to_php_file'] = __DIR__ . '/pages/about/about.php';
            } else {
                $page_info['error_404'] = true;
            }
            break;
        case 'resume':
            if (count($uri_path_array) === 1) {
                $page_info['title'] = 'Resume | Daniel Di Giovanni';
                $page_info['path_to_php_file'] = __DIR__ . '/pages/resume/resume.php';
            } else {
                $page_info['error_404'] = true;
            }
            break;
        case 'projects':
            if (count($uri_path_array) === 1) {
                $page_info['title'] = 'Projects | Daniel Di Giovanni';
                $page_info['path_to_php_file'] = __DIR__ . '/pages/projects/projects.php';
            } else if (count($uri_path_array) === 2) {
                $query = 'SELECT title, url_endpoint FROM projects';

                $result = mysqli_query($db, $query);

                if (!$result) {
                    exit('Database query failed');
                }

                $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

                mysqli_free_result($result);

                $page_info['error_404'] = true;

                foreach ($rows as $row) {
                    if ($uri_path_array[1] == $row['url_endpoint']) {
                        $page_info['error_404'] = false;

                        $page_info['title'] = $row['title'] . ' | Daniel Di Giovanni';
                        $page_info['path_to_php_file'] = __DIR__ . '/pages/projects/project_template.php';
                    }
                }
            } else {
                $page_info['error_404'] = true;
            }
            break;
        case 'contact':
            if (count($uri_path_array) === 1) {
                $page_info['title'] = 'Contact Me | Daniel Di Giovanni';
                $page_info['path_to_php_file'] = __DIR__ . '/pages/contact/contact.php';
            } else {
                $page_info['error_404'] = true;
            }
            break;
        default:
            $page_info['error_404'] = true;
    }

    if ($page_info['error_404']) {
        http_response_code(404);
        $page_info['path_to_php_file'] = __DIR__ . '/pages/errors/error404.php';
        $page_info['title'] = 'Error 404';
    }
?>
