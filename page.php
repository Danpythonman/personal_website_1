<!DOCTYPE html>
<html>
    <head>
        <?php require __DIR__ . '/tag.php'; ?>
        <title><?= $page_info['title'] ?></title>
        <?php
            if ($page_info['meta_description']) {
        ?>
                <meta name="description" content="<?= $page_info['meta_description'] ?>">
        <?php
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
