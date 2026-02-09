
# Project Setup Guide

This project is developed using **Laravel**. Follow the instructions below to set up and run the project on your local machine.

---

## Prerequisites

Ensure the following are installed on your system:

- PHP (compatible with the Laravel version used)
- Composer
- MySQL
- Git

---

## Installation Steps

### 1. Clone the Repository   

```bash
git clone https://github.com/harsh-prajapati06/URL-Shortener.git
```

---

### 2. Install Dependencies

```bash
composer install
```

---

### 3. Run Migrations

```bash
php artisan migrate
```

---

### 4. Create Super Admin User

```bash
php artisan db:seed --class=SuperAdminSeeder
```

---

### 5. Run the Project

```bash
php artisan serve
```

---

### 6. Access the Application

Open your browser and visit:

```
http://localhost:8000
```

Enjoy using the application

---

## Notes

- Make sure your database service is running before migration.  

---

## Credits

Migration files were created and their syntax was verified using **ChatGPT** to ensure accuracy and best practices.
