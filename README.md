# My Personal Website

This repository contains the source code for my personal website, which showcases my projects, resume, and contact information. The website is built using PHP, MySQL, and Docker, and is styled with custom CSS and JavaScript.

## Prerequisites

To run this project you need all of the following:

- **Docker** and **Docker Compose** installed.
- **PHP** and **Apache** installed (if not using Docker for running the server).
- **MariaDB** (or MySQL) installed (if not using Docker for the database).
- **Systemd** (if deploying).

## Setup (for Local Development or Production Deployment)

1. Clone the repository:

   ```bash
    git clone https://github.com/Danpythonman/personal_website_1.git
    cd personal_website
   ```

2. Copy the example environment file and configure it:

   ```bash
   cp env.example.php env.php
   ```

   This is where database credentials and other constants used throughout the project are configured.

3. Copy the tag file and configure it:

   ```bash
   cp tag.example.php tag.php
   ```

   For local development and testing, feel free to make the file empty. The file needs only to exist for the pages to work correctly.

4. Ensure the database is running.

   - **If using MariaDB without Docker:**

     Information about MariaDB can be found at [mariadb.org](https://mariadb.org/).

     In short, to install and configure MariaDB, first install the MariaDB server. In Debian, this can be done with the command:

     ```bash
     sudo apt install mariadb-server
     ```

     Then run the safe install script.

     ```bash
     sudo mysql_secure_installation
     ```

     From there you can access the database (as root user) by running:

     ```bash
     sudo mariadb
     ```

     But you'll probably want to make (and use) a non-root user for better security. Make sure the user has the only the privileges they need.

     ```sql
     CREATE USER 'myuser'@'%' IDENTIFIED BY 'mypassword';
     GRANT ALL PRIVILEGES ON mydb.* TO 'myuser'@'%';
     FLUSH PRIVILEGES;
     ```

     > Note that `%` means **any host**, so if you're only going to be connecting via localhost, you can change it to `localhost`.

     **Important:** If you're connecting to MariaDB from anywhere other than localhost (including from inside a Docker container), you must change the bind address in `/etc/mysql/mariadb.conf.d/50-server.cnf`. To allow access from any host, set it to `0.0.0.0`. (However, for better security it can be set to the IP address that will be connecting to the database, if you know it.)

   - **If using MariaDB in Docker:**

     The database can be run in a Docker container by pulling and running the official MariaDB image.

     ```bash
     docker pull mariadb && \
     docker run --name my-mariadb \
        -e MARIADB_ROOT_PASSWORD=my-secret-pw \
        -e MARIADB_DATABASE=mydb \
        -e MARIADB_USER=myuser \
        -e MARIADB_PASSWORD=mypassword \
        -p 3306:3306 \
        -d mariadb
     ```

5. Import the database schema and data.

   - **If using MariaDB without Docker:**

     ```bash
     mariadb -u myuser -D mydb -p < database/schema.sql
     mariadb -u myuser -D mydb -p < database/data.sql
     ```

   - **If using MariaDB with Docker:**

     ```bash
     docker exec -i <db-container-name> mariadb -u <db-user> -p<db-password> <db-name> < database/schema.sql
     docker exec -i <db-container-name> mariadb -u <db-user> -p<db-password> <db-name> < database/data.sql
     ```

     > Note that the above command uses the database user's password in plaintext, **so only use this for testing/development**.
     >
     > A more secure way would be to copy the SQL file into the Docker container and run the file from inside the container.
     >
     > ```bash
     > docker cp database/schema.sql <db-container-name>:/schema.sql
     > docker cp database/data.sql <db-container-name>:/data.sql
     > sudo docker exec -it <db-container-name> bash
     > mariadb -u myuser -D mydb -p < schema.sql
     > mariadb -u myuser -D mydb -p < data.sql
     > ```

6. Run the server.

   - **If running without Docker:**

     1. First, make sure you have PHP and Apache installed.

        ```bash
        sudo apt install apache2 php libapache2-mod-php php-mysql
        ```

     2. Remove the default files in the `/var/www/html` directory (assuming nothing else is in the directory).

        ```bash
        sudo rm /var/www/html/*
        ```

     3. Copy the project files to the `/var/www/html` directory.

        ```bash
        sudo cp /path/to/project/* /var/www/html/
        ```

        Alternatively you can clone the repository directly from GitHub into `/var/www/html/`. Just make sure you setup the repository correctly (see steps 1-3 above).

     4. Set the correct permissions for the `/var/www/html/` directory.

        ```bash
        sudo chown -R www-data:www-data /var/www/html
        sudo chmod -R 755 /var/www/html
        ```

     5. Copy the Apache virtual host file to `/etc/apache2/sites-available/`

        ```bash
        sudo cp /path/to/project/apache/apache-vhost.conf /etc/apache2/sites-available/personal-website.conf
        ```

     6. Enable the website and reload Apache.

        ```bash
        sudo a2ensite personal-website.conf
        sudo a2enmod rewrite
        sudo systemctl reload apache2
        ```

        The website should be running at [localhost:80](http://localhost:80).

     7. (Optional) Edit `/etc/hosts` to create a mapping between personal-website.local and localhost.

        ```bash
        echo "127.0.0.1 personal-website.local" | sudo tee -a /etc/hosts
        ```

        The website should be running at [personal-website.local/](http://personal-website.local/).

   - **If running with Docker:**

     Use Docker Compose to run the PHP Apache server.

     ```bash
     docker compose up -d --build
     ```

     The website should be running at [localhost:8080](http://localhost:8080).

7. (Optional) If deploying to production, you can manage the service with Systemd. Follow the instructions in [systemd/README.md](./systemd/README.md).

## Contributing

Contributions are welcome! Feel free to open issues or submit pull requests.

## License

This project is licensed under the MIT License. See the [LICENSE](./LICENSE) file for details.

## Contact

If you have any questions or feedback, feel free to reach out via the Contact Page or connect with me on LinkedIn at [linkedin.com/in/daniel-di-giovanni/](https://www.linkedin.com/in/daniel-di-giovanni/) or send me an email at [dannyjdigio@gmail.com](mailto:dannyjdigio@gmail.com).
