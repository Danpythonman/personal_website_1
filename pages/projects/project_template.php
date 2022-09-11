<?php
    $query = 'SELECT * FROM projects WHERE path_ending = \'' . end($uri_path_array) . '\'';

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
            $query = 'SELECT * FROM project_images WHERE project_id=\'' . $project['id'] . '\' ORDER BY image_number';

            $result = mysqli_query($db, $query);

            if (!$result) {
                exit('Database query failed');
            }

            while ($project_image = mysqli_fetch_assoc($result)) {
                echo '<img class="project-image" src="/' . getenv('BASE_URL_DIRECTORY') . '/static/images/' . $project_image['image_filename'] . '">';
            }

            mysqli_free_result($result);
        ?>

    </div>
    <div class="project-image-gallery-arrow-button" id="project-image-gallery-next-arrow-button">&#10095;</div>
</div>

<div class="project-page-sections">

<?php
    $query = 'SELECT * FROM project_page_sections WHERE project_id=\'' . $project['id'] . '\'';

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
<script src="/<?= getenv('BASE_URL_DIRECTORY') ?>/static/js/scroll_project_image_gallery.js"></script>
