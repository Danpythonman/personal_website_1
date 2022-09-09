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

<?php
    $query = 'SELECT * FROM project_page_sections WHERE project_id=\'' . $project['id'] . '\'';

    $result = mysqli_query($db, $query);

    if (!$result) {
        exit('Database query failed');
    }
?>

<?php
    $project_section_array = ['', '', ''];
    while ($project_page_section = mysqli_fetch_assoc($result)) {
        if ($project_page_section['section_type'] == 'subheading') {
            echo '<h2>' . $project_page_section['section_content'] . '</h2>';
        } else if ($project_page_section['section_type'] == 'paragraph') {
            echo '<p>' . $project_page_section['section_content'] . '</p>';
        }
    }

    mysqli_free_result($result);
?>
