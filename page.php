<!DOCTYPE html>
<html>
    <head>
        <?php require __DIR__ . '/tag.php'; ?>
        <title><?= $page_info['title'] ?></title>
        <?php
            if (array_key_exists('meta_description', $page_info)) {
        ?>
                <meta name="description" content="<?= $page_info['meta_description'] ?>">
                <meta property="og:image" content="<?= CDN_URL ?>images/open_graph_image.png">
        <?php
            }

            // Since there are two versions of the website (www and non-www),
            // I am designating non-www to be the canonical website.
            // If the URL has www and it not an error, then we add a canonical
            // link to the non-www version of the URL.

            // Check if page was not an error.
            // This means either the error field of the page_info associative
            // array was either not defined, or it is defined and is false.
            if (
                (!array_key_exists('error', $page_info))
                ||
                (array_key_exists('error', $page_info) && !$page_info['error'])
            ) {
                // Check if 'www.' is the first part of the domain
                if (strpos($_SERVER['HTTP_HOST'], 'www.') === 0) {
                    // Remove 'www.' from URL
                    $http_host_without_www = str_replace('www.', '', $_SERVER['HTTP_HOST']);

                    // Re-make the URL without 'www.'
                    $url_without_www = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? "https://" : "http://")
                        . $http_host_without_www
                        . $_SERVER['REQUEST_URI'];
        ?>
                    <link rel="canonical" href="<?= $url_without_www ?>">
        <?php
                }
            }
        ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/x-icon" href="<?= CDN_URL ?>icons/favicon.ico">
        <link rel="stylesheet" type="text/css" href="<?= CDN_URL ?>css/style.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans|Fjalla+One|Didact+Gothic">
    </head>
    <body>
        <?php require __DIR__ . '/navbar.php'; ?>

        <div id="main-content">
            <?php require $page_info['path_to_php_file']; ?>
        </div>

        <?php require __DIR__ . '/footer.php'; ?>

        <script src="<?= CDN_URL ?>js/open_menu.js"></script>
    </body>
</html>
