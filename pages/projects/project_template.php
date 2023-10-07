<?php
    $query = 'SELECT * FROM projects WHERE url_endpoint = \'' . end($uri_path_array) . '\'';

    $result = mysqli_query($db, $query);

    if (!$result) {
        throw new CustomException("There was an error with the database. This one's on our end.", 500);
    }

    $project = mysqli_fetch_assoc($result);

    mysqli_free_result($result);
?>

<div class="page-header">
    <div class="section">
        <h1 class="page-title"><?= $project['title'] ?></h1>
        <p class="paragraph"><?= $project['description'] ?></p>
        <div class="project-header-links">
            <?php
                $query = 'SELECT * FROM project_links WHERE project_url_endpoint=\'' . $project['url_endpoint'] . '\' ORDER BY link_number';

                $project_links = mysqli_query($db, $query);

                if (!$project_links) {
                    throw new CustomException("There was an error with the database. This one's on our end.", 500);
                }

                while ($project_link = mysqli_fetch_assoc($project_links)) {
                    if ($project_link['is_source_code']) {
            ?>
                <a href="<?= $project_link['link_url'] ?>" alt="<?= $project_link['link_alt_text'] ?>" target="_blank">
                    <p class="paragraph"><?= $project_link['link_text'] ?></p>
                    <img class="github-icon" src="<?= CDN_URL ?>icons/github.svg" alt="GitHub icon">
                </a>
            <?php
                    } else {
            ?>
                <a href="<?= $project_link['link_url'] ?>" alt="<?= $project_link['link_alt_text'] ?>" target="_blank">
                    <p class="paragraph"><?= $project_link['link_text'] ?></p>
                    <img class="open-link-icon" src="<?= CDN_URL ?>icons/open_link.svg" alt="Open link icon">
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
    $query = 'SELECT * FROM project_media WHERE project_url_endpoint=\'' . $project['url_endpoint'] . '\' ORDER BY media_number';

    $result = mysqli_query($db, $query);

    if (!$result) {
        throw new CustomException("There was an error with the database. This one's on our end.", 500);
    }

    if (mysqli_num_rows($result) > 0) {
?>
        <div class="section">
            <h2 class="subheading">Image Gallery</h2>
            <p class="paragraph">Click on an image to read more about it.</p>
        </div>
        <div id="project-image-gallery">
            <div class="project-image-gallery-arrow-button" id="project-image-gallery-previous-arrow-button">&#10094;</div>
            <div id="project-images">
                <?php
                    while ($project_media = mysqli_fetch_assoc($result)) {
                ?>
                        <div class="project-image-container">
                            <?php
                                if ($project_media['media_type'] == 'image') {
                            ?>
                                    <img class="project-image" onclick="openModal(this)" src="<?= CDN_URL . 'images/projects/' . $project_media['media_filename'] ?>" alt="<?= $project_media['media_alt_text'] ?>">
                            <?php
                                } else if ($project_media['media_type'] == 'video') {
                            ?>
                                    <video class="project-image" onclick="openModal(this)" muted autoplay loop>
                                        <source src="<?= CDN_URL ?>videos/<?= $project_media['media_filename'] ?>.webm" type="video/webm">
                                        <source src="<?= CDN_URL ?>videos/<?= $project_media['media_filename'] ?>.mp4" type="video/mp4">
                                    </video>
                            <?php
                                }
                            ?>
                            <h4 class="project-image-title"><?= $project_media['media_title'] ?></h4>
                            <p class="project-image-description"><?= $project_media['media_description'] ?></p>
                        </div>
                <?php
                    }
                ?>
            </div>
            <div class="project-image-gallery-arrow-button" id="project-image-gallery-next-arrow-button">&#10095;</div>
        </div>
<?php
    }

    mysqli_free_result($result);
?>

<?php
    $query = 'SELECT * FROM project_page_sections WHERE project_url_endpoint=\'' . $project['url_endpoint'] . '\' ORDER BY section_number';

    $result = mysqli_query($db, $query);

    if (!$result) {
        throw new CustomException("There was an error with the database. This one's on our end.", 500);
    }

    while ($project_page_section = mysqli_fetch_assoc($result)) {
        echo '<div class="section">' . PHP_EOL;

        if ($project_page_section['section_type'] == 'subheading') {
            echo '<h2 class="subheading">' . $project_page_section['section_content'] . '</h2>' . PHP_EOL;
        } else if ($project_page_section['section_type'] == 'paragraph') {
            echo '<p class="paragraph newline">' . $project_page_section['section_content'] . '</p>' . PHP_EOL;
        } else if ($project_page_section['section_type'] == 'youtube') {
            echo '<div class="youtube-embed">' . $project_page_section['section_content'] . '</div>';
        } else if ($project_page_section['section_type'] == 'pdf') {
            echo '<iframe class="pdf-embed" src="' . CDN_URL . 'documents/' . $project_page_section['section_content'] . '"></iframe>';
        }

        echo '</div>' . PHP_EOL;
    }

    mysqli_free_result($result);
?>
<div id="project-image-modal">
    <div class="project-image-modal-spacer" onclick="event.stopPropagation(); closeModal(this)">
        <div id="project-image-modal-close-button" onclick="closeModal(this)">&times;</div>
    </div>
    <div id="project-image-modal-content" onclick="event.stopPropagation(); closeModal(this)">
        <div id="project-image-modal-media" onclick="event.stopPropagation(); closeModal(this)">
            <!-- <img id="project-image-modal-image" onclick="event.stopPropagation(); closeModal(this)"> -->
        </div>
        <div id="project-image-modal-text" onclick="event.stopPropagation(); closeModal(this)">
            <h4 id="project-image-modal-title" onclick="event.stopPropagation(); closeModal(this)"></h4>
            <p id="project-image-modal-description" onclick="event.stopPropagation(); closeModal(this)"></p>
        </div>
    </div>
    <div class="project-image-modal-spacer" onclick="event.stopPropagation(); closeModal(this)">
    </div>
</div>

<script src="<?= CDN_URL ?>js/scroll_project_image_gallery.js"></script>
<script src="<?= CDN_URL ?>js/open_project_image_modal.js"></script>
