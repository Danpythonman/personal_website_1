SELECT * FROM `resume_sections`;

INSERT INTO
    `resume_sections`
    (
        `section_number`,
        `title`,
        `company`,
        `duration_and_work_type`,
        `description`,
        `company_url`
    )
VALUES
    (
        3,
        'Co-op Software Engineer',
        'PointClickCare',
        'January 2023 - August 2023 <i>(Full Time)</i>',
        'At <a class="link" href="https://pointclickcare.com/" target="_blank">PointClickCare</a> I gained experience in programming large-scale Java projects in a team of software engineers. I worked on a distributed messaging system that used serverless functions and an ETL data pipeline.',
        'https://pointclickcare.com/'
    )
;

UPDATE
    `resume_sections`
SET
    `description` = 'At <a class="link" href="https://pointclickcare.com/" target="_blank">PointClickCare</a> I gained experience in programming large-scale Java projects in a team of software engineers. Working on a distributed cloud messaging system and an ETL data pipeline I picked up many new skills, like <a class="link" href="https://spring.io/projects/spring-boot" target="_blank">Spring Boot</a> APIs, automating builds with <a class="link" href="https://www.jenkins.io/" target="_blank">Jenkins</a>, and <a class="link" href="https://www.terraform.io/" target="_blank">Terraform</a> for managing cloud resources.'
WHERE
    id = 3
    AND
    title = 'Co-op Software Engineer'
;

SELECT * FROM `resume_section_accomplishments`;
INSERT INTO `resume_section_accomplishments` (`resume_section_id`, `accomplishment_number`, `content`) VALUES (3, 1, 'Strengthened a telemetry system by tracking events in Java and catching them through KQL queries on Azure.');
INSERT INTO `resume_section_accomplishments` (`resume_section_id`, `accomplishment_number`, `content`) VALUES (3, 2, 'Used Terraform to update and create Azure cloud resources in multiple development and production environments.');
INSERT INTO `resume_section_accomplishments` (`resume_section_id`, `accomplishment_number`, `content`) VALUES (3, 3, 'Added endpoints to a Java Spring API to deliver metrics from a database to a React dashboard.');
INSERT INTO `resume_section_accomplishments` (`resume_section_id`, `accomplishment_number`, `content`) VALUES (3, 4, 'Wrote SQL queries to calculate metrics about whether the system was meeting the team''s SLA.');
INSERT INTO `resume_section_accomplishments` (`resume_section_id`, `accomplishment_number`, `content`) VALUES (3, 5, 'Wrote integration tests for an ETL database system, using Jenkins to schedule their runs.');
