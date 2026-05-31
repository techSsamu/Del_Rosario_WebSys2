<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Seed sample students
        $students = [
            [
                'id_number' => 'STU-2025-001',
                'first_name' => 'Juan',
                'last_name' => 'Dela Cruz',
                'email' => 'juan.delacruz@example.com',
                'phone' => '+63 912 345 6789',
                'department' => 'Computer Science',
                'year_level' => '3rd Year',
            ],
            [
                'id_number' => 'STU-2025-002',
                'first_name' => 'Maria',
                'last_name' => 'Garcia',
                'email' => 'maria.garcia@example.com',
                'phone' => '+63 912 345 6790',
                'department' => 'Information Technology',
                'year_level' => '2nd Year',
            ],
            [
                'id_number' => 'STU-2025-003',
                'first_name' => 'Miguel',
                'last_name' => 'Santos',
                'email' => 'miguel.santos@example.com',
                'phone' => '+63 912 345 6791',
                'department' => 'Business Administration',
                'year_level' => '1st Year',
            ],
            [
                'id_number' => 'STU-2025-004',
                'first_name' => 'Ana',
                'last_name' => 'Rodriguez',
                'email' => 'ana.rodriguez@example.com',
                'phone' => '+63 912 345 6792',
                'department' => 'Engineering',
                'year_level' => '4th Year',
            ],
            [
                'id_number' => 'STU-2025-005',
                'first_name' => 'Carlo',
                'last_name' => 'Reyes',
                'email' => 'carlo.reyes@example.com',
                'phone' => '+63 912 345 6793',
                'department' => 'Arts and Sciences',
                'year_level' => '2nd Year',
            ],
        ];

        foreach ($students as $student) {
            $newStudent = Student::create($student);
            
            // Generate QR code data
            $qrData = json_encode([
                'id_number' => $student['id_number'],
                'name' => "{$student['first_name']} {$student['last_name']}",
                'email' => $student['email'],
                'phone' => $student['phone'],
                'department' => $student['department'],
                'year_level' => $student['year_level'],
            ]);
            
            $newStudent->update(['qr_code' => $qrData]);
        }
    }
}
