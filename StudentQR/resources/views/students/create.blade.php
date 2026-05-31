@extends('layouts.app')

@section('title', 'Add New Student - Student QR Code Management System')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h1 class="mb-0">
            <i class="bi bi-person-plus-fill" style="color: var(--secondary-color);"></i>
            Add New Student
        </h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-8 offset-lg-2">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    <i class="bi bi-file-earmark-text"></i>
                    Student Information
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Personal Information Section -->
                    <div class="mb-4">
                        <h6 class="text-primary mb-3">
                            <i class="bi bi-person-vcard"></i>
                            Personal Information
                        </h6>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="id_number" class="form-label">
                                    <i class="bi bi-hash"></i> ID Number *
                                </label>
                                <input type="text" class="form-control @error('id_number') is-invalid @enderror" 
                                       id="id_number" name="id_number" placeholder="e.g., STU-2025-001" 
                                       value="{{ old('id_number') }}" required>
                                @error('id_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">
                                    <i class="bi bi-envelope"></i> Email Address *
                                </label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       id="email" name="email" placeholder="student@example.com" 
                                       value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="first_name" class="form-label">
                                    <i class="bi bi-person"></i> First Name *
                                </label>
                                <input type="text" class="form-control @error('first_name') is-invalid @enderror" 
                                       id="first_name" name="first_name" placeholder="John" 
                                       value="{{ old('first_name') }}" required>
                                @error('first_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="last_name" class="form-label">
                                    <i class="bi bi-person"></i> Last Name *
                                </label>
                                <input type="text" class="form-control @error('last_name') is-invalid @enderror" 
                                       id="last_name" name="last_name" placeholder="Doe" 
                                       value="{{ old('last_name') }}" required>
                                @error('last_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">
                                    <i class="bi bi-telephone"></i> Phone Number *
                                </label>
                                <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                                       id="phone" name="phone" placeholder="+63 9XX XXX XXXX" 
                                       value="{{ old('phone') }}" required>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="department" class="form-label">
                                    <i class="bi bi-building"></i> Department *
                                </label>
                                <select class="form-select @error('department') is-invalid @enderror" 
                                        id="department" name="department" required>
                                    <option value="">Select Department</option>
                                    <option value="Computer Science" {{ old('department') === 'Computer Science' ? 'selected' : '' }}>
                                        Computer Science
                                    </option>
                                    <option value="Information Technology" {{ old('department') === 'Information Technology' ? 'selected' : '' }}>
                                        Information Technology
                                    </option>
                                    <option value="Business Administration" {{ old('department') === 'Business Administration' ? 'selected' : '' }}>
                                        Business Administration
                                    </option>
                                    <option value="Engineering" {{ old('department') === 'Engineering' ? 'selected' : '' }}>
                                        Engineering
                                    </option>
                                    <option value="Arts and Sciences" {{ old('department') === 'Arts and Sciences' ? 'selected' : '' }}>
                                        Arts and Sciences
                                    </option>
                                </select>
                                @error('department')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="year_level" class="form-label">
                                    <i class="bi bi-mortarboard"></i> Year Level *
                                </label>
                                <select class="form-select @error('year_level') is-invalid @enderror" 
                                        id="year_level" name="year_level" required>
                                    <option value="">Select Year Level</option>
                                    <option value="1st Year" {{ old('year_level') === '1st Year' ? 'selected' : '' }}>
                                        1st Year
                                    </option>
                                    <option value="2nd Year" {{ old('year_level') === '2nd Year' ? 'selected' : '' }}>
                                        2nd Year
                                    </option>
                                    <option value="3rd Year" {{ old('year_level') === '3rd Year' ? 'selected' : '' }}>
                                        3rd Year
                                    </option>
                                    <option value="4th Year" {{ old('year_level') === '4th Year' ? 'selected' : '' }}>
                                        4th Year
                                    </option>
                                </select>
                                @error('year_level')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <!-- Picture Section -->
                    <div class="mb-4">
                        <h6 class="text-primary mb-3">
                            <i class="bi bi-image"></i>
                            Student Picture
                        </h6>

                        <div class="mb-3">
                            <label for="picture" class="form-label">
                                <i class="bi bi-upload"></i> Upload Picture (Optional)
                            </label>
                            <div class="input-group">
                                <input type="file" class="form-control @error('picture') is-invalid @enderror" 
                                       id="picture" name="picture" accept="image/*">
                                <small class="form-text text-muted d-block mt-2">
                                    Supported formats: JPG, PNG, GIF (Max 2MB)
                                </small>
                            </div>
                            @error('picture')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Image Preview -->
                        <div id="imagePreview" class="mt-3" style="display: none;">
                            <img id="previewImg" src="" alt="Preview" style="max-width: 200px; border-radius: 8px;">
                        </div>
                    </div>

                    <hr class="my-4">

                    <!-- Form Actions -->
                    <div class="d-flex gap-2 justify-content-between">
                        <a href="{{ route('students.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg"></i> Create Student
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Information Card -->
        <div class="card mt-4" style="border-left: 4px solid var(--secondary-color);">
            <div class="card-body">
                <h6 class="card-title mb-3">
                    <i class="bi bi-info-circle"></i>
                    Information
                </h6>
                <ul class="mb-0">
                    <li>A QR code will be automatically generated once the student is created.</li>
                    <li>The QR code will contain all student information for easy scanning.</li>
                    <li>You can update student information at any time.</li>
                    <li>Student pictures help with identity verification.</li>
                </ul>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
    // Image Preview
    document.getElementById('picture').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const preview = document.getElementById('imagePreview');
        const previewImg = document.getElementById('previewImg');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                previewImg.src = event.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            preview.style.display = 'none';
        }
    });
</script>
@endsection
