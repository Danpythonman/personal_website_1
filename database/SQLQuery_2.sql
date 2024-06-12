SELECT * FROM `resume_sections`;

UPDATE
    `resume_sections`
SET
    `description` = 'In this position I worked as an e-commerce advisor for the government-funded <a class="link" href="https://ised-isde.canada.ca/site/canada-digital-adoption-program/en" target="_blank">Canada Digital Adoption Program (CDAP)</a>. The program essentially helps small businesses that have not made significant progress in bringing their business online. My role was to advise small businesses and give personalized help on digitizing their operations.',
    `duration_and_work_type` = 'May 2022 - October 2022 <i>(Full Time)</i>'
WHERE
    id = 2
    AND
    title = 'E-Commerce Advisor'
;
