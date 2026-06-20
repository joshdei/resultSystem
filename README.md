# 🏫 School Management System

> A comprehensive, role-based school administration platform built with Laravel

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-00000F?style=for-the-badge&logo=mysql&logoColor=white)
![Tailwind](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)

---

## 📌 Overview

A powerful **School Management System** designed to streamline administrative tasks, manage student records, and automate grade processing. Built with Laravel's robust ecosystem and featuring a clean, intuitive interface.

### ✨ Key Features

| Feature | Description |
|---------|-------------|
| 👥 **Role-Based Access** | Admin and Teacher roles with distinct permissions |
| 📚 **Class Management** | Create, update, and delete classes |
| 📝 **Subject Management** | Manage subjects across all classes |
| 👨‍🏫 **Staff Management** | Add and manage head teachers and teachers |
| 🎓 **Student Management** | Complete student lifecycle management |
| 📊 **Grade Management** | Upload, edit, and view student marks |
| 📈 **Result Processing** | Generate and view student results |
| 📅 **Session Management** | Manage academic sessions and terms |

---

## 🏗️ System Architecture

```
┌─────────────────────────────────────────────────────────────┐
│                         PUBLIC ROUTES                       │
│                          (/) Landing                       │
└─────────────────────────────────────────────────────────────┘
                              │
                              ▼
┌─────────────────────────────────────────────────────────────┐
│                    AUTHENTICATION LAYER                     │
│               (Sanctum + Email Verification)                │
└─────────────────────────────────────────────────────────────┘
                              │
                    ┌─────────┴─────────┐
                    ▼                   ▼
    ┌───────────────────────┐ ┌───────────────────────┐
    │     ADMIN (Role 1)     │ │    TEACHER (Role 2)    │
    │    Full Control        │ │    Limited Access      │
    ├───────────────────────┤ ├───────────────────────┤
    │ • School Settings     │ │ • Student Management  │
    │ • Staff Management    │ │ • Marks Upload        │
    │ • Class/Subject Mgmt  │ │ • Results View        │
    │ • Assignment Mgmt     │ │ • Profile Management  │
    │ • Session Management  │ │                        │
    └───────────────────────┘ └───────────────────────┘
```

---

## 🚀 Quick Start

### Prerequisites

```bash
PHP >= 8.0
Composer
MySQL/PostgreSQL
Node.js & NPM
```

### Installation

```bash
# Clone the repository
git clone https://github.com/yourusername/school-management-system.git
cd school-management-system

# Install dependencies
composer install
npm install

# Environment setup
cp .env.example .env
php artisan key:generate

# Configure your database in .env
# Run migrations
php artisan migrate

# Start the application
php artisan serve
npm run dev
```

---

## 📂 Project Structure

```
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Backdoor.php          # Entry point
│   │   │   ├── Profile.php           # Profile management
│   │   │   ├── SchoolController.php  # School settings
│   │   │   ├── HeadTeacherController.php
│   │   │   ├── ClassController.php
│   │   │   ├── SubjectController.php
│   │   │   ├── MarksController.php
│   │   │   ├── StudentController.php
│   │   │   ├── StudentMarkController.php
│   │   │   ├── AssignController.php  # Assignments management
│   │   │   └── StudentResult.php
│   │   └── Middleware/
│   │       └── role.php              # Role-based middleware
├── routes/
│   └── web.php                       # All routes definition
├── resources/
│   └── views/                        # Blade templates
└── database/
    └── migrations/                   # Database schemas
```

---

## 🔐 Role-Based Access

### 👑 Administrator (Role: 1)

| Module | Actions |
|--------|---------|
| 🏫 **School** | View/Update school information |
| 👨‍🏫 **Staff** | CRUD operations for head teachers |
| 📚 **Classes** | Create, edit, delete classes |
| 📝 **Subjects** | Add and delete subjects |
| 📊 **Marks** | View and manage all marks |
| 🔗 **Assignments** | Assign teachers, head teachers, sessions, terms |
| 📅 **Session** | Manage academic sessions and opening dates |

### 👨‍🏫 Teacher (Role: 2)

| Module | Actions |
|--------|---------|
| 🎓 **Students** | Add, edit, delete students |
| 📊 **Marks** | Upload, edit, delete student marks |
| 📈 **Results** | View individual student results |
| 👤 **Profile** | Update account and change password |

---

## 🗺️ Route Map

### Public Routes
```php
GET  /                           # Landing page
```

### Authenticated Routes
```php
GET    /profile                  # User profile
POST   /update_account           # Update profile
POST   /changePassword           # Change password
```

### Admin Routes (Role: 1)
```php
# School Management
GET    /schoolinformation        # View school info
POST   /uploadSchoolData         # Update school data
GET    /view_school_information  # View school details

# Staff Management
GET    /viewheadTeacher          # List head teachers
POST   /addHeadTeacher           # Add head teacher
GET    /editTeacher/{id}         # Edit teacher
POST   /update_teacher_account   # Update teacher
GET    /deleteTeacher/{id}       # Delete teacher

# Class Management
GET    /viewClass                # List classes
POST   /add_class                # Add class
PUT    /class/{id}/update        # Update class
GET    /class/edit/{id}          # Edit class
GET    /class/delete/{id}        # Delete class

# Subject Management
GET    /viewsubject              # List subjects
GET    /addSubject               # Add subject form
POST   /uploadSubject            # Add subject
GET    /deleteSubject/{id}       # Delete subject

# Assignment Management
GET    /assign_teacher           # Assign class teacher
GET    /assign_head_teacher      # Assign head teacher
POST   /addclassTeacher          # Add class teacher
POST   /addclassHeadTeacher      # Add head teacher
GET    /assign_term              # Manage terms
POST   /Uploadterm               # Upload term
GET    /assign_session           # Manage sessions
POST   /uploadsession            # Upload session
GET    /assign_resumption_date   # Manage resumption
POST   /uploadresumption         # Upload resumption
```

### Teacher Routes (Role: 2)
```php
# Student Management
GET    /viewStudent              # List students
GET    /addStudent               # Add student form
POST   /uploadStudent            # Add student
GET    /editStudent/{id}         # Edit student
PUT    /updateStudent/{id}       # Update student
DELETE /deleteStudent/{id}       # Delete student

# Marks Management
GET    /addMarks                 # Add marks form
POST   /uploadStudentMarks       # Upload marks
GET    /viewStudentMarks         # View marks
GET    /edit-student-mark/{id}   # Edit marks
POST   /update-student-mark/{id} # Update marks
DELETE /delete-student-mark/{id} # Delete marks
GET    /singleStudentResult/{id} # View student result
```

---

## 🎯 API Endpoints Summary

| Method | Endpoint | Description | Role |
|--------|----------|-------------|------|
| GET | `/` | Landing page | Public |
| GET | `/profile` | Profile page | All |
| POST | `/update_account` | Update profile | All |
| POST | `/changePassword` | Change password | All |
| GET | `/viewClass` | List classes | Admin |
| POST | `/add_class` | Create class | Admin |
| GET | `/viewStudent` | List students | Teacher |
| POST | `/uploadStudent` | Add student | Teacher |
| POST | `/uploadStudentMarks` | Upload marks | Teacher |
| GET | `/singleStudentResult/{id}` | View result | Teacher |

---

## 🛡️ Security & Middleware

```php
// Route Protection
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    // Protected routes
});

// Role-Based Protection
Route::middleware('role:1')->group(function () {
    // Admin-only routes
});

Route::middleware('role:2')->group(function () {
    // Teacher-only routes
});
```

---

## 💻 Tech Stack

### Backend
- **Framework:** Laravel
- **Authentication:** Sanctum
- **Database:** MySQL/PostgreSQL
- **Cache:** Redis (optional)

### Frontend
- **UI Framework:** Jetstream
- **CSS:** Tailwind CSS
- **JavaScript:** Alpine.js

### DevOps
- **Version Control:** Git
- **Dependencies:** Composer, NPM

---

## 📊 Database Schema (Key Tables)

```sql
users           # User accounts with role
schools         # School information
head_teachers   # Head teacher records
classes         # Class information
subjects        # Subject details
students        # Student records
marks           # Student marks
sessions        # Academic sessions
terms           # Term management
assignments     # Teacher/Class assignments
```

---

## 🔧 Development Setup

```bash
# Install development dependencies
composer require --dev laravel/sail

# Run tests
php artisan test

# Generate documentation
php artisan ide-helper:generate

# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

---

## 🤝 Contributing

1. **Fork** the repository
2. **Create** your feature branch (`git checkout -b feature/AmazingFeature`)
3. **Commit** your changes (`git commit -m 'Add AmazingFeature'`)
4. **Push** to the branch (`git push origin feature/AmazingFeature`)
5. **Open** a Pull Request

### Contribution Guidelines

- Follow PSR-12 coding standards
- Write tests for new features
- Update documentation
- Keep commits atomic and descriptive

---

## 📋 Roadmap

- [ ] Parent portal integration
- [ ] Fee management module
- [ ] Attendance tracking
- [ ] Examination timetable
- [ ] Report card generation
- [ ] SMS/Email notifications
- [ ] Mobile app development
- [ ] Multi-school support

---

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

---

## 👥 Team

| Role | Name | Contact |
|------|------|---------|
| Lead Developer | Joshua Deinne] | [joshuadeinne@gmail.com]

---

## 🙏 Acknowledgments

- Laravel Community
- Jetstream Team
- Open-source contributors

---

## 📞 Support

For support, email joshuadeinne@gmail.com or create an issue in the repository.

---

<div align="center">
  Made  ❤️ by Joshua Deinne
  <br>
  <sub>⭐ Star this repo if you find it useful! ⭐</sub>
</div>
