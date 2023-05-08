## Prerequisites

- PHP 8.1 or higher
- Composer
- MySQL or MariaDB

## Installation

1. Clone the repository to your local machine:

   ```bash
   git clone https://github.com/hichambound1/miniCrm

2. Navigate to the project directory:
   
   ```bash
   cd miniCrm

3. Install the project dependencies using Composer:

    ```bash
    composer install

4. Copy the .env.example file to create a new .env file:
    
    ```bash
    cp .env.example .env
    
5. Update the .env file with your database credentials:

    ```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=[database-name]
    DB_USERNAME=[database-username]
    DB_PASSWORD=[database-password]

6. Generate a new application key:
    
    ```bash
    php artisan key:generate

7. Run the database migrations to create the required tables:

    ```bash
    php artisan migrate

8. Seed the database with some sample data:

    ```bash
    php artisan db:seed

9. Run the queues
    ```bash
    php artisan queue:listen
    
10. Start the development server:

    ```bash
    php artisan serve

## RUN THE PROJECT

Navigate to http://localhost:8000 in your web browser to access the application
