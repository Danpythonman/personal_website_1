<div class="page-header">
    <div class="section">
        <h1 class="page-title">My Work Experience</h1>
        <p class="paragraph">Take a look at my professional experience, as well as my resume in PDF format.</p>
    </div>
</div>
<?php
    $query = 'SELECT * FROM resume_sections ORDER BY section_number DESC';

    $resume_sections = mysqli_query($db, $query);

    if (!$resume_sections) {
        throw new CustomException("There was an error with the database. This one's on our end.", 500);
    }
?>
<h2 class="heading">My Professional History</h2>
<div id="resume-html">
    <?php while ($resume_section = mysqli_fetch_assoc($resume_sections)) { ?>
        <div class="resume-section section">
            <div class="job-header">
                <div class="job-information">
                    <h3 class="job-title"><?= $resume_section['title'] ?></h3>
                    <p class="company"><a class="link" href="<?= $resume_section['company_url'] ?>" target="_blank"><?= $resume_section['company'] ?></a></p>
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
                        throw new CustomException("There was an error with the database. This one's on our end.", 500);
                    }

                    while ($accomplishment = mysqli_fetch_assoc($accomplishments)) {
                        echo '<li><span>' . $accomplishment['content'] . '</span></li>' . PHP_EOL;
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
<div class="section">
    <h2 class="heading">My Resume</h2>
    <p class="paragraph">
        If the resume is not loading, please try refreshing the page.
        You can also download my resume PDF by <a class="link" href="<?= CDN_URL ?>documents/daniel_di_giovanni_resume_2023-08-29.pdf" download>clicking here</a>.
    </p>
</div>
<iframe id="resume-pdf" src="<?= CDN_URL ?>documents/daniel_di_giovanni_resume_2023-08-29.pdf"></iframe>
