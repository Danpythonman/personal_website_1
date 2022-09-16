<?php
    $query = 'SELECT * FROM projects WHERE url_endpoint = \'' . end($uri_path_array) . '\'';

    $result = mysqli_query($db, $query);

    if (!$result) {
        exit('Database query failed');
    }

    $project = mysqli_fetch_assoc($result);

    mysqli_free_result($result);
?>

<div class="page-header">
    <div class="section">
        <h1 class="page-title"><?= $project['title'] ?></h1>
        <p class="paragraph"><?= $project['description'] ?></p>
    </div>
</div>
<div class="section">
    <h2 class="subheading">Image Gallery</h2>
    <p class="paragraph">Click on an image to read more about it.</p>
</div>
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
        ?>
            <div class="project-image-container">
                <img class="project-image" onclick="openModal(this)" src="/<?= getenv('BASE_URL_DIRECTORY') . '/static/images/' . $project_image['image_filename'] ?>" alt="<?= $project_image['image_alt_text'] ?>">
                <h4 class="project-image-title"><?= $project_image['image_title'] ?></h4>
                <p class="project-image-description"><?= $project_image['image_description'] ?></p>
            </div>
        <?php
            }

            mysqli_free_result($result);
        ?>
    </div>
    <div class="project-image-gallery-arrow-button" id="project-image-gallery-next-arrow-button">&#10095;</div>
</div>

<?php
    $query = 'SELECT * FROM project_page_sections WHERE project_url_endpoint=\'' . $project['url_endpoint'] . '\' ORDER BY section_number';

    $result = mysqli_query($db, $query);

    if (!$result) {
        exit('Database query failed');
    }

    while ($project_page_section = mysqli_fetch_assoc($result)) {
        echo '<div class="section">' . PHP_EOL;

        if ($project_page_section['section_type'] == 'subheading') {
            echo '<h2 class="subheading">' . $project_page_section['section_content'] . '</h2>' . PHP_EOL;
        } else if ($project_page_section['section_type'] == 'paragraph') {
            echo '<p class="paragraph newline">' . $project_page_section['section_content'] . '</p>' . PHP_EOL;
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
