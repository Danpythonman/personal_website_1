DROP TABLE IF EXISTS projects;

CREATE TABLE projects (
    url_endpoint VARCHAR(50),
    title VARCHAR(50),
    description TEXT,
    display_image VARCHAR(50),
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

DROP TABLE IF EXISTS project_images;

CREATE TABLE project_images (
    id INTEGER NOT NULL AUTO_INCREMENT,
    project_url_endpoint VARCHAR(50),
    image_filename VARCHAR(50),
    image_number INTEGER,
    image_title VARCHAR(50),
    image_description TEXT,
    PRIMARY KEY (id),
    FOREIGN KEY (project_url_endpoint) REFERENCES projects(url_endpoint)
);
