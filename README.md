# PHP Labs Project

This repository contains a comprehensive collection of PHP lab exercises and a complete job portal application, demonstrating various PHP concepts from basic form handling to advanced authentication systems.

## 📋 Table of Contents

- [Prerequisites](#prerequisites)
- [Environment Setup](#environment-setup)
- [Lab Exercises](#lab-exercises)
  - [LAB 2: Basic PHP Form Handling](#lab-2-basic-php-form-handling)
  - [LAB 3: CRUD Operations](#lab-3-crud-operations)
  - [LAB 4: Object-Oriented PHP](#lab-4-object-oriented-php)
  - [LAB 5: Authentication & Google OAuth](#lab-5-authentication--google-oauth)
  - [LAB 6: Sessions & Cookies](#lab-6-sessions--cookies)
- [Job Portal Application](#job-portal-application)
- [Database Setup](#database-setup)
- [Troubleshooting](#troubleshooting)

## 🔧 Prerequisites

- **XAMPP** (or similar local server environment)
  - PHP 8.0 or higher
  - MySQL 5.7 or higher
  - Apache Web Server
- **Composer** (for LAB 5 dependencies)
- **Web Browser** (Chrome, Firefox, Safari, etc.)

## 🚀 Environment Setup

### 1. XAMPP Installation
1. Download and install [XAMPP](https://www.apachefriends.org/)
2. Start Apache and MySQL services from XAMPP Control Panel
3. Clone this repository to `C:\xampp\htdocs\phplabs` (Windows) or `/opt/lampp/htdocs/phplabs` (Linux)

### 2. Database Configuration
Access phpMyAdmin at `http://localhost/phpmyadmin` and create the required databases (see individual lab setup instructions).

## 📚 Lab Exercises

### LAB 2: Basic PHP Form Handling

**Concepts Covered:**
- HTML Forms with PHP processing
- MySQL database connectivity
- Input validation and sanitization
- Basic CRUD operations

**Setup:**
1. Create database: `WebAppDB`
2. Create table:
```sql
CREATE TABLE Users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    age INT NOT NULL
);
```

**Files:**
- `user_form.php` - Registration form
- `process_form.php` - Form processing and validation
- `view_users.php` - Display registered users

**Access:** `http://localhost/phplabs/LAB_2/user_form.php`

### LAB 3: CRUD Operations

**Concepts Covered:**
- Complete CRUD (Create, Read, Update, Delete) operations
- Prepared statements for security
- Multiple application management

**Setup:**
Create two databases and tables:

#### Student App Database:
```sql
CREATE DATABASE StudentDB;
USE StudentDB;
CREATE TABLE Students (
    student_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone_number VARCHAR(15) NOT NULL
);
```

#### Employee App Database:
```sql
CREATE DATABASE EmployeeDB;
USE EmployeeDB;
CREATE TABLE Department (
    dept_id INT AUTO_INCREMENT PRIMARY KEY,
    dept_name VARCHAR(100) NOT NULL
);

CREATE TABLE Employee (
    emp_id INT AUTO_INCREMENT PRIMARY KEY,
    emp_name VARCHAR(100) NOT NULL,
    dept_id INT,
    salary DECIMAL(10,2),
    FOREIGN KEY (dept_id) REFERENCES Department(dept_id)
);

-- Insert sample departments
INSERT INTO Department (dept_name) VALUES 
('IT'), ('HR'), ('Finance'), ('Marketing');
```

**Applications:**
- **Student App:** `http://localhost/phplabs/LAB_3/student_app/add_student.php`
- **Employee App:** `http://localhost/phplabs/LAB_3/employee_app/add_employee.php`

### LAB 4: Object-Oriented PHP

**Concepts Covered:**
- Classes and Objects
- Inheritance
- Interfaces
- Polymorphism
- Abstract classes

**Setup:**
No database required - pure OOP demonstration

**Key Classes:**
- `Product.php` - Base product class
- `Book.php` - Extends Product, implements Discountable and Loanable
- `Ebook.php` - Extends Book with additional features
- `Member.php` - Library member management

**Access:** `http://localhost/phplabs/LAB_4/library_dashboard.php`

**Test Files:**
- `test_inheritance.php` - Inheritance examples
- `test_polymorphism.php` - Polymorphism demonstrations
- `library_test.php` - Complete library system test

### LAB 5: Authentication & Google OAuth

**Concepts Covered:**
- User authentication system
- Google OAuth 2.0 integration
- Session management
- Composer dependency management
- Environment variables for security

**Setup:**

1. **Install Dependencies:**
```bash
cd LAB_5
composer install
```

2. **Environment Configuration:**
   - Copy `.env.example` to `.env` (if provided) or create `.env` file
   - Update Google OAuth credentials in `.env`:
```env
GOOGLE_CLIENT_ID=your_google_client_id
GOOGLE_CLIENT_SECRET=your_google_client_secret
GOOGLE_REDIRECT_URI=http://localhost/phplabs/LAB_5/google_login.php
```

3. **Database Setup:**
```sql
CREATE DATABASE lab5;
USE lab5;
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255),
    google_id VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

4. **Google OAuth Setup:**
   - Go to [Google Cloud Console](https://console.cloud.google.com/)
   - Create a new project or select existing
   - Enable Google+ API
   - Create OAuth 2.0 credentials
   - Add authorized redirect URI: `http://localhost/phplabs/LAB_5/google_login.php`

**Files:**
- `login.php` - User login form
- `register.php` - User registration
- `google_login.php` - Google OAuth handler
- `dashboard.php` - Protected user dashboard
- `config.php` - Database and OAuth configuration
- `env_loader.php` - Environment variable loader

**Access:** `http://localhost/phplabs/LAB_5/login.php`

### LAB 6: Sessions & Cookies

**Concepts Covered:**
- PHP Sessions
- Cookie management
- File upload handling
- State persistence

**Setup:**
No database required

**Features:**
- File upload with validation
- Session-based file tracking
- Cookie preferences
- State clearing functionality

**Files:**
- `upload.php` - File upload form and processing
- `view_upload.php` - Display uploaded files
- `cookie_test.php` - Cookie demonstration
- `clear_state.php` - Reset sessions and cookies

**Access:** `http://localhost/phplabs/LAB_6/upload.php`

## 🏢 Job Portal Application

**Concepts Covered:**
- Multi-role user system (Admin, Employer, Job Seeker)
- Complete job management system
- Application tracking
- Google OAuth integration
- Advanced database relationships

**Setup:**

1. **Environment Configuration:**
   - Copy `.env.example` to `.env`
   - Update Google OAuth credentials in `.env`:
```env
GOOGLE_CLIENT_ID=your_google_client_id_here
GOOGLE_CLIENT_SECRET=your_google_client_secret_here
GOOGLE_REDIRECT_URI=http://localhost/job_portal/callback.php
```

2. **Database Creation:**
```sql
CREATE DATABASE job_portal;
USE job_portal;
```

3. **Run Database Schema:**
Execute the SQL schema files (if provided) or create tables manually:
- Users table (with roles)
- Jobs table
- Applications table
- Admin functionality tables

4. **Google OAuth Setup:**
   - Go to [Google Cloud Console](https://console.cloud.google.com/)
   - Create a new project or select existing
   - Enable Google+ API and Google OAuth2 API
   - Create OAuth 2.0 credentials
   - Add authorized redirect URI: `http://localhost/job_portal/callback.php`

**User Roles:**
- **Admin:** User management, system oversight
- **Employer:** Post jobs, manage applications
- **Job Seeker:** Browse jobs, submit applications

**Key Features:**
- User registration and authentication
- Job posting and management
- Application submission and tracking
- Admin panel for user management
- Google OAuth integration
- Responsive design

**Access:** `http://localhost/phplabs/job_portal/`

## 🗄️ Database Setup

### Quick Setup Script
Create a file `setup_databases.sql` and run it in phpMyAdmin:

```sql
-- LAB 2 Database
CREATE DATABASE WebAppDB;
USE WebAppDB;
CREATE TABLE Users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    age INT NOT NULL
);

-- LAB 3 Databases
CREATE DATABASE StudentDB;
USE StudentDB;
CREATE TABLE Students (
    student_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone_number VARCHAR(15) NOT NULL
);

CREATE DATABASE EmployeeDB;
USE EmployeeDB;
CREATE TABLE Department (
    dept_id INT AUTO_INCREMENT PRIMARY KEY,
    dept_name VARCHAR(100) NOT NULL
);
CREATE TABLE Employee (
    emp_id INT AUTO_INCREMENT PRIMARY KEY,
    emp_name VARCHAR(100) NOT NULL,
    dept_id INT,
    salary DECIMAL(10,2),
    FOREIGN KEY (dept_id) REFERENCES Department(dept_id)
);
INSERT INTO Department (dept_name) VALUES ('IT'), ('HR'), ('Finance'), ('Marketing');

-- LAB 5 Database
CREATE DATABASE lab5;
USE lab5;
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255),
    google_id VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Job Portal Database
CREATE DATABASE job_portal;
-- (Additional tables as needed)
```

## 🔧 Troubleshooting

### Common Issues and Solutions

#### 1. **Database Connection Errors**
```
Error: Connection failed: Access denied for user 'root'@'localhost'
```
**Solution:**
- Ensure MySQL is running in XAMPP
- Check database credentials in config files
- Verify database exists

#### 2. **Google OAuth Issues (LAB 5)**
```
Error: invalid_client
```
**Solution:**
- Verify Google Client ID and Secret in `.env` file
- Check redirect URI matches exactly in Google Console
- Ensure Google+ API is enabled

#### 3. **Composer Dependencies (LAB 5)**
```
Fatal error: Class 'Google_Client' not found
```
**Solution:**
```bash
cd LAB_5
composer install
```

#### 4. **File Upload Issues (LAB 6)**
```
Warning: move_uploaded_file(): failed to open stream
```
**Solution:**
- Check `uploads/` directory exists and is writable
- Verify PHP upload settings in `php.ini`

#### 5. **Session Issues**
```
Warning: session_start(): Cannot send session cookie
```
**Solution:**
- Ensure no output before `session_start()`
- Check PHP session configuration

### Environment Variables Setup

For **LAB 5**, create a `.env` file with your actual credentials:

```env
# Google OAuth Configuration
GOOGLE_CLIENT_ID=your_actual_client_id_here
GOOGLE_CLIENT_SECRET=your_actual_client_secret_here
GOOGLE_REDIRECT_URI=http://localhost/phplabs/LAB_5/google_login.php

# Database Configuration
DB_HOST=localhost
DB_NAME=lab5
DB_USER=root
DB_PASS=
```

For **Job Portal**, create a `.env` file with your actual credentials:

```env
# Google OAuth Configuration
GOOGLE_CLIENT_ID=your_actual_client_id_here
GOOGLE_CLIENT_SECRET=your_actual_client_secret_here
GOOGLE_REDIRECT_URI=http://localhost/job_portal/callback.php

# Database Configuration
DB_HOST=localhost
DB_NAME=job_portal
DB_USER=root
DB_PASS=

# Application Configuration
APP_URL=http://localhost/job_portal
APP_NAME=Job Portal
```

### File Permissions

Ensure proper permissions for upload directories:
```bash
# Linux/Mac
chmod 755 LAB_6/uploads/
chmod 755 job_portal/uploads/ (if exists)

# Windows - Right-click folder → Properties → Security → Edit permissions
```

## 📝 Learning Objectives

### LAB 2: Foundation
- Understanding PHP-MySQL integration
- Form handling and validation
- Basic security practices

### LAB 3: CRUD Mastery
- Complete database operations
- Prepared statements
- Application architecture

### LAB 4: OOP Concepts
- Object-oriented programming principles
- Code reusability and maintainability
- Design patterns

### LAB 5: Authentication
- Secure user authentication
- Third-party API integration
- Environment configuration

### LAB 6: State Management
- Session and cookie handling
- File upload security
- User experience enhancement

### Job Portal: Real-world Application
- Multi-user system design
- Role-based access control
- Complete application lifecycle

## 🚀 Getting Started

1. **Clone the repository:**
```bash
git clone <repository-url>
cd phplabs
```

2. **Start XAMPP services:**
   - Apache
   - MySQL

3. **Setup databases:**
   - Import `setup_databases.sql` in phpMyAdmin
   - Or create databases manually following lab instructions

4. **Install dependencies (LAB 5 only):**
```bash
cd LAB_5
composer install
```

5. **Configure environment:**
   - **LAB 5:** Update `.env` file with your Google OAuth credentials
   - **Job Portal:** Update `.env` file with your Google OAuth credentials

6. **Access labs:**
   - LAB 2: `http://localhost/phplabs/LAB_2/user_form.php`
   - LAB 3: `http://localhost/phplabs/LAB_3/student_app/add_student.php`
   - LAB 4: `http://localhost/phplabs/LAB_4/library_dashboard.php`
   - LAB 5: `http://localhost/phplabs/LAB_5/login.php`
   - LAB 6: `http://localhost/phplabs/LAB_6/upload.php`
   - Job Portal: `http://localhost/phplabs/job_portal/`

## 📞 Support

If you encounter any issues:
1. Check the troubleshooting section above
2. Verify all prerequisites are installed
3. Ensure databases are properly configured
4. Check file permissions for upload directories

## 📄 License

This project is for educational purposes. Feel free to use and modify for learning.

---

**Happy Coding! 🎉**
