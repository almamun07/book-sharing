# 📚 Book Sharing Platform – Laravel API

A simple yet production-ready **Laravel REST API** project with two types of roles: **User** and **Admin**. Users can add books, while Admins manage moderation, reporting, and system configurations.

> **Tech Stack:** Laravel (PHP 8.2/8.3), MySQL, JWT Auth, Laravel Queue, Artisan, PHPUnit

---

## ✨ Key Features

* **Authentication:** JWT-based login/registration, password reset via email, token refresh
* **Book Management:** Add/update/delete books, search & filter
* **Location-based Search:** Search nearby books using latitude/longitude
* **Admin Panel APIs:** User management, book management

---

## 🚀 Installation & Setup

1. Clone the repository:

   ```bash
   git clone https://github.com/almamun07/book-sharing.git
   cd book-sharing
   ```
2. Install dependencies:

   ```bash
   composer install
   ```
3. Copy `.env.example` to `.env` and configure your database & mail settings:

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
4. Generate JWT secret key:

   ```bash
   php artisan jwt:secret
   ```
5. Run migrations & seeders:

   ```bash
   php artisan migrate --seed
   ```
6. Start the development server:

   ```bash
   php artisan serve
   ```

---

## 🛠 API Endpoints (Sample)

### User Authentication

* **POST** `/api/register` → Register new user
* **POST** `/api/login` → Login and get JWT token


### Books

* **POST** `/api/books` → Add new book (User/Admin)
* **GET** `/api/books/nearby` → View Nearby Books


## Admin API
* **GET** `/api/admin/users` → View All Users
* **GET** `/api/admin/books` → View All Books
* **DELETE** `/api/admin/books/{id}` → Delete a Book



---

## 📜 License

This project is licensed under the **MIT License**.
