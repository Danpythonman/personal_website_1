<h1 class="page-title">My Work Experience</h1>
<p class="page-description">Take a look at my professional experience, as well as my resume in PDF format.</p>
<h2 class="page-heading">My Professional History</h2>
<?php
    $query = 'SELECT * FROM resume_sections ORDER BY section_number DESC';

    $resume_sections = mysqli_query($db, $query);

    if (!$resume_sections) {
        exit('Database query failed');
    }
?>
<div id="resume-html">
    <?php while ($resume_section = mysqli_fetch_assoc($resume_sections)) { ?>
        <div class="resume-section">
            <div class="job-header">
                <div class="job-information">
                    <h3 class="job-title"><?= $resume_section['title'] ?></h3>
                    <p class="company"><?= $resume_section['company'] ?></p>
                    <p class="duration-and-work-type"><?= $resume_section['duration_and_work_type'] ?></p>
                </div>
                <p class="job-description"><?= $resume_section['description'] ?></p>
            </div>
            <h4 class="job-accomplishments-title">What I Accomplished:</h4>
            <ul class="job-accomplishments">
                <?php
                    $query = 'SELECT * FROM resume_section_accomplishments WHERE resume_section_id=\'' . $resume_section['id'] . '\' ORDER BY accomplishment_number';

                    $accomplishments = mysqli_query($db, $query);

                    if (!$accomplishments) {
                        exit('Database query failed');
                    }

                    while ($accomplishment = mysqli_fetch_assoc($accomplishments)) {
                        echo '<li>' . $accomplishment['content'] . '</li>' . PHP_EOL;
                    }

                    mysqli_free_result($accomplishments);
                ?>
            </ul>
        </div>
    <?php
        }

        mysqli_free_result($resume_sections);
    ?>
</div>
<h2 class="page-heading">My Resume</h2>
<div class="page-description">
    <p>
        If the resume is not loading, please try refreshing the page.
        You can also download my resume PDF by <a href="/<?= getenv('BASE_URL_DIRECTORY') ?>/static/documents/daniel_di_giovanni_resume_2022-09-11.pdf" download>clicking here</a>.
    </p>
</div>
<iframe id="resume-pdf" src="/<?= getenv('BASE_URL_DIRECTORY') ?>/static/documents/daniel_di_giovanni_resume_2022-09-11.pdf"></iframe>
