<!DOCTYPE html>
<html>

    <?php
        // This project is not in the root folder, so we have to remove the base folder,
        // which is '/personal_website'.
        $endpoint = str_replace('/personal_website', '', $_SERVER['REQUEST_URI']);

        switch ($endpoint) {
            case '':
            case '/':
                require __DIR__ . '/home/home.php';
                break;
            case '/about':
            case '/about/':
                require __DIR__ . '/about/about.php';
                break;
            case '/education':
            case '/education/':
                require __DIR__ . '/education/education.php';
                break;
            case '/resume':
            case '/resume/':
                require __DIR__ . '/resume/resume.php';
                break;
            case '/projects':
            case '/projects/':
                require __DIR__ . '/projects/projects.php';
                break;
            case '/contact':
            case '/contact/':
                require __DIR__ . '/contact/contact.php';
                break;
            default:
                require __DIR__ . '/error404.php';
        }
    ?>

</html>
