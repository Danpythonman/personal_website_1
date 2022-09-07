<!DOCTYPE html>
<html>
    <head>
        <title><?= $page_info['title'] ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="/<?= getenv('BASE_URL_DIRECTORY') ?>/static/css/style.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans|Fjalla+One">
    </head>
    <body>
        <?php require __DIR__ . '/navbar.php'; ?>

        <div id="main-content">
            <?php require $page_info['path_to_php_file']; ?>
        </div>

        <script src="/<?= getenv('BASE_URL_DIRECTORY') ?>/static/js/open_menu.js"></script>
    </body>
</html>
