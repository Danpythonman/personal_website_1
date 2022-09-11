INSERT INTO projects (id, title, description, display_image, path_ending) VALUES (
    1,
    'Inspirational Website 2.0',
    'An inspiration website made with Node.js and React.',
    'inspirational_website_preview.gif',
    'inspirational-website-2'
);

INSERT INTO project_page_sections (id, project_id, section_number, section_type, section_content) VALUES (
    1,
    1,
    1,
    'subheading',
    'Features of the Backend'
);

INSERT INTO project_page_sections (id, project_id, section_number, section_type, section_content) VALUES (
    2,
    1,
    2,
    'paragraph',
    'The backend is a REST API written in JavaScript (using the Node.js runtime environment). ExpressJS is used for webserver functionality. The backend is organized into models, routes, controllers, and services. The models and database interaction is done through Mongoose, which connects to a MongoDB Atlas database in the cloud. Email functionality is achieved through Sendgrid. JsonWebToken is used for authorization and node-fetch is used to simplify some API calls.'
);

INSERT INTO project_page_sections (id, project_id, section_number, section_type, section_content) VALUES (
    3,
    1,
    3,
    'subheading',
    'Features of the Frontend'
);

INSERT INTO project_page_sections (id, project_id, section_number, section_type, section_content) VALUES (
    4,
    1,
    4,
    'paragraph',
    'The frontend is written in React. The MUI library is used to implement common components like dialogs, accordions, and icon buttons. The frontend uses Axios to simplify API calls to the backend. The frontend is served via GitHub pages.'
);

INSERT INTO project_page_sections (id, project_id, section_number, section_type, section_content) VALUES (
    5,
    1,
    5,
    'paragraph',
    'The quotes come from the database, which is populated by users who submit quotes to the website. The background image comes from NASA''s Astronomy Picture of the Day API.'
);

INSERT INTO project_images (id, project_id, image_filename, image_number, image_title, image_description) VALUES (
    1,
    1,
    'inspirational_website_preview.gif',
    1,
    'Inspirational Website Use',
    'Here is a standard use of the website (apologies for the low quality). We can see the inspirational quote, background image, and the to-do list.'
);

INSERT INTO project_images (id, project_id, image_filename, image_number, image_title, image_description) VALUES (
    2,
    1,
    'inspiration_website_signup.jpg',
    2,
    'Entering Inspirational Website 2.0',
    'The three options to enter the website are to log in, sign up (as is show in the expanded view), and continue as a guest.'
);

INSERT INTO project_images (id, project_id, image_filename, image_number, image_title, image_description) VALUES (
    3,
    1,
    'inspiration_website_login.jpg',
    3,
    'Login Section',
    'This the expanded login view. No password is required, just your email and the verification code that we send to it upon any login request.'
);

INSERT INTO project_images (id, project_id, image_filename, image_number, image_title, image_description) VALUES (
    4,
    1,
    'inspiration_website_todo_list.jpg',
    4,
    'The To-Do List',
    'Each user''s to-do list is stored on a MongoDB Atlas database. This also keeps track of which tasks are completed.'
);

INSERT INTO projects (id, title, description, display_image, path_ending) VALUES (
    2,
    'TAB2XML',
    'Converts text-based music tablature to playable sheet music with Java.',
    'tab2xml_preview.gif',
    'tab2xml'
);

INSERT INTO projects (id, title, description, display_image, path_ending) VALUES (
    3,
    'Sorting Algorithm Visualizer',
    'Visualizes sorting algorithms in real time.',
    'selection_sort_visualization.gif',
    'sorting-algorithm-visualizer'
);
