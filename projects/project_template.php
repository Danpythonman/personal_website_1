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
