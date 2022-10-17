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
                <img class="project-card-image" src="/<?= BASE_URL_DIRECTORY . 'static/images/projects/' . $project['display_image'] ?>" alt="<?= $project['title'] ?> project">
            </a>
            <div class="project-card-text">
                <h2 class="project-card-title"><?= $project['title'] ?></h2>
                <p class="paragraph"><?= $project['description'] ?></p>
                <a class="link" href="/<?= BASE_URL_DIRECTORY . 'projects/' . $project['url_endpoint'] ?>" class="project-card-link" alt="<?= $project['title'] ?> project">Read More</a>
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
                        <div>
                            <a href="<?= $project_link['link_url'] ?>" alt="<?= $project_link['link_alt_text'] ?>" target="_blank">
                                <img class="github-icon" src="/<?= BASE_URL_DIRECTORY ?>static/icons/github.svg" alt="GitHub icon">
                            </a>
                            <a alt="test" class="link paragraph" href="<?= $project_link['link_url'] ?>" alt="<?= $project_link['link_alt_text'] ?>" target="_blank"><?= $project_link['link_text'] ?></a>
                        </div>
                    <?php
                            } else {
                    ?>
                        <div>
                            <a class="link paragraph" href="<?= $project_link['link_url'] ?>" alt="<?= $project_link['link_alt_text'] ?>" target="_blank"><?= $project_link['link_text'] ?></a>
                            <a href="<?= $project_link['link_url'] ?>" alt="<?= $project_link['link_alt_text'] ?>" target="_blank">
                                <img class="open-link-icon" src="/<?= BASE_URL_DIRECTORY ?>static/icons/open_link.svg" alt="Open link icon">
                            </a>
                        </div>
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
