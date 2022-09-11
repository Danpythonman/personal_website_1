INSERT INTO projects (id, title, description, display_image, path_ending) VALUES (
    1,
    'Inspirational Website 2.0',
    'An inspiration website made with Node.js and React.',
    'inspirational_website_preview.gif',
    'inspirational-website-2'
);

INSERT INTO project_page_sections (project_id, section_number, section_type, section_content) VALUES (
    1,
    1,
    'subheading',
    'Features of the Backend'
);

INSERT INTO project_page_sections (project_id, section_number, section_type, section_content) VALUES (
    1,
    2,
    'paragraph',
    'The backend is a REST API written in JavaScript (using the Node.js runtime environment). ExpressJS is used for webserver functionality. The backend is organized into models, routes, controllers, and services. The models and database interaction is done through Mongoose, which connects to a MongoDB Atlas database in the cloud. Email functionality is achieved through Sendgrid. JsonWebToken is used for authorization and node-fetch is used to simplify some API calls.'
);

INSERT INTO project_page_sections (project_id, section_number, section_type, section_content) VALUES (
    1,
    3,
    'subheading',
    'Features of the Frontend'
);

INSERT INTO project_page_sections (project_id, section_number, section_type, section_content) VALUES (
    1,
    4,
    'paragraph',
    'The frontend is written in React. The MUI library is used to implement common components like dialogs, accordions, and icon buttons. The frontend uses Axios to simplify API calls to the backend. The frontend is served via GitHub pages.'
);

INSERT INTO project_page_sections (project_id, section_number, section_type, section_content) VALUES (
    1,
    5,
    'paragraph',
    'The quotes come from the database, which is populated by users who submit quotes to the website. The background image comes from NASA''s Astronomy Picture of the Day API.'
);

INSERT INTO project_page_sections (project_id, section_number, section_type, section_content) VALUES (
    1,
    6,
    'subheading',
    'Security'
);

INSERT INTO project_page_sections (project_id, section_number, section_type, section_content) VALUES (
    1,
    7,
    'paragraph',
    'You may have noticed that users do not use passwords! This is possible through JSON Web Tokens (JWTs) and email verification. When a user attempts to log in, they only enter their email. A verification code is sent to that email and the user needs to enter this code to log in. Once they enter the correct code, an authentication and a refresh token are sent to the user to use for further API calls.'
);

INSERT INTO project_page_sections (project_id, section_number, section_type, section_content) VALUES (
    1,
    8,
    'paragraph',
    'The authentication token lasts for a few minutes and the refresh token lasts for about a month. When the authentication token expires, the refresh token is sent to get e new one. When the refresh token expires, the user must log in again. The use of tokens is hidden to the user; sending and refreshing tokens is handled by the code in the frontend.'
);

INSERT INTO project_images (project_id, image_filename, image_number, image_title, image_description) VALUES (
    1,
    'inspirational_website_preview.gif',
    1,
    'Inspirational Website Use',
    'Here is a standard use of the website (apologies for the low quality). We can see the inspirational quote, background image, and the to-do list.'
);

INSERT INTO project_images (project_id, image_filename, image_number, image_title, image_description) VALUES (
    1,
    'inspiration_website_signup.jpg',
    2,
    'Entering Inspirational Website 2.0',
    'The three options to enter the website are to log in, sign up (as is show in the expanded view), and continue as a guest.'
);

INSERT INTO project_images (project_id, image_filename, image_number, image_title, image_description) VALUES (
    1,
    'inspiration_website_login.jpg',
    3,
    'Login Section',
    'This the expanded login view. No password is required, just your email and the verification code that we send to it upon any login request.'
);

INSERT INTO project_images (project_id, image_filename, image_number, image_title, image_description) VALUES (
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

INSERT INTO project_page_sections (project_id, section_number, section_type, section_content) VALUES (
    2,
    1,
    'subheading',
    'Project Overview'
);

INSERT INTO project_page_sections (project_id, section_number, section_type, section_content) VALUES (
    2,
    2,
    'paragraph',
    'TAB2XML was a project for a software development course at York University. The previous semester wrote code to convert text-based music tablature to MusicXML format. My team and I (five students including myself) were tasked with taking this MusicXML that is produced from the tablature, dynamically displaying sheet music from it, and playing the piece of music.'
);

INSERT INTO project_page_sections (project_id, section_number, section_type, section_content) VALUES (
    2,
    3,
    'paragraph',
    'This project is written in Java with the JavaFX library for the GUI.'
);

INSERT INTO project_page_sections (project_id, section_number, section_type, section_content) VALUES (
    2,
    4,
    'subheading',
    'Features'
);

INSERT INTO project_page_sections (project_id, section_number, section_type, section_content) VALUES (
    2,
    5,
    'paragraph',
    'My group and I were able to mostly complete all of these tasks. Our program is able to dynamically generate sheet music for tablature for guitar, bass, and drums. It even handles complex music concepts like changing time signatures, tied notes, grouping notes with beams, and more.'
);

INSERT INTO project_page_sections (project_id, section_number, section_type, section_content) VALUES (
    2,
    6,
    'paragraph',
    'We were also able to add playing functionality for all the instruments. Whenever the sheet music is generated, it can play it too. It is lacking more complex control over the playing however, like starting at a certain location in the score, and it has some bugs with the separate threads for playing and viewing.'
);

INSERT INTO project_images (project_id, image_filename, image_number, image_title, image_description) VALUES (
    2,
    'tab2xml_preview.gif',
    1,
    'Converting Tablature with TAB2XML',
    'This shows how a user would input music tablature (by copying and pasting plain text) and viewing the output sheet music.'
);

INSERT INTO project_images (project_id, image_filename, image_number, image_title, image_description) VALUES (
    2,
    'tab2xml_input_preview.jpg',
    2,
    'TAB2XML Tablature Input',
    'This is the window where the text-based tablature is entered. Clicking the "Preview Sheet Music" button in the bottom-right will open the sheet music preview window. The specific tablature in this image produces the guitar sheet music that is shown earlier in this image gallery.'
);

INSERT INTO project_images (project_id, image_filename, image_number, image_title, image_description) VALUES (
    2,
    'tab2xml_guitar_preview.jpg',
    3,
    'Previewing Guitar Sheet Music',
    'This is a complex example of the type of guitar tablature than can be parsed and previewed by TAB2XML.'
);

INSERT INTO project_images (project_id, image_filename, image_number, image_title, image_description) VALUES (
    2,
    'tab2xml_drums_preview.jpg',
    4,
    'Previewing Drums Sheet Music',
    'This is a complex example of the type of drum tablature than can be parsed and previewed by TAB2XML.'
);

INSERT INTO project_images (project_id, image_filename, image_number, image_title, image_description) VALUES (
    2,
    'tab2xml_bass_preview.jpg',
    5,
    'Previewing Bass Sheet Music',
    'This is an example of the type of bass tablature than can be parsed and previewed by TAB2XML.'
);

INSERT INTO projects (id, title, description, display_image, path_ending) VALUES (
    3,
    'Sorting Algorithm Visualizer',
    'Visualizes sorting algorithms in real time.',
    'selection_sort_visualization.gif',
    'sorting-algorithm-visualizer'
);

INSERT INTO project_page_sections (project_id, section_number, section_type, section_content) VALUES (
    3,
    1,
    'subheading',
    'Features'
);

INSERT INTO project_page_sections (project_id, section_number, section_type, section_content) VALUES (
    3,
    2,
    'paragraph',
    'This project is a sorting algorithm visualizer written in Python. The GUI is made with the built-in Tkinter library. This was made as a result of learning about sorting algorithms in my last year of high school. At the time, I had learned selection sort, bubble sort, insertion sort, and merge sort. I implemented these sorting algorithms in the program and represented the array in memory by rectangles on screen, and updated the screen whenever the array was modified.'
);

INSERT INTO project_page_sections (project_id, section_number, section_type, section_content) VALUES (
    3,
    3,
    'subheading',
    'Limitations'
);

INSERT INTO project_page_sections (project_id, section_number, section_type, section_content) VALUES (
    3,
    4,
    'paragraph',
    'One functionality I would like to add is changing the number of rectangles being sorted. Currently, there can only be 64 rectangles. Having the user change this number would mean the width of the rectangles would also need to change. However, seeing the difference that different lise sizes make would be interesting.'
);

INSERT INTO project_page_sections (project_id, section_number, section_type, section_content) VALUES (
    3,
    5,
    'paragraph',
    'I would also like to add a speed option, where a user can speed up or slow down the sorting. This might be as simple as adding or subtracting space between each iteration of the algorithm. This would be useful for slowing down algorithms to inspect them closer, or speeding up the more slow algorithms (I''m looking at you, bubble sort).'
);

INSERT INTO project_images (project_id, image_filename, image_number, image_title, image_description) VALUES (
    3,
    'selection_sort_visualization.gif',
    1,
    'Selection Sort Visualized',
    'This is the real-time visualization of the selection sort algorithm, shown by rectangles being sorted from smallest to largest.'
);

INSERT INTO project_images (project_id, image_filename, image_number, image_title, image_description) VALUES (
    3,
    'merge_sort_visualization.gif',
    2,
    'Merge Sort Visualized',
    'This is the real-time visualization of the merge sort algorithm, shown by rectangles being sorted from smallest to largest.'
);

INSERT INTO project_images (project_id, image_filename, image_number, image_title, image_description) VALUES (
    3,
    'insertion_sort_visualization.gif',
    3,
    'Insertion Sort Visualized',
    'This is the real-time visualization of the insertion sort algorithm, shown by rectangles being sorted from smallest to largest.'
);

INSERT INTO project_images (project_id, image_filename, image_number, image_title, image_description) VALUES (
    3,
    'bubble_sort_visualization.gif',
    3,
    'Bubble Sort Visualized',
    'This is the real-time visualization of the bubble sort algorithm, shown by rectangles being sorted from smallest to largest.'
);
