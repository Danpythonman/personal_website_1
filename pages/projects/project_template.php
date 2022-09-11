<?php
    $query = 'SELECT * FROM projects WHERE url_endpoint = \'' . end($uri_path_array) . '\'';

    $result = mysqli_query($db, $query);

    if (!$result) {
        exit('Database query failed');
    }

    $project = mysqli_fetch_assoc($result);

    mysqli_free_result($result);
?>

<h1 class="page-title"><?= $project['title'] ?></h1>

<div id="project-image-gallery">
    <div class="project-image-gallery-arrow-button" id="project-image-gallery-previous-arrow-button">&#10094;</div>
    <div id="project-images">

        <?php
            $query = 'SELECT * FROM project_images WHERE project_url_endpoint=\'' . $project['url_endpoint'] . '\' ORDER BY image_number';

            $result = mysqli_query($db, $query);

            if (!$result) {
                exit('Database query failed');
            }

            while ($project_image = mysqli_fetch_assoc($result)) {
                echo '
                    <div class="project-image-container">
                        <img class="project-image" onclick="openModal(this)" src="/' . getenv('BASE_URL_DIRECTORY') . '/static/images/' . $project_image['image_filename'] . '">
                        <h4 class="project-image-title">' . $project_image['image_title'] . '</h4>
                        <p class="project-image-description">' . $project_image['image_description'] . '</p>
                    </div>
                    ';
            }

            mysqli_free_result($result);
        ?>

    </div>
    <div class="project-image-gallery-arrow-button" id="project-image-gallery-next-arrow-button">&#10095;</div>
</div>

<div class="project-page-sections">

<?php
    $query = 'SELECT * FROM project_page_sections WHERE project_url_endpoint=\'' . $project['url_endpoint'] . '\' ORDER BY section_number';

    $result = mysqli_query($db, $query);

    if (!$result) {
        exit('Database query failed');
    }

    while ($project_page_section = mysqli_fetch_assoc($result)) {
        if ($project_page_section['section_type'] == 'subheading') {
            echo '<h2 class="project-subheading">' . $project_page_section['section_content'] . '</h2>';
        } else if ($project_page_section['section_type'] == 'paragraph') {
            echo '<p class="project-paragraph">' . $project_page_section['section_content'] . '</p>';
        }
    }

    mysqli_free_result($result);
?>

</div>
<div id="project-image-modal">
    <div class="project-image-modal-spacer" onclick="event.stopPropagation(); closeModal(this)">
        <div id="project-image-modal-close-button" onclick="closeModal(this)">&times;</div>
    </div>
    <div id="project-image-modal-content" onclick="event.stopPropagation(); closeModal(this)">
        <img id="project-image-modal-image" onclick="event.stopPropagation(); closeModal(this)">
        <div id="project-image-modal-text" onclick="event.stopPropagation(); closeModal(this)">
            <h4 id="project-image-modal-title" onclick="event.stopPropagation(); closeModal(this)"></h4>
            <p id="project-image-modal-description" onclick="event.stopPropagation(); closeModal(this)"></p>
        </div>
    </div>
    <div class="project-image-modal-spacer" onclick="event.stopPropagation(); closeModal(this)">
    </div>
</div>

<script src="/<?= getenv('BASE_URL_DIRECTORY') ?>/static/js/scroll_project_image_gallery.js"></script>
<script src="/<?= getenv('BASE_URL_DIRECTORY') ?>/static/js/open_project_image_modal.js"></script>
