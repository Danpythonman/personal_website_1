DROP TABLE IF EXISTS projects;

CREATE TABLE projects (
    id INTEGER,
    title TEXT,
    description TEXT,
    display_image TEXT,
    path_ending TEXT,
    PRIMARY KEY (id)
);

DROP TABLE IF EXISTS project_page_sections;

CREATE TABLE project_page_sections (
    id INTEGER,
    project_id INTEGER,
    section_number INTEGER,
    section_type TEXT,
    section_content TEXT,
    PRIMARY KEY (id),
    FOREIGN KEY (project_id) REFERENCES projects(id)
);

DROP TABLE IF EXISTS project_images;

CREATE TABLE project_images (
    id INTEGER,
    project_id INTEGER,
    image_filename TEXT,
    image_number INTEGER,
    image_title TEXT,
    image_description TEXT,
    PRIMARY KEY (id),
    FOREIGN KEY (project_id) REFERENCES projects(id)
);
