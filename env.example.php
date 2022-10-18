<?php
    define('BASE_URL_DIRECTORY', 'personal_website/');

    define('ENVIRONMENT', 'DEVELOPMENT');

    if (ENVIRONMENT == 'DEVELOPMENT') {
        define('CDN_URL', '/' . BASE_URL_DIRECTORY . 'static/');
    } else {
        define('CDN_URL', 'https://cdn.domainname.com/');
    }

    define('DISPLAY_ERRORS', 'FALSE');

    define('DB_SERVER', 'hostname');
    define('DB_USER', 'database_username');
    define('DB_PASSWORD', 'database_user_password');
    define('DB_NAME', 'database_name');

    define('WEB3FORMS_ACCESS_KEY', '7f0126ae-14d3-4f4b-b5fd-0cd356a53558');
?>
