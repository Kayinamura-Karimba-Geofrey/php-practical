# Visitor Management System (PHP)

This is a complete visitor management system with user authentication and full CRUD (Create, Read, Update, Delete) functionality for managing visitors.

## Features
- User authentication (Login, Signup, Logout)
- A central, easy-to-configure database connection file (`db.php`)
- Add, display, modify, and delete visitors
- Robust error handling and basic security measures

## Setup Instructions

1. **Database Setup**
   - You can easily set up the database by importing the `database.sql` file into your MySQL server (e.g., using phpMyAdmin's "Import" feature).
   - This will automatically create the `visitor_management` database and the required `users` and `visitors` tables.

2. **Configuration**
   - Place all files from this project into a directory on your web server (e.g., `visitors`).
   - If your database credentials are different from the default (`root` user with no password), update them in the `visitors/db.php` file.

3. **Usage**
   - Navigate to `signup.php` in your browser to create a new user account.
   - Log in using `login.php` with your new credentials.
   - You will be redirected to `display.php`, where you can manage the visitor list.

## Files
- `db.php` — **(NEW)** Central database connection and configuration.
- `database.sql` — **(NEW)** Complete database schema for easy import.
- `login.php` — User login page.
- `signup.php` — User registration page.
- `logout.php` — Handles user logout.
- `display.php` — Displays the list of all visitors.
- `create.php` — Form to add a new visitor.
- `modify.php` — Form to edit an existing visitor's details.
- `delete.php` — Script to delete a visitor.
- `README.md` — Setup instructions.

---

**Note:** This project is for demonstration purposes. For a production environment, always use prepared statements to prevent SQL injection, store credentials securely using environment variables, and implement measures like CSRF protection. 