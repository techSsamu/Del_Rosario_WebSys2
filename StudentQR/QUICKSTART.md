# 🚀 Quick Start Guide

## 5-Minute Setup

### Step 1: Run Migrations
```bash
php artisan migrate
```

### Step 2: Create Storage Link
```bash
php artisan storage:link
```

### Step 3: Seed Sample Data (Optional)
```bash
php artisan db:seed
```

### Step 4: Start Server
```bash
php artisan serve
```

### Step 5: Open Browser
```
http://localhost:8000
```

---

## ✅ What You Get

### Page 1: Student Listing
- **URL**: `/students`
- **Features**:
  - View all students in card grid
  - Search by name, ID, or email
  - Filter by department
  - Filter by year level
  - View, Edit, Delete buttons for each student
  - Statistics dashboard

### Page 2: Add Student
- **URL**: `/students/create`
- **Fields**:
  - ID Number
  - First & Last Name
  - Email
  - Phone
  - Department (dropdown)
  - Year Level (dropdown)
  - Picture Upload (optional)
- **Auto-Generated**: QR Code

### Page 3: Edit Student
- **URL**: `/students/{id}/edit`
- Same as Add Student
- Pre-filled with current data
- Update picture option

### Page 4: Student Profile
- **URL**: `/students/{id}`
- **Shows**:
  - Student picture
  - All information
  - QR code (scannable)
  - Download QR as PNG
  - Print QR code
  - System metadata

---

## 📁 File Locations

| What | Where |
|------|-------|
| Database Config | `config/database.php` |
| Student Model | `app/Models/Student.php` |
| Student Controller | `app/Http/Controllers/StudentController.php` |
| Routes | `routes/web.php` |
| Layout Template | `resources/views/layouts/app.blade.php` |
| List Page | `resources/views/students/index.blade.php` |
| Create Form | `resources/views/students/create.blade.php` |
| Edit Form | `resources/views/students/edit.blade.php` |
| Profile Page | `resources/views/students/show.blade.php` |
| Migration | `database/migrations/2025_04_28_000000_create_students_table.php` |
| Seeder | `database/seeders/DatabaseSeeder.php` |

---

## 🎓 Student Data Structure

Each student has 9 fields:

| Field | Type | Example |
|-------|------|---------|
| ID Number | string (unique) | STU-2025-001 |
| First Name | string | Juan |
| Last Name | string | Dela Cruz |
| Email | email (unique) | juan@example.com |
| Phone | string | +63 912 345 6789 |
| Department | string | Computer Science |
| Year Level | string | 3rd Year |
| Picture | file (JPG/PNG/GIF) | juan_photo.jpg |
| QR Code | JSON | {"id":"STU-2025-001",...} |

---

## 💡 Common Tasks

### View All Students
1. Go to `http://localhost:8000/students`
2. Browse through pages
3. See 12 students per page

### Add New Student
1. Click "Add New Student" button
2. Fill in all fields
3. Upload optional picture
4. Click "Create Student"
5. QR code auto-generates

### Search for Student
1. On listing page, enter name/ID/email in search box
2. Click "Filter"
3. Results show immediately

### Edit Student Info
1. Click "Edit" on student card
2. Update any field
3. Click "Update Student"
4. QR code updates automatically

### View Student Details
1. Click "View" on student card
2. See full profile with QR code
3. Download or print QR code
4. Edit or delete from here

### Delete Student
1. Click "Delete" button
2. Confirm deletion
3. Picture and data removed
4. Back to listing

---

## 🎨 UI Features

### Responsive Design
- **Desktop**: 4 columns
- **Tablet**: 2 columns  
- **Mobile**: 1 column

### Professional Styling
- Gradient headers
- Smooth animations
- Modern badges
- Shadow effects
- Clean typography

### Navigation
- Top navbar with logo
- Breadcrumb navigation
- Quick action buttons
- Back/Cancel links

---

## 📊 Statistics Dashboard

On listing page, see:
- **Total Students**: All students in database
- **Departments**: Number of unique departments
- **Year Levels**: Number of unique year levels
- **This Page**: Students shown on current page

---

## 🔧 Database Info

### Table Name
```
students
```

### Sample Insert
```sql
INSERT INTO students (id_number, first_name, last_name, email, phone, department, year_level)
VALUES ('STU-2025-001', 'Juan', 'Dela Cruz', 'juan@example.com', '+63 912 345 6789', 'Computer Science', '3rd Year');
```

---

## 📱 Mobile Compatibility

✅ Fully responsive
✅ Touch-friendly buttons
✅ Optimized images
✅ Mobile-first design
✅ Works on all devices

---

## 🚨 Important Notes

1. **Storage Link**: Must run `php artisan storage:link` for pictures to display
2. **File Permissions**: `storage/` and `bootstrap/cache/` need write permissions
3. **Picture Size**: Max 2MB per image
4. **Picture Formats**: Only JPG, PNG, GIF
5. **QR Code**: Auto-generated, cannot be manually edited
6. **Unique Fields**: ID Number and Email must be unique

---

## ❓ FAQ

**Q: Where are uploaded pictures stored?**
A: `storage/app/public/students/` (accessible via `/storage/students/{filename}`)

**Q: Can I change the QR code data?**
A: No, it auto-generates from student info

**Q: What if I don't upload a picture?**
A: A placeholder image displays instead

**Q: Can multiple students have the same ID?**
A: No, ID number is unique

**Q: Can multiple students have the same email?**
A: No, email is unique

**Q: How do I print the QR code?**
A: Click "Print QR Code" on student profile page

**Q: What happens if I delete a student?**
A: Student data and picture are permanently removed

---

## 🔗 Useful Links

- [Full Documentation](SYSTEM_README.md)
- [Setup Instructions](SETUP.md)
- [Laravel Docs](https://laravel.com/docs)
- [Bootstrap Docs](https://getbootstrap.com/docs)

---

**Version**: 1.0.0  
**Updated**: April 28, 2026
