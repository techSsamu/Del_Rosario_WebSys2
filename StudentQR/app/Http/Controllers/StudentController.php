<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class StudentController extends Controller
{
    /**
     * Display a listing of students
     */
    public function index(Request $request)
    {
        $query = Student::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('id_number', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filter by department
        if ($request->filled('department')) {
            $query->where('department', $request->input('department'));
        }

        // Filter by year level
        if ($request->filled('year_level')) {
            $query->where('year_level', $request->input('year_level'));
        }

        $students = $query->orderBy('created_at', 'desc')->paginate(12);
        $departments = Student::distinct()->pluck('department');
        $yearLevels = Student::distinct()->pluck('year_level');

        return view('students.index', compact('students', 'departments', 'yearLevels'));
    }

    /**
     * Show the form for creating a new student
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created student
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_number' => 'required|unique:students,id_number',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'phone' => 'required|string|max:20',
            'department' => 'required|string|max:255',
            'year_level' => 'required|string|max:50',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle picture upload
        if ($request->hasFile('picture')) {
            $picture = $request->file('picture');
            $picturePath = $picture->store('students', 'public');
            $validated['picture'] = $picturePath;
        }

        // Generate QR code
        $student = new Student($validated);
        $qrData = json_encode([
            'id_number' => $validated['id_number'],
            'name' => "{$validated['first_name']} {$validated['last_name']}",
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'department' => $validated['department'],
            'year_level' => $validated['year_level'],
        ]);
        $student->qr_code = $qrData;
        $student->save();

        return redirect()->route('students.show', $student)->with('success', 'Student created successfully!');
    }

    /**
     * Display the specified student
     */
    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified student
     */
    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified student
     */
    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'id_number' => 'required|unique:students,id_number,' . $student->id,
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'phone' => 'required|string|max:20',
            'department' => 'required|string|max:255',
            'year_level' => 'required|string|max:50',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle picture upload
        if ($request->hasFile('picture')) {
            // Delete old picture
            if ($student->picture && Storage::disk('public')->exists($student->picture)) {
                Storage::disk('public')->delete($student->picture);
            }
            $picture = $request->file('picture');
            $picturePath = $picture->store('students', 'public');
            $validated['picture'] = $picturePath;
        }

        // Update QR code
        $qrData = json_encode([
            'id_number' => $validated['id_number'],
            'name' => "{$validated['first_name']} {$validated['last_name']}",
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'department' => $validated['department'],
            'year_level' => $validated['year_level'],
        ]);
        $validated['qr_code'] = $qrData;

        $student->update($validated);

        return redirect()->route('students.show', $student)->with('success', 'Student updated successfully!');
    }

    /**
     * Remove the specified student
     */
    public function destroy(Student $student)
    {
        // Delete picture
        if ($student->picture && Storage::disk('public')->exists($student->picture)) {
            Storage::disk('public')->delete($student->picture);
        }

        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully!');
    }

    /**
     * Search students (for AJAX)
     */
    public function search(Request $request)
    {
        $search = $request->input('q', '');
        
        $students = Student::where(function ($q) use ($search) {
            $q->where('first_name', 'like', "%{$search}%")
              ->orWhere('last_name', 'like', "%{$search}%")
              ->orWhere('id_number', 'like', "%{$search}%");
        })
        ->limit(10)
        ->get(['id', 'id_number', 'first_name', 'last_name', 'picture']);

        return response()->json($students);
    }

    /**
     * Export student QR code as image
     */
    public function exportQR(Student $student)
    {
        // This will be implemented with a QR code library
        return view('students.qr', compact('student'));
    }
}
