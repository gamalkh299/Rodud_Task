# Rodud Task :
# Truck Ordering Application

## Project Overview
The **Truck Ordering Application** allows users to request trucks for shipping and track the status of their orders. The app provides the following features:
- User registration and authentication.
- Truck request form with details like location, size, weight, and delivery time.
- Admin interface to view and manage orders.
- Notifications (via email , database) to notify users about order status updates.
- Notification to admin when a new order is placed.
- API endpoints to interact with the system programmatically.

This project includes API functionality to allow the admin and users to interact with the system via RESTful endpoints.

## Technologies Used
- **Laravel**: A PHP framework for building web applications.
- **MySQL**: A relational database management system.
- **Nova Laravel**: A Laravel admin panel for managing resources (documentation [here](https://nova.laravel.com/docs)).
- **Mailtrap**: A fake SMTP server for testing email notifications.
- **Postman**: A collaboration platform for API development.
- **Git**: A version control system for tracking changes in the codebase.
- **Composer**: A dependency manager for PHP.
-  **Docker**: A platform for developing, shipping, and running applications in containers. 


## Setup Instructions

### 1. Clone the Repository
Clone this repository to your local machine:

```bash
git clone https://github.com/gamalkh299/Rodud_Task.git
```

### 2. Install Dependencies
Navigate to the project directory:

```bash
cd Rodud_Task
```

Install the project dependencies:

```bash
composer install
```
___
while installing composer dependencies, you will be asked to provide the following information:
- Nova Laravel email : 
- Nova Laravel password :

### this Info will be sent to you in the email
___

### 3. Set Up the Environment File
Create a new environment file:

```bash
cp .env.example .env
```

Generate a new application key:

```
php artisan key:generate
```

### 4. Set Up the Database
Create a new database and update the database configuration in the `.env` file:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=rodud_task
DB_USERNAME=root
DB_PASSWORD=
```

Run the database migrations:

```bash
php artisan migrate
```

Seed the database with dummy data:

```bash
php artisan db:seed
```



### 5. Start the Development Server
You can start the development server using the following command:

```bash
php artisan serve
```




