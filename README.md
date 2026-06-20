# School Management System

A comprehensive school management system built with Laravel, featuring role-based access control for administrators and teachers.

## 🚀 Features

### 🔐 Authentication
- Secure login with Laravel Sanctum
- Jetstream authentication with email verification
- Session management

### 👥 User Roles

#### Admin (Role: 1)
- **School Management**
  - View and update school information
  - Upload school data
  
- **Staff Management**
  - Add, edit, and delete head teachers
  - View all teachers
  
- **Class Management**
  - Create, update, and delete classes
  - View class list
  
- **Subject Management**
  - Add subjects
  - Delete subjects
  - View subject list

- **Marks Management**
  - Upload marks for students
  - View all marks
  - Delete marks entries

- **Assignment Management**
  - Assign class teachers
  - Assign head teachers
  - Manage academic sessions
  - Manage terms
  - Manage resumption dates
  - Manage school opening dates

#### Teacher (Role: 2)
- **Student Management**
  - Add, edit, and delete students
  - View student list
  
- **Marks Management**
  - Add marks for students
  - View student marks
  - Upload student marks
  - Edit and delete marks
  - View individual student results

### 👤 Profile Management
- Update account information
- Change password
- View profile

## 🛠️ Technology Stack

- **Backend Framework**: Laravel (Latest Version)
- **Authentication**: Laravel Sanctum
- **Frontend**: Jetstream
- **Database**: MySQL/PostgreSQL
- **PHP Version**: ^8.0

## 📋 Prerequisites

- PHP >= 8.0
- Composer
- MySQL/PostgreSQL
- Node.js & NPM (for frontend assets)

## 🔧 Installation

1. **Clone the repository**
```bash
git clone https://github.com/yourusername/school-management-system.git
cd school-management-system
```

2. **Install dependencies**
```bash
composer install
npm install
```

3. **Environment configuration**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Configure database**
Edit `.env` file with your database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

5. **Run migrations**
```bash
php artisan migrate
```

6. **Serve the application**
```bash
php artisan serve
npm run dev
```

## 📁 Project Structure

### Key Controllers
- `Backdoor` - Entry point controller
- `Profile` - User profile management
- `SchoolController` - School information management
- `HeadTeacherController` - Head teacher management
- `ClassController` - Class management
- `SubjectController` - Subject management
- `MarksController` - Marks management
- `StudentController` - Student management
- `StudentMarkController` - Student marks management
- `AssignController` - Assignment management
- `StudentResult` - Student result viewing

### Middleware
- `auth:sanctum` - Authentication middleware
- `verified` - Email verification middleware
- `role:1` - Admin role middleware
- `role:2` - Teacher role middleware

## 🔒 Security Features

- Role-based access control (RBAC)
- Email verification
- Session management
- Sanctum token authentication
- Input validation and sanitization

## 🗺️ API Routes

### Public Routes
- `/` - Landing page

### Authenticated Routes
- `/profile` - User profile
- `/update_account` - Update profile
- `/changePassword` - Change password

### Admin Routes (Role: 1)
- School management endpoints
- Staff management endpoints
- Class management endpoints
- Subject management endpoints
- Marks management endpoints
- Assignment management endpoints

### Teacher Routes (Role: 2)
- Student management endpoints
- Marks management endpoints
- Result viewing endpoints

## 🤝 Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 👨‍💻 Author

https://github.com/joshdei

## 🙏 Acknowledgments

- Laravel Community
- Jetstream Team
- All contributors
