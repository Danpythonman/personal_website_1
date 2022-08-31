<!DOCTYPE html>
<html>
    <head>
        <title><?= $title ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="<?= $request_info['base_url_directory'] ?>/static/css/style.css">
    </head>
    <body>
        <?php require __DIR__ . '/navbar.php'; ?>

        <?php require $request_info['router_path']; ?>

    </body>
</html>
