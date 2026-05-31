@extends('layouts.app')

@section('title', 'Students List - Student QR Code Management System')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="mb-0">
                <i class="bi bi-people-fill" style="color: var(--secondary-color);"></i>
                Students Management
            </h1>
            <a href="{{ route('students.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg"></i> Add New Student
            </a>
        </div>
    </div>
</div>

<!-- Search and Filter Section -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form method="GET" action="{{ route('students.index') }}" class="row g-3">
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-search"></i></span>
                            <input type="text" name="search" class="form-control" 
                                   placeholder="Search by name, ID number, or email..." 
                                   value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select name="department" class="form-select">
                            <option value="">All Departments</option>
                            @foreach ($departments as $dept)
                                <option value="{{ $dept }}" {{ request('department') === $dept ? 'selected' : '' }}>
                                    {{ $dept }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="year_level" class="form-select">
                            <option value="">All Year Levels</option>
                            @foreach ($yearLevels as $year)
                                <option value="{{ $year }}" {{ request('year_level') === $year ? 'selected' : '' }}>
                                    {{ $year }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 d-flex gap-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-funnel"></i> Filter
                        </button>
                        <a href="{{ route('students.index') }}" class="btn btn-secondary w-100">
                            <i class="bi bi-arrow-clockwise"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Statistics -->
<div class="row mb-4">
    <div class="col-md-3 col-sm-6">
        <div class="card" style="border-left: 4px solid var(--secondary-color);">
            <div class="card-body text-center">
                <h3 class="text-primary mb-1">{{ $students->total() }}</h3>
                <p class="text-muted mb-0">Total Students</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="card" style="border-left: 4px solid var(--success-color);">
            <div class="card-body text-center">
                <h3 class="text-success mb-1">{{ $departments->count() }}</h3>
                <p class="text-muted mb-0">Departments</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="card" style="border-left: 4px solid var(--accent-color);">
            <div class="card-body text-center">
                <h3 class="text-danger mb-1">{{ $yearLevels->count() }}</h3>
                <p class="text-muted mb-0">Year Levels</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="card" style="border-left: 4px solid #f39c12;">
            <div class="card-body text-center">
                <h3 class="text-warning mb-1">{{ $students->count() }}</h3>
                <p class="text-muted mb-0">On This Page</p>
            </div>
        </div>
    </div>
</div>

<!-- Students Grid -->
@if ($students->count() > 0)
    <div class="row">
        @foreach ($students as $student)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card student-card">
                    <img src="{{ $student->picture_url }}" alt="{{ $student->full_name }}" class="student-image">
                    <div class="student-info">
                        <div class="student-name">{{ $student->full_name }}</div>
                        
                        <div class="student-detail">
                            <strong>ID:</strong> {{ $student->id_number }}
                        </div>
                        <div class="student-detail">
                            <strong>Email:</strong> {{ substr($student->email, 0, 20) }}@...
                        </div>
                        <div class="student-detail">
                            <strong>Phone:</strong> {{ $student->phone }}
                        </div>
                        <div class="student-detail">
                            <strong>Department:</strong> 
                            <span class="badge badge-primary">{{ $student->department }}</span>
                        </div>
                        <div class="student-detail">
                            <strong>Year:</strong> 
                            <span class="badge badge-success">{{ $student->year_level }}</span>
                        </div>

                        <div class="student-actions">
                            <a href="{{ route('students.show', $student) }}" class="btn btn-sm btn-info">
                                <i class="bi bi-eye"></i> View
                            </a>
                            <a href="{{ route('students.edit', $student) }}" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <form action="{{ route('students.destroy', $student) }}" method="POST" style="display: inline;" 
                                  onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger w-100">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="d-flex justify-content-center">
                {{ $students->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@else
    <div class="row">
        <div class="col-12">
            <div class="card text-center py-5">
                <i class="bi bi-inbox" style="font-size: 3rem; color: #bdc3c7;"></i>
                <h3 class="mt-3 text-muted">No Students Found</h3>
                <p class="text-muted">
                    {{ request('search') || request('department') || request('year_level') 
                        ? 'Try adjusting your search filters.' 
                        : 'Start by adding a new student.' }}
                </p>
                <a href="{{ route('students.create') }}" class="btn btn-primary mt-2">
                    <i class="bi bi-plus-lg"></i> Add First Student
                </a>
            </div>
        </div>
    </div>
@endif
@endsection
