<?php
    $url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? "https://" : "http://") . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
?>

<div id="error-page-header">
    <h1>Error 404 - We couldn't find this page :(</h1>
    <p class="section paragraph">The page <code><?= $url ?></code> could not be found.</p>
    <?php
        if ($_SERVER['REQUEST_URI'][-1] == '/') {
            $url_no_slash = substr($url, 0, strlen($url) - 1);
    ?>
        <p class="section paragraph">Try without the final slash: <code><a href="<?= $url_no_slash ?>"><?= $url_no_slash ?></a></code></p>
    <?php
        }
    ?>
</div>
