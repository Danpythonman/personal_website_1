<?php
    // Load environment variables
    require __DIR__ . '/env.php';

    // Connect to MySQL database
    $db = mysqli_connect(getenv('DB_SERVER'), getenv('DB_USER'), getenv('DB_PASSWORD'), getenv('DB_NAME'));

    // Make sure database connection was successful
    if (mysqli_connect_errno()) {
        $message = 'Database connection failed: ';
        $message .= mysqli_connect_error();
        $message .= ' (' . mysqli_connect_errno() . ')';

        exit($message);
    }

    /**
     * The URI path is the path of the request URL without the initial and final slashes.
     * This variable is given a value by router.php.
     *
     * Example URL:
     * 'localhost:/personal_website/about/'
     * Corresponding URI path:
     * 'personal_website/about'
     */
    $uri_path = '';

    /**
     * The URI path array is an array of the URI path parts separated by slashes.
     * If there is a base URL directory defined, it will be ignored.
     * This variable is given a value by router.php.
     *
     * Example URL:                  'localhost:/personal_website/about/test'
     * Corresponding URI path:       'personal_website/about/test'
     * Corresponding URI path array: ['about', 'test']
     *
     * Example URL:                  'localhost:/about/test'
     * Corresponding URI path:       'about/test'
     * Corresponding URI path array: ['about', 'test']
     */
    $uri_path_array = [];

    /**
     * Contains information about the page, like the title of the page and the
     * path of the PHP file to execute to render the page.
     *
     * This variable will be given a value by router.php and used by page.php.
     */
    $page_info = [];

    // Router
    require __DIR__ . '/router.php';

    // Create page
    require __DIR__ . '/page.php';

    // Close MySQL database connection
    if (isset($db)) {
        mysqli_close($db);
    }
?>
