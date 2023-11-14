# PHP Development Environment with Docker Compose

This setup includes a PHP development environment using Docker containers. It consists of three main services: `db` for the MariaDB database, `www` for the Apache server with PHP, and `phpmyadmin` for database management through a web interface.

## Services

### `db`
- **Service Name**: `db-1`
- **Image**: `mariadb:lts-jammy` - This image is the Long Term Support version of MariaDB based on Ubuntu Jammy.
- **Environment Variables**:
  - `MARIADB_ROOT_PASSWORD`: The root password for MariaDB. This must be set to initialize the database.
  - `MYSQL_DATABASE`: The name of the default database created upon initialization.
  - `MYSQL_USER`: The default user that is created upon initialization.
  - `MYSQL_PASSWORD`: The password for the `MYSQL_USER`. For security reasons, this should not be hardcoded in `docker-compose.yml` for production environments.
- **Volumes**:
  - `./db:/docker-entrypoint-initdb.d`: This volume persists the database data to the `./db` directory on the host machine.

### `www`
- **Service Name**: `www-1`
- **Image**: `php:apache` - This image includes PHP with Apache server.
- **Volumes**:
  - `./:/var/www/html`: This volume syncs the current directory on the host machine with the document root of the Apache server in the container.
- **Ports**:
  - `80:80`: The HTTP port for accessing the web application.
  - `443:443`: The HTTPS port for secure connections (SSL/TLS).

### `phpmyadmin`
- **Service Name**: `phpmyadmin-1`
- **Image**: `phpmyadmin/phpmyadmin` - The official phpMyAdmin Docker image for managing the database via a web interface.
- **Environment Variables**:
  - `PMA_HOST`: The hostname of the MariaDB service (`db`).
  - `PMA_PORT`: The port of the MariaDB service (`3306` by default).
- **Ports**:
  - `8001:80`: Port to access phpMyAdmin through a web browser.

## Accessing Services

- **Web Server**: Access the web application by navigating to `http://localhost` or `http://<host-ip-address>` in your web browser.
- **phpMyAdmin**: Access phpMyAdmin by navigating to `http://localhost:8001` or `http://<host-ip-address>:8001` in your web browser. Use the `MYSQL_USER` and `MYSQL_PASSWORD` to log in.

## Running the Containers

To run the containers, you must have Docker and Docker Compose installed on your system.

1. Clone this repository or download the `docker-compose.yml` file to your project directory.
2. Navigate to the directory containing the `docker-compose.yml` file.
3. Run the command `docker-compose up -d` to start the containers in detached mode.
4. To stop the containers, run the command `docker-compose down`.

Ensure that you replace any placeholder passwords with secure ones and store them properly as per your security protocols.

## Data Persistence

The data for each service is persisted as follows:

- **MariaDB Data**: Stored in the `./db` directory on the host machine. This ensures that your database persists across container restarts.
- **Web Application Files**: The current directory is mapped to the Apache document root, so any files added to your project directory are served by the web server.

Remember to back up the `./db` directory regularly to avoid data loss.
