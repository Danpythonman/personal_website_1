<h1 class="page-title">My Projects</h1>
<div id="project-gallery">

    <?php
        $query = 'SELECT * FROM projects';

        $projects = mysqli_query($db, $query);

        if (!$projects) {
            exit('Database query failed');
        }
    ?>

    <?php while ($project = mysqli_fetch_assoc($projects)) { ?>
        <div class="project-card">
            <img class="project-card-image" src="/<?= getenv('BASE_URL_DIRECTORY') ?>/static/images/<?= $project['display_image'] ?>">
            <div class="project-card-text">
                <h2 class="project-card-title"><?= $project['title'] ?></h2>
                <p class="project-card-description"><?= $project['description'] ?></p>
                <a class="link" href="/<?=getenv('BASE_URL_DIRECTORY') . '/projects/' . $project['url_endpoint'] ?>" class="project-card-link">Read More</a>
            </div>
        </div>
    <?php
        }

        mysqli_free_result($projects);
    ?>
</div>
