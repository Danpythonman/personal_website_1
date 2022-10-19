<?php
    // Get the URI path from the server superglobal (without query strings)
    $uri_path = strtok($_SERVER['REQUEST_URI'], '?');

    // If the URI path begins with a slash, then remove that slash from the path
    if ($uri_path[0] == '/') {
        $uri_path = substr($uri_path, 1);
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

    /*
     * This is the router.
     *
     * We check the first element of the URL path array. This is the area of
     * the website that the request is part of (home, projects, resume, about,
     * contact).
     *
     * For most areas, that is the only option, and if the array has
     * more elements, then it is a 404 error.
     *
     * For example, "about" is the only page in the about area of the website.
     * If the URL is "about/more", this URL does not exist. So we need to make
     * sure that the array only has one element.
     *
     * For other areas, like projects, there can be two elements.
     *
     * For example, "projects" takes you to the projects overview page, and
     * "projects/tab2xml" takes you to the TAB2XML project page. In this case,
     * the URL path array can either have one or two elements.
     *
     * For the case of projects, if the request is to a specific project page,
     * then we must also first make sure that the project page exists, or else
     * it is a 404 error.
     *
     * For example, "projects/tab2xml" exists, but "projects/xml2tab" does not.
     *
     * For 404 errors, we throw a CustomException with 404 as the code.
     *
     * If the page was found, we populate the variable $page_info, which is an
     * associative array. Then, page.php is able to take this variable and
     * properly make the page.
     */
    switch ($uri_path_array[0]) {
        case '':
            if (count($uri_path_array) === 1) {
                $page_info['title'] = 'Daniel Di Giovanni - Software Developer';
                $page_info['meta_description'] = 'I\'m Daniel Di Giovanni, a programming professional, student, and hobbyist. Here you can find my resume, check out my projects, and get in touch with me.';
                $page_info['path_to_php_file'] = __DIR__ . '/pages/home/home.php';
            } else {
                throw new CustomException("", 404);
            }
            break;
        case 'about':
            if (count($uri_path_array) === 1) {
                $page_info['title'] = 'About Me | Daniel Di Giovanni';
                $page_info['meta_description'] = 'More about me, beyond software development. Learn about my education and my hobby of reading.';
                $page_info['path_to_php_file'] = __DIR__ . '/pages/about/about.php';
            } else {
                throw new CustomException("", 404);
            }
            break;
        case 'resume':
            if (count($uri_path_array) === 1) {
                $page_info['title'] = 'My Resume | Daniel Di Giovanni';
                $page_info['meta_description'] = 'An outline of my professional experience. Learn more about my work history and download my resume.';
                $page_info['path_to_php_file'] = __DIR__ . '/pages/resume/resume.php';
            } else {
                throw new CustomException("", 404);
            }
            break;
        case 'projects':
            if (count($uri_path_array) === 1) {
                $page_info['title'] = 'My Projects | Daniel Di Giovanni';
                $page_info['meta_description'] = 'The work that I\'m passionate about. Explore the major programming projects I\'ve completed over the years.';
                $page_info['path_to_php_file'] = __DIR__ . '/pages/projects/projects.php';
            } else if (count($uri_path_array) === 2) {
                $query = 'SELECT title, url_endpoint, meta_description FROM projects';

                $result = mysqli_query($db, $query);

                if (!$result) {
                    throw new CustomException("There was an error with the database. This one's on our end.", 500);
                }

                $projects = mysqli_fetch_all($result, MYSQLI_ASSOC);

                mysqli_free_result($result);

                $page_found = false;

                foreach ($projects as $project) {
                    if ($uri_path_array[1] == $project['url_endpoint']) {
                        $page_found = true;

                        $page_info['title'] = $project['title'] . ' | Daniel Di Giovanni';
                        $page_info['meta_description'] = $project['meta_description'];
                        $page_info['path_to_php_file'] = __DIR__ . '/pages/projects/project_template.php';
                    }
                }

                if (!$page_found) {
                    throw new CustomException("", 404);
                }
            } else {
                throw new CustomException("", 404);
            }
            break;
        case 'contact':
            if (count($uri_path_array) === 1) {
                $page_info['title'] = 'Contact Me | Daniel Di Giovanni';
                $page_info['meta_description'] = 'Feel free to get in touch with me! Send me an email or find my LinkedIn and GitHub here.';
                $page_info['path_to_php_file'] = __DIR__ . '/pages/contact/contact.php';
            } else {
                throw new CustomException("", 404);
            }
            break;
        default:
            throw new CustomException("", 404);
    }
?>
