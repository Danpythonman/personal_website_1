<?php
    // This project is not in the root folder, so we have to remove the base folder,
    // which is '/personal_website'.
    $base_url_directory = '/personal_website';
    $endpoint = str_replace($base_url_directory, '', $_SERVER['REQUEST_URI']);

    switch ($endpoint) {
        case '':
        case '/':
            $title = 'Daniel Di Giovanni';
            $router_path = __DIR__ . '/home/home.php';
            break;
        case '/about':
        case '/about/':
            $title = 'About Me | Daniel Di Giovanni';
            $router_path = __DIR__ . '/about/about.php';
            break;
        case '/education':
        case '/education/':
            $title = 'Education | Daniel Di Giovanni';
            $router_path = __DIR__ . '/education/education.php';
            break;
        case '/resume':
        case '/resume/':
            $title = 'Resume | Daniel Di Giovanni';
            $router_path = __DIR__ . '/resume/resume.php';
            break;
        case '/projects':
        case '/projects/':
            $title = 'Projects | Daniel Di Giovanni';
            $router_path = __DIR__ . '/projects/projects.php';
            break;
        case '/contact':
        case '/contact/':
            $title = 'Contact Me | Daniel Di Giovanni';
            $router_path = __DIR__ . '/contact/contact.php';
            break;
        default:
            http_response_code(404);
            $title = 'Error 404';
            $router_path = __DIR__ . '/error404.php';
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title><?= $title ?></title>
    </head>
    <body>
        <?php require __DIR__ . '/navbar.php'; ?>

        <?php require $router_path; ?>

    </body>
</html>
