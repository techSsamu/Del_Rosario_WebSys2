# Student QR Code Management System - Setup Guide

## Installation & Setup Instructions

### 1. Database Migration
Run the following command to create the students table:

```bash
php artisan migrate
```

This will create:
- `students` table with the following fields:
  - id_number (unique)
  - first_name
  - last_name
  - email (unique)
  - phone
  - department
  - year_level
  - picture (nullable - stores file path)
  - qr_code (nullable - stores JSON data)
  - timestamps

### 2. Storage Configuration
Set up public storage for uploading student pictures:

```bash
php artisan storage:link
```

This creates a symbolic link from `storage/app/public` to `public/storage`, allowing you to serve uploaded files.

### 3. Start the Application
Run the development server:

```bash
php artisan serve
```

Then navigate to: `http://localhost:8000`

---

## Features Overview

### ✅ Complete CRUD Operations
- **Create** - Add new students with all required information
- **Read** - View student details and QR codes
- **Update** - Edit student information
- **Delete** - Remove students from the system

### 🔍 Search & Filter
- Search by name, ID number, or email
- Filter by department
- Filter by year level
- Real-time search functionality

### 📸 Student Pictures
- Upload student pictures (JPG, PNG, GIF)
- Automatic placeholder for students without pictures
- Responsive image display across all devices

### 📱 QR Code Features
- Automatically generated for each student
- Contains all student information in JSON format
- Download QR code as PNG image
- Print QR code functionality
- Scannable by any QR code reader

### 🎨 Professional Design
- Modern, responsive Bootstrap 5 interface
- Gradient headers and cards
- Smooth animations and transitions
- Mobile-friendly layout
- Professional color scheme

### 📋 Student Information Fields
1. **ID Number** - Unique identifier
2. **First Name** - Student's first name
3. **Last Name** - Student's last name
4. **Email** - Student's email address
5. **Phone** - Contact number
6. **Department** - Academic department
7. **Year Level** - Current academic year
8. **Picture** - Student photo
9. **QR Code** - Generated data

---

## File Uploads

### Supported Formats
- JPEG (.jpg, .jpeg)
- PNG (.png)
- GIF (.gif)

### Maximum File Size
- 2MB per image

### Storage Location
Pictures are stored in: `storage/app/public/students/`

---

## Database Structure

### Students Table
```sql
CREATE TABLE students (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    id_number VARCHAR(255) UNIQUE NOT NULL,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    phone VARCHAR(20) NOT NULL,
    department VARCHAR(255) NOT NULL,
    year_level VARCHAR(50) NOT NULL,
    picture VARCHAR(255) NULLABLE,
    qr_code TEXT NULLABLE,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

---

## API Routes

### Web Routes
- `GET /students` - List all students
- `GET /students/create` - Show create form
- `POST /students` - Store new student
- `GET /students/{id}` - Show student details
- `GET /students/{id}/edit` - Show edit form
- `PUT /students/{id}` - Update student
- `DELETE /students/{id}` - Delete student
- `GET /students/search` - Search students (AJAX)

---

## Customization

### Department List
Edit the department options in:
- `resources/views/students/create.blade.php`
- `resources/views/students/edit.blade.php`

### Year Levels
Edit the year level options in:
- `resources/views/students/create.blade.php`
- `resources/views/students/edit.blade.php`

### Color Scheme
Modify the color variables in:
- `resources/views/layouts/app.blade.php` (CSS `:root` section)

---

## Troubleshooting

### Images Not Displaying
1. Ensure storage link is created:
   ```bash
   php artisan storage:link
   ```

2. Check file permissions:
   ```bash
   chmod -R 755 storage/
   ```

### QR Code Not Generating
- Ensure the QRCode library is loaded in `show.blade.php`
- Clear browser cache and reload

### Upload Fails
- Check file size (max 2MB)
- Verify file format is supported
- Ensure `storage/app/public` directory exists with write permissions

---

## Best Practices

1. **Regular Backups** - Backup the database and storage folder
2. **Image Optimization** - Compress student pictures before upload
3. **Validation** - All fields are validated before saving
4. **Security** - File uploads are validated for type and size

---

## Support

For issues or questions, refer to the Laravel documentation:
- https://laravel.com/docs
- https://laravel.com/docs/storage
- https://laravel.com/docs/eloquent

---

## System Requirements

- PHP 8.2+
- Laravel 11
- MySQL 5.7+
- GD PHP Extension (for image handling)

---

Generated: April 28, 2026
Version: 1.0.0
