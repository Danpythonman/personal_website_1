<?php
    // Load environment variables
    require __DIR__ . '/env.php';

    // Report all errors
    error_reporting(E_ALL);

    // Ignore repeated errors
    ini_set('ignore_repeated_errors', TRUE);

    // Display errors in PHP output.
    // Should be true for development, and false for production.
    ini_set('display_errors', DISPLAY_ERRORS);

    // Log errors in file
    ini_set('log_errors', TRUE);
    ini_set('error_log', 'log/error.log');

    // Import the exception handler and the CustomException class
    require __DIR__ . '/exception_handler.php';

    // Set the exception handler to the function imported in exception_handler.php
    set_exception_handler('exception_handler');

    // Connect to MySQL database
    $db = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);

    // Make sure database connection was successful
    if (mysqli_connect_errno()) {
        $message = 'Database connection failed: ';
        $message .= mysqli_connect_error();
        $message .= ' (' . mysqli_connect_errno() . ')';

        error_log($message);

        throw new CustomException('There was an error connecting to the database. This one\'s on our end.', 500);
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

    /**
     * Contains the scripts needed for the page being served. This way, all the
     * scripts can be defined dynamically at the bottom of the page.
     *
     * Elements of this array will are the file name of the script (without the
     * folder name, with the extension).
     *
     * This variable will be given a value by router.php and used by page.php.
     */
    $scripts = [];

    // Every page needs the open menu script
    $scripts[] = 'open_menu' . OPEN_MENU_VERSION . '.js';

    // Router
    require __DIR__ . '/router.php';

    // Start output buffer
    ob_start();

    // Create page
    require __DIR__ . '/page.php';

    // Flush output buffer (send output to client)
    if (ob_get_contents()) {
        ob_end_flush();
    }

    // Close MySQL database connection
    if (isset($db)) {
        mysqli_close($db);
    }
?>
