<div class="page-header">
    <div class="section">
    <h1 class="page-title">My Projects</h1>
    <p class="paragraph">Here are the projects I've completed over the years.</p>
    </div>
</div>
<div id="project-gallery">

    <?php
        $query = 'SELECT * FROM projects ORDER BY number';

        $projects = mysqli_query($db, $query);

        if (!$projects) {
            throw new CustomException("There was an error with the database. This one's on our end.", 500);
        }
    ?>

    <?php while ($project = mysqli_fetch_assoc($projects)) { ?>
        <div class="project-card section">
            <a class="project-card-image-link" href="/<?= BASE_URL_DIRECTORY . 'projects/' . $project['url_endpoint'] ?>" alt="<?= $project['title'] ?> project">
                <?php
                    if ($project['display_media_type'] == 'image') {
                ?>
                        <img class="project-card-image" src="<?= CDN_URL . 'images/projects/' . $project['display_media'] ?>" alt="<?= $project['title'] ?> project">
                <?php
                    }

                    else if ($project['display_media_type'] == 'video') {
                ?>
                        <video class="project-card-image" muted autoplay loop>
                            <source src="<?= CDN_URL ?>videos/low_res/<?= $project['display_media'] ?>.webm" type="video/webm">
                            <source src="<?= CDN_URL ?>videos/low_res/<?= $project['display_media'] ?>.mp4" type="video/mp4">
                        </video>
                <?php
                    }
                ?>
            </a>
            <div class="project-card-text">
                <a class="project-card-title" href="/<?= BASE_URL_DIRECTORY . 'projects/' . $project['url_endpoint'] ?>" alt="<?= $project['title'] ?> project"><?= $project['title'] ?></a>
                <p class="paragraph"><?= $project['description'] ?></p>
                <div class="horizontal-line"></div>
                <div class="project-card-links">
                    <?php
                        $query = 'SELECT * FROM project_links WHERE project_url_endpoint=\'' . $project['url_endpoint'] . '\' ORDER BY link_number';

                        $project_links = mysqli_query($db, $query);

                        if (!$project_links) {
                            throw new CustomException("There was an error with the database. This one's on our end.", 500);
                        }

                        while ($project_link = mysqli_fetch_assoc($project_links)) {
                            if ($project_link['is_source_code']) {
                    ?>
                        <a class="link" href="<?= $project_link['link_url'] ?>" alt="<?= $project_link['link_alt_text'] ?>" target="_blank">
                            <div class="code-link">
                                <img class="github-icon" src="<?= CDN_URL ?>icons/github.svg" alt="GitHub icon">
                                <p class="paragraph"><?= $project_link['link_text'] ?></p>
                            </div>
                        </a>
                    <?php
                            } else {
                    ?>
                        <a class="link" href="<?= $project_link['link_url'] ?>" alt="<?= $project_link['link_alt_text'] ?>" target="_blank">
                            <div class="non-code-link">
                                <p class="paragraph"><?= $project_link['link_text'] ?></p>
                                <img class="open-link-icon" src="<?= CDN_URL ?>icons/open_link.svg" alt="Open link icon">
                            </div>
                        </a>
                    <?php
                            }
                        }

                        mysqli_free_result($project_links);
                    ?>
                </div>
            </div>
        </div>
    <?php
        }

        mysqli_free_result($projects);
    ?>
</div>
