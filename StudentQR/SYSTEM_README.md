# 🎓 Student QR Code Management System

A comprehensive, professionally-designed Laravel application for managing student information with QR code generation, picture uploads, and advanced search capabilities.

## 📋 Project Overview

This system provides complete student data management with automatic QR code generation for each student. Every student record includes professional picture upload capability and comprehensive information fields.

### What's Included ✅

**1. Database Structure**
- Students table with 9 key fields
- Unique ID number and email validation
- Timestamps for creation/update tracking
- Support for picture and QR code storage

**2. Complete CRUD Operations**
- ✅ **Create** - Add new students with form validation
- ✅ **Read** - View detailed student profiles with QR codes
- ✅ **Update** - Edit student information
- ✅ **Delete** - Remove student records

**3. Advanced Search & Filter**
- Search by name, ID number, or email
- Filter by department
- Filter by year level
- Real-time pagination with 12 students per page

**4. Student Data Fields (Required)**
1. **ID Number** - Unique student identifier
2. **First Name** - Student's first name
3. **Last Name** - Student's last name
4. **Email** - Contact email (unique)
5. **Phone** - Contact number
6. **Department** - Academic department
7. **Year Level** - Current academic year
8. **Picture** - Student photograph
9. **QR Code** - Auto-generated JSON data

**5. Features**
- 📸 Picture Upload & Display
  - JPG, PNG, GIF formats supported
  - Max 2MB file size
  - Automatic placeholder for missing pictures
  - Responsive image display

- 📱 QR Code Generation
  - Automatic creation for each student
  - Contains all student information
  - Download as PNG image
  - Print functionality
  - Scannable by any QR reader

- 🎨 Professional Design
  - Bootstrap 5 responsive framework
  - Modern gradient headers
  - Smooth animations and transitions
  - Mobile-friendly layout
  - Professional color scheme
  - Card-based UI with hover effects

## 🚀 Quick Start

### Prerequisites
- PHP 8.2+
- Laravel 11
- MySQL 5.7+
- Composer

### Installation Steps

1. **Run Database Migration**
```bash
php artisan migrate
```

2. **Create Storage Link** (for image uploads)
```bash
php artisan storage:link
```

3. **Seed Sample Data** (optional - creates 5 test students)
```bash
php artisan db:seed
```

4. **Start Development Server**
```bash
php artisan serve
```

5. **Access the Application**
```
http://localhost:8000
```

## 📁 Project Structure

```
StudentQR/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       └── StudentController.php    # CRUD & Search logic
│   └── Models/
│       └── Student.php                  # Student model with helpers
├── database/
│   ├── migrations/
│   │   └── 2025_04_28_000000_create_students_table.php
│   └── seeders/
│       └── DatabaseSeeder.php           # Sample data
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php            # Professional template
│       └── students/
│           ├── index.blade.php          # List & Search
│           ├── create.blade.php         # Add form
│           ├── edit.blade.php           # Edit form
│           └── show.blade.php           # Detail & QR code
├── routes/
│   └── web.php                          # Resource routes
├── public/
│   └── images/
│       └── placeholder.png              # Default picture
└── storage/
    └── app/
        └── public/
            └── students/                # Uploaded pictures
```

## 🎯 Features in Detail

### Listing View (Students Index)
- Card-based grid layout (3-4 per row, responsive)
- Each card displays:
  - Student picture
  - Full name
  - ID number
  - Email (truncated)
  - Phone number
  - Department badge
  - Year level badge
  - Action buttons (View, Edit, Delete)
- Search bar with name, ID, email search
- Department filter dropdown
- Year level filter dropdown
- Statistics cards showing:
  - Total students
  - Number of departments
  - Number of year levels
  - Students on current page

### Create Form
- Professional 2-column layout
- Personal Information Section:
  - ID Number (required, unique)
  - First Name (required)
  - Last Name (required)
  - Email (required, unique)
  - Phone (required)
  - Department (dropdown)
  - Year Level (dropdown)
- Picture Upload Section:
  - File input with preview
  - Format validation
  - Size validation (2MB max)
- Validation error display
- Info box explaining QR code generation

### Student Profile (Show View)
- Left Column:
  - Student picture (large display)
  - QR Code with download button
  - Print QR Code option
- Right Column:
  - Personal Information card
  - QR Code data (raw JSON)
  - System Information card
- Action buttons:
  - Back to List
  - Edit Information
  - Copy Profile Link

### Edit Form
- Similar to create form
- Pre-filled with current data
- Current picture display
- Picture replacement option
- Edit validation

## 🗄️ Database Schema

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
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

## 🛣️ Routes

| Method | Route | Action | Description |
|--------|-------|--------|-------------|
| GET | `/students` | index | List all students with search |
| GET | `/students/create` | create | Show create form |
| POST | `/students` | store | Save new student |
| GET | `/students/{id}` | show | Display student profile & QR |
| GET | `/students/{id}/edit` | edit | Show edit form |
| PUT | `/students/{id}` | update | Update student info |
| DELETE | `/students/{id}` | destroy | Delete student |
| GET | `/students/search` | search | AJAX search endpoint |

## 💾 File Upload Configuration

### Storage Location
```
storage/app/public/students/
```

### Supported Formats
- JPEG (.jpg, .jpeg)
- PNG (.png)
- GIF (.gif)

### File Size Limit
- Maximum: 2MB per image

### Accessing Uploaded Files
After running `php artisan storage:link`:
```
/storage/students/{filename}
```

## 🎨 Design Features

### Professional Styling
- **Color Scheme**:
  - Primary: #2c3e50 (Dark Blue)
  - Secondary: #3498db (Bright Blue)
  - Accent: #e74c3c (Red)
  - Success: #27ae60 (Green)

- **Components**:
  - Gradient header navigation
  - Card-based layouts with shadows
  - Smooth hover animations
  - Responsive grid system
  - Professional typography
  - Icon integration (Bootstrap Icons)

### Responsive Design
- Desktop: 4 columns
- Tablet: 2 columns
- Mobile: 1 column
- Adaptive navigation
- Touch-friendly buttons

## 🔐 Security Features

- **Input Validation**:
  - Email unique constraint
  - ID number unique constraint
  - File type validation
  - File size validation
  - CSRF protection (Laravel built-in)

- **File Handling**:
  - Stored outside public root initially
  - Served through public link
  - Permission checks
  - Original filename not exposed

## 📝 Customization

### Add Custom Departments
Edit in create/edit forms:
```php
// resources/views/students/create.blade.php
<option value="Your Department">Your Department</option>
```

### Modify Color Scheme
Edit CSS variables in layout:
```css
/* resources/views/layouts/app.blade.php */
:root {
    --primary-color: #your-color;
    --secondary-color: #your-color;
    /* ... */
}
```

### Change Picture Validation
Edit controller validation:
```php
// app/Http/Controllers/StudentController.php
'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
```

## 🧪 Testing

Run seeder to populate sample data:
```bash
php artisan db:seed
```

This creates 5 test students with:
- Different departments
- Different year levels
- Pre-generated QR codes

## 📚 Technologies Used

- **Backend**: Laravel 11, PHP 8.2
- **Database**: MySQL 5.7+
- **Frontend**: Bootstrap 5, HTML5, CSS3, JavaScript
- **QR Code**: QRCode.js library
- **Icons**: Bootstrap Icons
- **File Storage**: Laravel Storage

## 🐛 Troubleshooting

### Images Not Displaying
1. Create storage link: `php artisan storage:link`
2. Check permissions: `chmod -R 755 storage/`
3. Verify files exist in `storage/app/public/students/`

### QR Code Not Showing
1. Ensure QRCode.js library loads
2. Check browser console for errors
3. Verify qr_code data is stored

### Upload Fails
1. Check file size (max 2MB)
2. Verify file format (JPG, PNG, GIF)
3. Check folder permissions
4. Ensure storage/app/public directory exists

## 📞 Support

For detailed setup instructions, see [SETUP.md](SETUP.md)

For Laravel documentation:
- https://laravel.com/docs
- https://laravel.com/docs/storage
- https://laravel.com/docs/eloquent

## 📄 License

This project is part of an educational assignment for Student QR Code Management.

---

## ✨ Key Achievements

✅ **Complete CRUD System** - Create, Read, Update, Delete operations
✅ **Advanced Search** - Multi-field search with filters
✅ **QR Code Generation** - Automatic for each student
✅ **Picture Upload** - With validation and storage
✅ **Professional Design** - Modern, responsive UI
✅ **5+ Related Fields** - ID, Email, Phone, Department, Year Level
✅ **All Required Features** - Listing, Search, QR Code, Picture, Add, Edit, Delete

---

**Version**: 1.0.0  
**Last Updated**: April 28, 2026  
**Developed**: GitHub Copilot Assistance
