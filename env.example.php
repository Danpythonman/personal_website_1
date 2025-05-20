<?php
    define('BASE_URL_DIRECTORY', getenv('BASE_URL_DIRECTORY') ?: 'personal_website/');

    define('ENVIRONMENT', getenv('ENVIRONMENT') ?: 'DEVELOPMENT');

    if (ENVIRONMENT == 'DEVELOPMENT') {
        define('CDN_URL', '/' . BASE_URL_DIRECTORY . 'static/');
    } else {
        define('CDN_URL', 'https://cdn.domainname.com/');
    }

    define('DISPLAY_ERRORS', getenv('ENVIRONMENT') ?: 'FALSE');

    define('DB_SERVER', getenv('DB_SERVER') ?: 'hostname');
    define('DB_USER', getenv('DB_USER') ?: 'database_username');
    define('DB_PASSWORD', getenv('DB_PASSWORD') ?: 'database_user_password');
    define('DB_NAME', getenv('DB_NAME') ?: 'database_name');
    define('DB_PORT', getenv('DB_PORT') ?: 3306);

    define('WEB3FORMS_ACCESS_KEY', getenv('WEB3FORMS_ACCESS_KEY') ?: '7f0126ae-14d3-4f4b-b5fd-0cd356a53558');

    define('STYLE_VERSION', getenv('STYLE_VERSION') ?: '_v1');

    define('OPEN_MENU_VERSION', getenv('OPEN_MENU_VERSION') ?: '_v1');
    define('HOMEPAGE_SCROLL_PROMPT_VERSION', getenv('HOMEPAGE_SCROLL_PROMPT_VERSION') ?: '_v1');
    define('OPEN_PROJECT_IMAGE_MODAL_VERSION', getenv('OPEN_PROJECT_IMAGE_MODAL_VERSION') ?: '_v1');
    define('SCROLL_PROJECT_IMAGE_GALLERY_VERSION', getenv('SCROLL_PROJECT_IMAGE_GALLERY_VERSION') ?: '_v1');
?>
