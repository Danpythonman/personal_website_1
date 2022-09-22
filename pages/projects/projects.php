<div class="page-header">
    <div class="section">
    <h1 class="page-title">My Projects</h1>
    <p class="paragraph">Here are the projects I've completed over the years.</p>
    </div>
</div>
<div id="project-gallery">

    <?php
        $query = 'SELECT * FROM projects';

        $projects = mysqli_query($db, $query);

        if (!$projects) {
            exit('Database query failed');
        }
    ?>

    <?php while ($project = mysqli_fetch_assoc($projects)) { ?>
        <div class="project-card section">
            <a class="project-card-image-link" href="/<?= BASE_URL_DIRECTORY . 'projects/' . $project['url_endpoint'] ?>" alt="<?= $project['title'] ?> project">
                <img class="project-card-image" src="/<?= BASE_URL_DIRECTORY . 'static/images/' . $project['display_image'] ?>" alt="<?= $project['title'] ?> project">
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
                        exit('Database query failed');
                    }

                    while ($project_link = mysqli_fetch_assoc($project_links)) {
                        if ($project_link['is_source_code']) {
                ?>
                    <div>
                        <a href="<?= $project_link['link_url'] ?>" alt="<?= $project_link['link_alt_text'] ?>" target="_blank">
                            <svg class="github-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512">
                                <!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                <path d="M165.9 397.4c0 2-2.3 3.6-5.2 3.6-3.3.3-5.6-1.3-5.6-3.6 0-2 2.3-3.6 5.2-3.6 3-.3 5.6 1.3 5.6 3.6zm-31.1-4.5c-.7 2 1.3 4.3 4.3 4.9 2.6 1 5.6 0 6.2-2s-1.3-4.3-4.3-5.2c-2.6-.7-5.5.3-6.2 2.3zm44.2-1.7c-2.9.7-4.9 2.6-4.6 4.9.3 2 2.9 3.3 5.9 2.6 2.9-.7 4.9-2.6 4.6-4.6-.3-1.9-3-3.2-5.9-2.9zM244.8 8C106.1 8 0 113.3 0 252c0 110.9 69.8 205.8 169.5 239.2 12.8 2.3 17.3-5.6 17.3-12.1 0-6.2-.3-40.4-.3-61.4 0 0-70 15-84.7-29.8 0 0-11.4-29.1-27.8-36.6 0 0-22.9-15.7 1.6-15.4 0 0 24.9 2 38.6 25.8 21.9 38.6 58.6 27.5 72.9 20.9 2.3-16 8.8-27.1 16-33.7-55.9-6.2-112.3-14.3-112.3-110.5 0-27.5 7.6-41.3 23.6-58.9-2.6-6.5-11.1-33.3 2.6-67.9 20.9-6.5 69 27 69 27 20-5.6 41.5-8.5 62.8-8.5s42.8 2.9 62.8 8.5c0 0 48.1-33.6 69-27 13.7 34.7 5.2 61.4 2.6 67.9 16 17.7 25.8 31.5 25.8 58.9 0 96.5-58.9 104.2-114.8 110.5 9.2 7.9 17 22.9 17 46.4 0 33.7-.3 75.4-.3 83.6 0 6.5 4.6 14.4 17.3 12.1C428.2 457.8 496 362.9 496 252 496 113.3 383.5 8 244.8 8zM97.2 352.9c-1.3 1-1 3.3.7 5.2 1.6 1.6 3.9 2.3 5.2 1 1.3-1 1-3.3-.7-5.2-1.6-1.6-3.9-2.3-5.2-1zm-10.8-8.1c-.7 1.3.3 2.9 2.3 3.9 1.6 1 3.6.7 4.3-.7.7-1.3-.3-2.9-2.3-3.9-2-.6-3.6-.3-4.3.7zm32.4 35.6c-1.6 1.3-1 4.3 1.3 6.2 2.3 2.3 5.2 2.6 6.5 1 1.3-1.3.7-4.3-1.3-6.2-2.2-2.3-5.2-2.6-6.5-1zm-11.4-14.7c-1.6 1-1.6 3.6 0 5.9 1.6 2.3 4.3 3.3 5.6 2.3 1.6-1.3 1.6-3.9 0-6.2-1.4-2.3-4-3.3-5.6-2z"/>
                            </svg>
                        </a>
                        <a alt="test" class="link paragraph" href="<?= $project_link['link_url'] ?>" alt="<?= $project_link['link_alt_text'] ?>" target="_blank"><?= $project_link['link_text'] ?></a>
                    </div>
                <?php
                        } else {
                ?>
                    <div>
                        <a class="link paragraph" href="<?= $project_link['link_url'] ?>" alt="<?= $project_link['link_alt_text'] ?>" target="_blank"><?= $project_link['link_text'] ?></a>
                        <a href="<?= $project_link['link_url'] ?>" alt="<?= $project_link['link_alt_text'] ?>" target="_blank">
                            <svg class="open-link-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                <path d="M288 32c-17.7 0-32 14.3-32 32s14.3 32 32 32h50.7L169.4 265.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L384 141.3V192c0 17.7 14.3 32 32 32s32-14.3 32-32V64c0-17.7-14.3-32-32-32H288zM80 64C35.8 64 0 99.8 0 144V400c0 44.2 35.8 80 80 80H336c44.2 0 80-35.8 80-80V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v80c0 8.8-7.2 16-16 16H80c-8.8 0-16-7.2-16-16V144c0-8.8 7.2-16 16-16h80c17.7 0 32-14.3 32-32s-14.3-32-32-32H80z"/>
                            </svg>
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
