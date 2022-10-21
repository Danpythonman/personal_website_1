DROP TABLE IF EXISTS projects;

CREATE TABLE projects (
    url_endpoint VARCHAR(50),
    title VARCHAR(50),
    description TEXT,
    meta_description TEXT,
    display_media VARCHAR(50),
    display_media_type ENUM('image', 'video'),
    number INT,
    PRIMARY KEY (url_endpoint)
);

DROP TABLE IF EXISTS project_page_sections;

CREATE TABLE project_page_sections (
    id INTEGER NOT NULL AUTO_INCREMENT,
    project_url_endpoint VARCHAR(50),
    section_number INTEGER,
    section_type VARCHAR(50),
    section_content TEXT,
    PRIMARY KEY (id),
    FOREIGN KEY (project_url_endpoint) REFERENCES projects(url_endpoint)
);

DROP TABLE IF EXISTS project_links;

CREATE TABLE project_links (
    id INTEGER NOT NULL AUTO_INCREMENT,
    project_url_endpoint VARCHAR(50),
    link_number INTEGER,
    link_text VARCHAR(50),
    link_url VARCHAR(250),
    link_alt_text VARCHAR(250),
    is_source_code BOOLEAN,
    PRIMARY KEY (id),
    FOREIGN KEY (project_url_endpoint) REFERENCES projects(url_endpoint)
);

DROP TABLE IF EXISTS project_media;

CREATE TABLE project_media (
    id INTEGER NOT NULL AUTO_INCREMENT,
    project_url_endpoint VARCHAR(50),
    media_type ENUM('image', 'video'),
    media_filename VARCHAR(50),
    media_number INTEGER,
    media_title VARCHAR(50),
    media_description TEXT,
    media_alt_text VARCHAR(250),
    PRIMARY KEY (id),
    FOREIGN KEY (project_url_endpoint) REFERENCES projects(url_endpoint)
);

DROP TABLE IF EXISTS resume_sections;

CREATE TABLE resume_sections (
    id INTEGER NOT NULL AUTO_INCREMENT,
    section_number INT,
    title VARCHAR(50),
    company VARCHAR(50),
    company_url VARCHAR(50),
    duration_and_work_type VARCHAR(50),
    description TEXT,
    PRIMARY KEY (id)
);

DROP TABLE IF EXISTS resume_section_accomplishments;

CREATE TABLE resume_section_accomplishments (
    id INTEGER NOT NULL AUTO_INCREMENT,
    resume_section_id INT,
    accomplishment_number INT,
    content VARCHAR(250),
    PRIMARY KEY (id),
    FOREIGN KEY (resume_section_id) REFERENCES resume_sections(id)
);

DROP TABLE IF EXISTS books;

CREATE TABLE books (
    title VARCHAR(250),
    author VARCHAR(250),
    image_url VARCHAR(250),
    book_url VARCHAR(250),
    currently_reading BOOLEAN
);
