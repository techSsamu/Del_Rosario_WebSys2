@extends('layouts.app')

@section('title', $student->full_name . ' - Student QR Code Management System')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="mb-0">
                <i class="bi bi-person-circle" style="color: var(--secondary-color);"></i>
                Student Profile
            </h1>
            <div class="btn-group" role="group">
                <a href="{{ route('students.edit', $student) }}" class="btn btn-warning">
                    <i class="bi bi-pencil"></i> Edit
                </a>
                <form action="{{ route('students.destroy', $student) }}" method="POST" style="display: inline;"
                      onsubmit="return confirm('Are you sure you want to delete this student?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash"></i> Delete
                    </button>
                </form>
                <a href="{{ route('students.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Left Column - Picture and QR Code -->
    <div class="col-lg-4 mb-4">
        <!-- Student Picture Card -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title">
                    <i class="bi bi-image"></i>
                    Student Picture
                </h5>
            </div>
            <div class="card-body text-center">
                <img src="{{ $student->picture_url }}" alt="{{ $student->full_name }}"
                     class="img-fluid rounded" style="max-width: 100%; border: 3px solid #ecf0f1;">
                <div class="mt-3">
                    <small class="text-muted">
                        <i class="bi bi-calendar3"></i>
                        Updated: {{ $student->updated_at->format('M d, Y H:i') }}
                    </small>
                </div>
            </div>
        </div>

        <!-- QR Code Card -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    <i class="bi bi-qr-code"></i>
                    QR Code
                </h5>
            </div>
            <div class="card-body text-center">
                <div id="qrcode" style="display: flex; justify-content: center; padding: 20px; background-color: #f8f9fa; border-radius: 8px;"></div>

                <div class="alert alert-info mt-3 mb-0">
                    <small>
                        <i class="bi bi-info-circle"></i>
                        This QR code contains all the student's information and is automatically generated.
                    </small>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Column - Student Information -->
    <div class="col-lg-8">
        <!-- Personal Information Card -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title">
                    <i class="bi bi-person-vcard"></i>
                    Personal Information
                </h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <small class="text-muted d-block mb-1">Full Name</small>
                        <h6 class="mb-0">{{ $student->full_name }}</h6>
                    </div>
                    <div class="col-md-6">
                        <small class="text-muted d-block mb-1">ID Number</small>
                        <h6 class="mb-0">
                            <span class="badge badge-primary">{{ $student->id_number }}</span>
                        </h6>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <small class="text-muted d-block mb-1">Email Address</small>
                        <a href="mailto:{{ $student->email }}" class="text-decoration-none">
                            {{ $student->email }}
                        </a>
                    </div>
                    <div class="col-md-6">
                        <small class="text-muted d-block mb-1">Phone Number</small>
                        <a href="tel:{{ $student->phone }}" class="text-decoration-none">
                            {{ $student->phone }}
                        </a>
                    </div>
                </div>

                <hr class="my-3">

                <div class="row mb-3">
                    <div class="col-md-6">
                        <small class="text-muted d-block mb-1">Department</small>
                        <h6 class="mb-0">
                            <span class="badge badge-success">{{ $student->department }}</span>
                        </h6>
                    </div>
                    <div class="col-md-6">
                        <small class="text-muted d-block mb-1">Year Level</small>
                        <h6 class="mb-0">
                            <span class="badge badge-info">{{ $student->year_level }}</span>
                        </h6>
                    </div>
                </div>
            </div>
        </div>

        <!-- QR Code Data Card -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title">
                    <i class="bi bi-database"></i>
                    QR Code Data
                </h5>
            </div>
            <div class="card-body">
                <div class="alert alert-light mb-0">
                    <code class="small" style="word-break: break-all; display: block; max-height: 150px; overflow-y: auto;">
                        @if($student->qr_code)
                            {{ $student->qr_code }}
                        @else
                            <span class="text-muted">No QR code data available</span>
                        @endif
                    </code>
                </div>
            </div>
        </div>

        <!-- System Information Card -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    <i class="bi bi-clock-history"></i>
                    System Information
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <small class="text-muted d-block mb-1">Student ID</small>
                        <code class="text-primary">{{ $student->id }}</code>
                    </div>
                    <div class="col-md-6 mb-3">
                        <small class="text-muted d-block mb-1">Status</small>
                        <span class="badge badge-success">Active</span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <small class="text-muted d-block mb-1">Created Date</small>
                        <small>{{ $student->created_at->format('F d, Y \a\t H:i') }}</small>
                    </div>
                    <div class="col-md-6 mb-3">
                        <small class="text-muted d-block mb-1">Last Updated</small>
                        <small>{{ $student->updated_at->format('F d, Y \a\t H:i') }}</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
<script>
    // Generate QR Code
    document.addEventListener('DOMContentLoaded', function() {
        const qrData = {!! $student->qr_code !!};
        const qrText = typeof qrData === 'object' ? JSON.stringify(qrData) : qrData;

        const qrcodeDiv = document.getElementById('qrcode');
        qrcodeDiv.innerHTML = ''; // Clear previous QR code

        new QRCode(qrcodeDiv, {
            text: qrText,
            width: 200,
            height: 200,
            correctLevel: QRCode.CorrectLevel.H
        });
    });
</script>
@endsection
