DROP TABLE IF EXISTS `books`;

DROP TABLE IF EXISTS `project_links`;
DROP TABLE IF EXISTS `project_media`;
DROP TABLE IF EXISTS `project_page_sections`;
DROP TABLE IF EXISTS `projects`;

DROP TABLE IF EXISTS `resume_section_accomplishments`;
DROP TABLE IF EXISTS `resume_sections`;
--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `title` varchar(250) DEFAULT NULL,
  `author` varchar(250) DEFAULT NULL,
  `image_url` varchar(250) DEFAULT NULL,
  `book_url` varchar(250) DEFAULT NULL,
  `currently_reading` tinyint(1) DEFAULT NULL
);

--
-- Dumping data for table `books`
--

INSERT INTO
  `books`
  (`title`, `author`, `image_url`, `book_url`, `currently_reading`)
VALUES
  ('All Quiet on the Western Front','Erich Maria Remarque, Arthur Wesley Wheen (Translator)','https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1632027397l/355697._SY475_.jpg','https://www.goodreads.com/book/show/355697.All_Quiet_on_the_Western_Front',1),
  ('The Hitchhiker''s Guide to the Galaxy','Douglas Adams','https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1590830485l/53654093._SY475_.jpg','https://www.goodreads.com/book/show/53654093-the-hitchhiker-s-guide-to-the-galaxy',0),
  ('Brave New World','Aldous Huxley, Margaret Atwood (introduction)','https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1389018641l/3273565.jpg','https://www.goodreads.com/book/show/3273565-brave-new-world',0),
  ('A Brief History of Time','Stephen Hawking, Carl Sagan (Introduction)','https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1388348984l/17351.jpg','https://www.goodreads.com/book/show/17351.A_Brief_History_of_Time',0)
;

--
-- Table structure for table `projects`
--


CREATE TABLE `projects` (
  `url_endpoint` varchar(50) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `description` text,
  `meta_description` text NOT NULL,
  `display_media` varchar(50) DEFAULT NULL,
  `display_media_type` enum('image','video') NOT NULL,
  `number` int NOT NULL,
  PRIMARY KEY (`url_endpoint`)
);

--
-- Dumping data for table `projects`
--

INSERT INTO
  `projects`
  (`url_endpoint`, `title`, `description`, `meta_description`, `display_media`, `display_media_type`, `number`)
VALUES
  ('automated-plant-watering','Automated Plant Watering System','Automates plant watering with a micro-controller, sensors, and actuators.','Project overview of the Automated Plant Watering System, an C++ program on an Arduino-compatible board that monitors and waters a plant.','plant_watering_system.jpg','image',4),
  ('inspirational-website-2','Inspirational Website 2.0','An inspirational website with a daily quote and astronomy image, and a to-do list. Made with Node.js and React.','Project overview of Inspirational Website 2.0, a web app with a to-do list and a new quote and astronomy image every day.','inspirational_website_preview','video',3),
  ('machine-learning-technical-report','Machine Learning Technical Report','A technical report about machine learning''s use in cybersecurity. Written for an assignment at York University.','Project overview of the Machine Learning Technical Report, a paper written for a university assignment about machine learning''s use in cybersecurity.','technical_report_toc.jpg','image',5),
  ('sorting-algorithm-visualizer','Sorting Algorithm Visualizer','Visualizes sorting algorithms in real time. Made with Python.','Project overview of the Sorting Algorithm Visualizer, a Python GUI that animates different sorting algorithms in real-time.','selection_sort_visualization','video',1),
  ('tab2xml','TAB2XML','Converts text-based music tablature to playable sheet music. Made in a group project at York University using Java.','Project overview of TAB2XML, a Java GUI that converts text-based tablature to sheet music with audio playing capabilities.','tab2xml_preview','video',2),
  ('mnist-digit-predictor','MNIST Digit Predictor','Convolutional neural network trained from scratch with PyTorch to predict hand-drawn digits.','Project overview of MNIST Digit Predictor, a Tensorflow and Flask webapp that predicts hand-drawn digits.','mnist_digit_predictor_preview','video',0)
;

--
-- Table structure for table `project_links`
--

CREATE TABLE `project_links` (
  `id` int NOT NULL AUTO_INCREMENT,
  `project_url_endpoint` varchar(50) DEFAULT NULL,
  `link_number` int DEFAULT NULL,
  `link_text` varchar(50) DEFAULT NULL,
  `link_url` varchar(250) DEFAULT NULL,
  `link_alt_text` varchar(250) DEFAULT NULL,
  `is_source_code` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `project_url_endpoint` (`project_url_endpoint`),
  CONSTRAINT `project_links_ibfk_1` FOREIGN KEY (`project_url_endpoint`) REFERENCES `projects` (`url_endpoint`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `project_links`
--

INSERT INTO
  `project_links`
  (`id`, `project_url_endpoint`, `link_number`, `link_text`, `link_url`, `link_alt_text`, `is_source_code`)
VALUES
  (60,'inspirational-website-2',0,'View Site','https://inspiration.danieldigiovanni.com','Inspirational Website 2.0 live website',0),
  (61,'inspirational-website-2',1,'Backend Source Code','https://github.com/Danpythonman/inspiration_v2_backend','Inspirational Website 2.0 backend GitHub repository',1),
  (62,'inspirational-website-2',2,'Frontend Source Code','https://github.com/Danpythonman/inspiration_v2_frontend','Inspirational Website 2.0 frontend GitHub repository',1),
  (63,'tab2xml',0,'Source Code','https://github.com/ElmiraOn/EECS2311_group6','TAB2XML GitHub repository',1),
  (64,'sorting-algorithm-visualizer',0,'Source Code','https://github.com/ElmiraOn/EECS2311_group6','Sorting Algorithm Visualizer GitHub repository',1),
  (65,'automated-plant-watering',0,'Demonstration','https://www.youtube.com/watch?v=4W5B_MV7vOU','Automated plant watering system demonstration video',0),
  (66,'automated-plant-watering',1,'Source Code','https://github.com/Danpythonman/automated_plant_watering','Automated plant watering system source code',1),
  (67,'machine-learning-technical-report',0,'Source Code','https://github.com/Danpythonman/ENG2003_term_project1','The LaTeX project for the technical report',1),
  (68,'mnist-digit-predictor',0,'Source Code','https://github.com/Danpythonman/mnist_digit_predictor','MNIST Digit Predictor GitHub repository',1),
  (69,'mnist-digit-predictor',0,'View Site','https://mnist.danieldigiovanni.com/','MNIST Digit Predictor live website',0)
;

--
-- Table structure for table `project_media`
--

CREATE TABLE `project_media` (
  `id` int NOT NULL AUTO_INCREMENT,
  `project_url_endpoint` varchar(50) DEFAULT NULL,
  `media_type` enum('image','video') DEFAULT NULL,
  `media_filename` varchar(50) DEFAULT NULL,
  `media_number` int DEFAULT NULL,
  `media_title` varchar(50) DEFAULT NULL,
  `media_description` text,
  `media_alt_text` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `project_url_endpoint` (`project_url_endpoint`),
  CONSTRAINT `project_media_ibfk_1` FOREIGN KEY (`project_url_endpoint`) REFERENCES `projects` (`url_endpoint`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `project_media`
--

INSERT INTO
  `project_media`
  (`id`, `project_url_endpoint`, `media_type`, `media_filename`, `media_number`, `media_title`, `media_description`, `media_alt_text`)
VALUES
  (14,'inspirational-website-2','video','inspirational_website_preview',0,'Inspirational Website Use','Here is a standard use of the website (apologies for the low quality). We can see the inspirational quote, background image, and the to-do list.','Inspirational Website 2.0 being used'),
  (15,'inspirational-website-2','image','inspiration_website_signup.jpg',1,'Entering Inspirational Website 2.0','The three options to enter the website are to log in, sign up (as is show in the expanded view), and continue as a guest.','The log in and sign up page for Inspirational Website 2.0'),
  (16,'inspirational-website-2','image','inspiration_website_login.jpg',2,'Login Section','This the expanded login view. No password is required, just your email and the verification code that we send to it upon any login request.','The log in section for Inspirational Website 2.0, including the verification code input'),
  (17,'inspirational-website-2','image','inspiration_website_todo_list.jpg',3,'The To-Do List','Each user''s to-do list is stored on a MongoDB Atlas database. This also keeps track of which tasks are completed.','The to-do list for Inspirational Website 2.0'),
  (18,'tab2xml','video','tab2xml_preview',0,'Converting Tablature with TAB2XML','This shows how a user would input music tablature (by copying and pasting plain text) and viewing the output sheet music.','TAB2XML being used by inputting tablature and seeing the sheet music output'),
  (19,'tab2xml','image','tab2xml_input_preview.jpg',1,'TAB2XML Tablature Input','This is the window where the text-based tablature is entered. Clicking the \"Preview Sheet Music\" button in the bottom-right will open the sheet music preview window. The specific tablature in this image produces the guitar sheet music that is shown earlier in this image gallery.','The text-based music tablature input for TAB2XML'),
  (20,'tab2xml','image','tab2xml_guitar_preview.jpg',2,'Previewing Guitar Sheet Music','This is a complex example of the type of guitar tablature than can be parsed and previewed by TAB2XML.','TAB2XML sheet music output for guitar'),
  (21,'tab2xml','image','tab2xml_drums_preview.jpg',3,'Previewing Drums Sheet Music','This is a complex example of the type of drum tablature than can be parsed and previewed by TAB2XML.','TAB2XML sheet music output for drums'),
  (22,'tab2xml','image','tab2xml_bass_preview.jpg',4,'Previewing Bass Sheet Music','This is an example of the type of bass tablature than can be parsed and previewed by TAB2XML.','TAB2XML sheet music output for bass'),
  (23,'sorting-algorithm-visualizer','video','selection_sort_visualization',0,'Selection Sort Visualized','This is the real-time visualization of the selection sort algorithm, shown by rectangles being sorted from smallest to largest.','Animation of selection sort by sorting blue rectangles from smallest to largest'),
  (24,'sorting-algorithm-visualizer','video','merge_sort_visualization',1,'Merge Sort Visualized','This is the real-time visualization of the merge sort algorithm, shown by rectangles being sorted from smallest to largest.','Animation of merge sort by sorting blue rectangles from smallest to largest'),
  (25,'sorting-algorithm-visualizer','video','insertion_sort_visualization',2,'Insertion Sort Visualized','This is the real-time visualization of the insertion sort algorithm, shown by rectangles being sorted from smallest to largest.','Animation of insertion sort by sorting blue rectangles from smallest to largest'),
  (26,'sorting-algorithm-visualizer','video','bubble_sort_visualization',3,'Bubble Sort Visualized','This is the real-time visualization of the bubble sort algorithm, shown by rectangles being sorted from smallest to largest.','Animation of bubble sort by sorting blue rectangles from smallest to largest'),
  (27,'automated-plant-watering','image','plant_watering_system.jpg',0,'Automated Plant Watering System','This is the system when it still required the laptop to function. The Arduino is connected to a laptop running Java code which monitors the Arduino. The moisture sensor and pump connected to the Arduino are in the pot of soil, ready to water the plant.This is the system when it still required the laptop to function. The Arduino is connected to a laptop running Java code which monitors the Arduino. The moisture sensor and pump connected to the Arduino are in the pot of soil, ready to water the plant.','The automated plant watering system, consisting of a laptop, and Arduino board, a moisture sensor, and a pump'),
  (28,'automated-plant-watering','image','annotated_plant_watering_system.png',1,'Annotated System','The same image of the plant watering system, with labels. This shows the all the different parts, like the moisture sensor, water pump, MOSFET (switch), battery pack, etc.','An annotated image of the automated plant watering system, consisting of a laptop, and Arduino board, a moisture sensor, a pump, and other small components'),
  (29,'automated-plant-watering','image','plant_watering_system_flowchart.png',2,'Flowchart of System','This is a flowchart describing a high-level overview of the flow of the the system. We check if the soil is moist, and if it is, we wait, then check again. Once the soil is dry, we check if there is water in the pump. If there is water, then activate the pump to water the plant. Otherwise, turn on the light to signal that more water is needed.','A flowchart showing the normal program flow of the automated plant watering system'),
  (30,'automated-plant-watering','image','plant_watering_system_components.png',3,'Components Illustration of System','This is a high-level diagram of the parts of the automated plant watering system. The programmer interacts with the PC, which sends the program to the Arduino. The Arduino interfaces with the plant through the moisture sensor (for collecting data), and the water pump (for watering the plant).','A diagram showing the components of the automated plant watering system and their connections'),
  (31,'automated-plant-watering','image','plant_watering_system_drawing.jpg',4,'Drawing of the System','Before getting to work on the plant watering system, the project started with drawings and plans. This is a drawing of how the system would physically look, with the plant and the Arduino and all of its instruments.','A rough sketch of the automated plant watering system'),
  (32,'mnist-digit-predictor','video','mnist_digit_predictor_preview',0,'Predicting Hand-Drawn Digits','The user draws a digit on the canvas, which is then converted to an image and sent to the server, where it is input into the model for prediction.','MNIST digit predictor website predicting a hand-drawn digit.'),
  (33,'mnist-digit-predictor','image','mnist_gradcam',1,'Grad-CAM Visualization','Grad-CAM is a method for analyzing the layers of convolutional neural networks. In this image, each example has two rows: the original image on top and a very slightly transformed image below. (Neural activations are shown for each output class.) However, the activations are sometimes very different as a result of this very small transformation. This insight helped me design a better training strategy to get the network more accurate.','MNIST digit predictor Grad-CAM.'),
  (34,'mnist-digit-predictor','image','mnist_confusion_1',2,'Initial Confusion Matrix','Inspecting the confusion matrix after initial training, we see that the model''s predictions worsen significantly from translations and shear transformations. The translation insight was a big alarm bell: the features detected should be the same regardless of where in the image they are.','Confusion matrix of initial model.'),
  (35,'mnist-digit-predictor','image','mnist_graph_1',3,'Initial Loss and Accuracy Graphs','Indeed, there was a lower limit to the validation loss we were seeing, whereas the training loss continued to decrease. This means we were overfitting the training data. To further confirm, notice how quickly the training accuracy reaches near 100%, only to abruptly taper off.','Initial training and validation loss graphs.'),
  (36,'mnist-digit-predictor','image','mnist_confusion_2',4,'Improved Confusion Matrix','After training more aggressively on image transformations, the model had no problem with identifying the correct digit, even with translation and shear.','Confusion matrix after improving the model.'),
  (37,'mnist-digit-predictor','image','mnist_graph_2',5,'Improved Loss and Accuracy Graphs','With the improved model, the validation loss follows a very similar trend to the training loss, meaning we are no longer overfitting. Also notice that the training accuracy increases more slowly toward 100%, indicating that it is learning more difficult trends, which ended up being more general for digit prediction.','Improved training and validation loss graphs.')
;

--
-- Table structure for table `project_page_sections`
--

CREATE TABLE `project_page_sections` (
  `id` int NOT NULL AUTO_INCREMENT,
  `project_url_endpoint` varchar(50) DEFAULT NULL,
  `section_number` int DEFAULT NULL,
  `section_type` varchar(50) DEFAULT NULL,
  `section_content` text,
  PRIMARY KEY (`id`),
  KEY `project_url_endpoint` (`project_url_endpoint`),
  CONSTRAINT `project_page_sections_ibfk_1` FOREIGN KEY (`project_url_endpoint`) REFERENCES `projects` (`url_endpoint`)
) ENGINE=InnoDB AUTO_INCREMENT=281 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `project_page_sections`
--

INSERT INTO
  `project_page_sections`
  (`id`, `project_url_endpoint`, `section_number`, `section_type`, `section_content`)
VALUES
  (244,'inspirational-website-2',0,'subheading','Features of the Backend')
  ,(245,'inspirational-website-2',1,'paragraph','The backend is a REST API written in JavaScript (using the Node.js runtime environment) and ExpressJS is used for webserver functionality. The backend is organized into models, routes, controllers, and services. The models and database interaction is done through Mongoose, which connects to a MongoDB Atlas database in the cloud. Email functionality is achieved through Sendgrid, JsonWebToken is used for authorization, and node-fetch is used to simplify some API calls.')
  ,(246,'inspirational-website-2',2,'subheading','Features of the Frontend')
  ,(247,'inspirational-website-2',3,'paragraph','The frontend is written in React, with some help from the MUI library to implement common UI components like dialogs, accordions, and icon buttons. Axios is also used to simplify API calls to the backend. The frontend is served via GitHub pages.')
  ,(248,'inspirational-website-2',4,'paragraph','The quotes come from the MongoDB Atlas cloud database, which is populated by users who submit quotes to the website. The background image comes from <a class=\"link\" href=\"https://apod.nasa.gov/apod/astropix.html\" target=\"_blank\">NASA''s Astronomy Picture of the Day API</a>.')
  ,(249,'inspirational-website-2',5,'subheading','Security')
  ,(250,'inspirational-website-2',6,'paragraph','You may have noticed that users do not use passwords! This is possible through JSON Web Tokens (JWTs) and email verification. When a user attempts to log in, they only enter their email. A verification code is sent to that email and the user needs to enter this code to log in. Once they enter the correct code, an authentication and a refresh token are sent to the user to authorize them for further API calls.')
  ,(251,'inspirational-website-2',7,'paragraph','The authentication token lasts for a few minutes and the refresh token lasts for about a month. When the authentication token expires, the refresh token is sent to the API to make a new one. When the refresh token expires, the user must log in again. The use of tokens is hidden to the user; sending and refreshing tokens is handled by the code in the frontend.')
  ,(252,'tab2xml',0,'subheading','Project Overview')
  ,(253,'tab2xml',1,'paragraph','TAB2XML was a project for a software development course at York University. The previous semester''s class wrote a program to convert text-based music tablature to MusicXML format. My team and I (five students including myself) were tasked with extending this program to dynamically display the result as sheet music and to play it.')
  ,(254,'tab2xml',2,'paragraph','This project is written in Java with the JavaFX library for the GUI. We also used Gradle for managing dependencies. The size of the project required my team and I to effectively use Git to manage our contributions and branches.')
  ,(255,'tab2xml',3,'subheading','Features')
  ,(256,'tab2xml',4,'paragraph','My team and I were able to mostly complete all of the tasks set out. Our program dynamically generates sheet music from tablature for guitar, bass, and drums. It even handles complex music concepts like changing time signatures, tied notes, grouping notes with beams, and more.')
  ,(257,'tab2xml',5,'paragraph','We were also able to add playing functionality for all the instruments; whenever the sheet music is generated, it can play it too. However, It is lacking more complex control over the playing, like starting at a certain location in the score. It also has some bugs with the separate threads used for playing and viewing.')
  ,(258,'sorting-algorithm-visualizer',0,'subheading','Features')
  ,(259,'sorting-algorithm-visualizer',1,'paragraph','This project is a sorting algorithm visualizer written in Python. The GUI was made using the built-in Tkinter library.')
  ,(260,'sorting-algorithm-visualizer',2,'paragraph','I made this project after learning about sorting algorithms in my last year of high school. At the time, I had learned selection sort, bubble sort, insertion sort, and merge sort. I implemented these sorting algorithms in this program and represented the array in memory by rectangles on screen. Then, as the array is manipulated by the algorithm, the positions of the rectangles are correspondingly updated.')
  ,(261,'sorting-algorithm-visualizer',3,'subheading','Limitations')
  ,(262,'sorting-algorithm-visualizer',4,'paragraph','One functionality that I did not implement but would like to add is changing the number of rectangles being sorted. Currently, there can only be 64 rectangles. Visually seeing the effect that different list sizes have on the efficiency of the each algorithm would be very interesting.')
  ,(263,'sorting-algorithm-visualizer',5,'paragraph','I would also like to add a speed option, where a user can speed up or slow down the sorting. This might be as simple as adding or subtracting small periods of time between each iteration of the algorithm. This would be useful for slowing down algorithms to inspect them closer, or speeding up the more slow algorithms (I''m looking at you, bubble sort).')
  ,(264,'automated-plant-watering',0,'subheading','Video Demonstration')
  ,(265,'automated-plant-watering',1,'youtube','<iframe src=\"https://www.youtube.com/embed/4W5B_MV7vOU\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>')
  ,(266,'automated-plant-watering',2,'subheading','How the Project Started')
  ,(267,'automated-plant-watering',3,'paragraph','This project started as an assignment for a course at York University called <i>Computational Thinking Through Mechatronics</i>. Our final project in the course was to build a physical system that automates plant watering.')
  ,(268,'automated-plant-watering',4,'paragraph','To do this, we used an Arduino-compatible board with a moisture sensor, a water pump, a MOSFET switch, and some other small components. We used C++ to program the board and we used MATLAB and Java to control the board from an external computer.')
  ,(269,'automated-plant-watering',5,'paragraph','Essentially, the moisture sensor detects when the soil is dry, and the pump is used to water the plant when that occurs. This was controlled primarily through MATLAB and Java in an external computer, where we could also display data about soil measurements.')
  ,(270,'automated-plant-watering',6,'subheading','Extending the Project')
  ,(271,'automated-plant-watering',7,'paragraph','After I finished the course, I realized that the external computer was not necessary for the basic soil monitoring and plant watering functionality. So, I decided to rewrite the C++ program on the board to handle this entirely, without any external computer running MATLAB or Java.')
  ,(272,'automated-plant-watering',8,'paragraph','I also added functionality where information about the state of the soil is displayed on an OLED screen on the board. This acts as a substitute for the external computer''s display of data.')
  ,(273,'machine-learning-technical-report',0,'subheading','Read the Report')
  ,(274,'machine-learning-technical-report',1,'pdf','technical_report.pdf')
  ,(275,'machine-learning-technical-report',2,'subheading','Assignment at York University')
  ,(276,'machine-learning-technical-report',3,'paragraph','This technical report was written for an assignment at York University in a course called <i>Effective Engineering Communication</i>. In this course, we studied and practiced professional communication in many settings pertaining to engineering.')
  ,(277,'machine-learning-technical-report',4,'paragraph','The topic of the technical report was to argue how a certain new technology might help solve one of the <a class=\"link\" href=\"http://www.engineeringchallenges.org/challenges.aspx\" alt=\"Engineering Grand Challenges\" target=\"_blank\">Engineering Grand Challenges</a>. The challenge I chose to address was <a class=\"link\" href=\"http://www.engineeringchallenges.org/9042.aspx\" alt=\"The Engineering Grand Challenge of Securing Cyberspace\" target=\"_blank\">Securing Cyberspace</a>.')
  ,(278,'machine-learning-technical-report',5,'paragraph','After conducting research through academic papers, company reports, and articles, I decided that machine learning is a promising technology for solving this Engineering Grand Challenge, and this was the argument of my report.')
  ,(279,'machine-learning-technical-report',6,'subheading','Use of LaTeX')
  ,(280,'machine-learning-technical-report',7,'paragraph','I used LaTeX to write the technical report. This way, I could organize all the sections into separate tex files, and I could let the LaTeX compiler handle complicated parts like making the table of contents and bibliography. I also just like the way LaTeX documents look, and I felt comfortable in the coding environment.')
  ,(281,'mnist-digit-predictor',0,'subheading','How it Works')
  ,(282,'mnist-digit-predictor',1,'paragraph','The model that predicts digits is a convolutional neural network that is trained on the <a class=\"link\" href=\"https://en.wikipedia.org/wiki/MNIST_database\" alt=\"Wikipedia page for the MNIST dataset\" target=\"_blank\">MNIST dataset</a>, which is dataset of images of handwritten digits. The neural network was trained from scratch using the <a class=\"link\" href=\"https://pytorch.org/\" alt=\"PyTorch official website\" target=\"_blank\">PyTorch Python library</a>.')
  ,(283,'mnist-digit-predictor',2,'paragraph','I converted the neural network to ONNX after training, which was small enough to deploy via AWS Lambda with reasonably fast inference time. The frontend is a Vite app, which compiles to a static website. I deployed this to Google Cloud Storage. As a result, the entire end-to-end application is hosted essentially for free.')
  ,(284,'mnist-digit-predictor',3,'paragraph','This project was an valuable learning experience for me. I learned how to troubleshoot and problem solve in a data-heavy system. I could no longer rely on debuggers and code tracing because even if the code is correct the model was still underperforming. I had to add many skills to my toolbox, like visualizing data, setting up experiments to find root causes, and creatively searching for new solutions.')
  ,(285,'mnist-digit-predictor',4,'paragraph','One of the main problems I had during development was the model being unable to handle transformations of the image. For example, it could guess the digit if it were directly in the middle of the image, but any slight translation and the model didn''t know what to do. After much visualization and testing, I decided the best way forward was to aggressively train on transformed images from the start. So, in the training loop, random transformations would be applied without any gradual increase. This forced the model to learn actual features regardless of their scale or position, rather than memorizing the data distribution.')
;

--
-- Table structure for table `resume_sections`
--

CREATE TABLE `resume_sections` (
  `id` int NOT NULL AUTO_INCREMENT,
  `section_number` int DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `company` varchar(50) DEFAULT NULL,
  `duration_and_work_type` varchar(50) DEFAULT NULL,
  `description` text,
  `company_url` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `resume_sections`
--

INSERT INTO
  `resume_sections`
  (`id`, `section_number`, `title`, `company`, `duration_and_work_type`, `description`, `company_url`)
VALUES
  (1,1,'Full Stack Developer','Dwella Investing','June 2021 - December 2021 <i>(Part Time)</i>','<a class=\"link\" href=\"https://dwellainvesting.com/#/\" target=\"_blank\">Dwella Investing</a> is a startup based in Toronto, Ontario, Canada whose goal is to use the blockchain to tokenize real estate investments. As a full-stack developer, I worked extensively on the frontend and backend of Dwella''''s platform. I also had the opportunity to interact with the Ethereum blockchain through working on the frontend.','https://dwellainvesting.com/#/'),
  (2,2,'E-Commerce Advisor','Digital Main Street','May 2022 - October 2022 <i>(Full Time)</i>','In this position I worked as an e-commerce advisor for the government-funded <a class=\"link\" href=\"https://ised-isde.canada.ca/site/canada-digital-adoption-program/en\" target=\"_blank\">Canada Digital Adoption Program (CDAP)</a>. The program essentially helps small businesses that have not made significant progress in bringing their business online. My role was to advise small businesses and give personalized help on digitizing their operations.','https://digitalmainstreet.ca/'),
  (3,3,'Co-op Software Engineer','PointClickCare','January 2023 - August 2023 <i>(Full Time)</i>','At <a class=\"link\" href=\"https://pointclickcare.com/\" target=\"_blank\">PointClickCare</a> I gained experience in programming large-scale Java projects in a team of software engineers. Working on a distributed cloud messaging system and an ETL data pipeline I picked up many new skills, like <a class=\"link\" href=\"https://spring.io/projects/spring-boot\" target=\"_blank\">Spring Boot</a> APIs, automating builds with <a class=\"link\" href=\"https://www.jenkins.io/\" target=\"_blank\">Jenkins</a>, and <a class=\"link\" href=\"https://www.terraform.io/\" target=\"_blank\">Terraform</a> for managing cloud resources.','https://pointclickcare.com/')
;

--
-- Table structure for table `resume_section_accomplishments`
--

CREATE TABLE `resume_section_accomplishments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `resume_section_id` int DEFAULT NULL,
  `accomplishment_number` int DEFAULT NULL,
  `content` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `resume_section_id` (`resume_section_id`),
  CONSTRAINT `resume_section_accomplishments_ibfk_1` FOREIGN KEY (`resume_section_id`) REFERENCES `resume_sections` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `resume_section_accomplishments`
--
INSERT INTO
  `resume_section_accomplishments`
  (`id`, `resume_section_id`, `accomplishment_number`, `content`)
VALUES
  (1,1,1,'Built backend REST API from scratch with lead programmer using Node.js, with the ExpressJS framework.'),
  (2,1,2,'Used MongoDB Atlas for the database and designed schemas with Mongoose.'),
  (3,1,3,'Built frontend dashboard using React and MUI library and connected it to the backend.'),
  (4,1,4,'Implemented JWT-based authorization system with authorization and refresh tokens.'),
  (5,1,5,'Provided technical guidance during meetings with team members in less technical roles.'),
  (6,1,6,'Continually adapted frontend and backend to changing specifications.'),
  (7,2,1,'Audited clients'' websites and gave recommendations for improvements.'),
  (8,2,2,'Assisted five clients in accessing a $2,400 micro-grant.'),
  (9,2,3,'Prepared resources, write-ups, and held meetings about e-commerce, digital marketing, and cybersecurity.'),
  (10,2,4,'Built a total of six websites using Shopify, Square, and Bookmark.'),
  (11,2,5,'Learned SEO best practices, implemented them in demo websites, and instructed clients on them.'),
  (12,2,6,'Created advertising campaigns on Google and Facebook.'),
  (13,3,1,'Strengthened a telemetry system by tracking events in Java and catching them through KQL queries on Azure.'),
  (14,3,2,'Used Terraform to update and create Azure cloud resources in multiple development and production environments.'),
  (15,3,3,'Added endpoints to a Java Spring API to deliver metrics from a database to a React dashboard.'),
  (16,3,4,'Wrote SQL queries to calculate metrics about whether the system was meeting the team''s SLA.'),
  (17,3,5,'Wrote integration tests for an ETL database system, using Jenkins to schedule their runs.')
;
