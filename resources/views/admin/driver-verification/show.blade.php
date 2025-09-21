@extends('layouts.admin')

@section('title', 'Driver Verification Details')

@section('content')
<div class="fade-in">
    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                showToast('{{ session('success') }}', 'success');
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                showToast('{{ session('error') }}', 'error');
            });
        </script>
    @endif

    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Driver Verification Details</h1>
            <p class="text-gray-600 mt-2">Review driver information, documents, and vehicle details</p>
        </div>
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.driver-verification.index') }}" 
               class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>Back to List
            </a>
        </div>
    </div>

    <!-- Driver Information Card -->
    <div class="stat-card rounded-2xl p-6 card-hover slide-in-left mb-8" 
         style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%); backdrop-filter: blur(15px); border: 1px solid rgba(1, 28, 114, 0.15); box-shadow: 0 8px 32px rgba(1, 28, 114, 0.1);">
        
        <div class="flex items-start justify-between mb-6">
            <div class="flex items-center space-x-4">
                <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                    <span class="text-white font-bold text-xl">{{ substr($driver->name, 0, 1) }}</span>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">{{ $driver->name }}</h2>
                    <p class="text-gray-600">{{ $driver->email }}</p>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium mt-2
                        @if($driver->status === 'active') bg-green-100 text-green-800
                        @elseif($driver->status === 'inactive') bg-red-100 text-red-800
                        @else bg-yellow-100 text-yellow-800 @endif">
                        {{ ucfirst($driver->status) }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Driver Details Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="space-y-4">
                <h3 class="text-lg font-semibold text-gray-900 border-b pb-2">Personal Information</h3>
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Phone:</span>
                        <span class="font-medium">{{ $driver->phone ?? 'N/A' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">CNIC:</span>
                        <span class="font-medium">{{ $driver->cnic ?? 'N/A' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Address:</span>
                        <span class="font-medium text-right">{{ $driver->address ?? 'N/A' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Emergency Contact:</span>
                        <span class="font-medium">{{ $driver->emergency_contact ?? 'N/A' }}</span>
                    </div>
                </div>
            </div>

            <div class="space-y-4">
                <h3 class="text-lg font-semibold text-gray-900 border-b pb-2">Account Information</h3>
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Email Verified:</span>
                        <span class="font-medium">
                            @if($driver->email_verified_at)
                                <span class="text-green-600"><i class="fas fa-check-circle"></i> Yes</span>
                            @else
                                <span class="text-red-600"><i class="fas fa-times-circle"></i> No</span>
                            @endif
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Joined:</span>
                        <span class="font-medium">{{ $driver->created_at->format('M d, Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Last Updated:</span>
                        <span class="font-medium">{{ $driver->updated_at->format('M d, Y') }}</span>
                    </div>
                </div>
            </div>

            <div class="space-y-4">
                <h3 class="text-lg font-semibold text-gray-900 border-b pb-2">Verification Actions</h3>
                <div class="space-y-3">
                    @if($driver->status === 'pending')
                        <div class="space-y-3">
                            <form method="POST" action="{{ route('admin.driver-verification.approve', $driver) }}" class="w-full" id="approve-form">
                                @csrf
                                <input type="hidden" name="verification_type" value="driver">
                                <input type="hidden" name="item_id" value="{{ $driver->id }}">
                                <button type="submit" 
                                        class="w-full px-6 py-3 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-xl hover:from-green-600 hover:to-green-700 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl font-semibold flex items-center justify-center space-x-2"
                                        id="approve-btn">
                                    <i class="fas fa-check-circle text-lg"></i>
                                    <span>Approve Driver</span>
                                </button>
                            </form>
                            
                            <form method="POST" action="{{ route('admin.driver-verification.reject', $driver) }}" class="w-full" id="reject-form">
                                @csrf
                                <input type="hidden" name="verification_type" value="driver">
                                <input type="hidden" name="item_id" value="{{ $driver->id }}">
                                <input type="hidden" name="rejection_reason" value="Driver verification rejected by admin">
                                <button type="button" 
                                        class="w-full px-6 py-3 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-xl hover:from-red-600 hover:to-red-700 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl font-semibold flex items-center justify-center space-x-2"
                                        id="reject-btn">
                                    <i class="fas fa-times-circle text-lg"></i>
                                    <span>Reject Driver</span>
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="text-center text-gray-500 p-6">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-check-circle text-2xl text-gray-400"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-700 mb-2">Verification Processed</h3>
                            <p class="text-sm text-gray-500">This driver has already been {{ $driver->status === 'active' ? 'approved' : 'rejected' }}.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Vehicles Section -->
    @if($driver->vehicles->count() > 0)
        <div class="stat-card rounded-2xl p-6 card-hover slide-in-right mb-8" 
             style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%); backdrop-filter: blur(15px); border: 1px solid rgba(1, 28, 114, 0.15); box-shadow: 0 8px 32px rgba(1, 28, 114, 0.1);">
            
            <h3 class="text-xl font-bold text-gray-900 mb-6">
                <i class="fas fa-car mr-2"></i>Vehicle Information
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($driver->vehicles as $vehicle)
                    <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between mb-4">
                            <h4 class="text-lg font-semibold text-gray-900">{{ $vehicle->make }} {{ $vehicle->model }}</h4>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                @if($vehicle->verification_status === 'approved') bg-green-100 text-green-800
                                @elseif($vehicle->verification_status === 'rejected') bg-red-100 text-red-800
                                @else bg-yellow-100 text-yellow-800 @endif">
                                {{ ucfirst($vehicle->verification_status) }}
                            </span>
                        </div>

                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-gray-600">License Plate:</span>
                                <span class="font-medium">{{ $vehicle->license_plate }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Year:</span>
                                <span class="font-medium">{{ $vehicle->year ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Color:</span>
                                <span class="font-medium">{{ $vehicle->color ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Type:</span>
                                <span class="font-medium">{{ ucfirst($vehicle->type ?? 'N/A') }}</span>
                            </div>
                        </div>

                        @if($vehicle->verification_status === 'pending')
                            <div class="mt-4 space-y-2">
                                <form method="POST" action="{{ route('admin.driver-verification.approve', $driver) }}" class="inline">
                                    @csrf
                                    <input type="hidden" name="verification_type" value="vehicle">
                                    <input type="hidden" name="item_id" value="{{ $vehicle->id }}">
                                    <button type="submit" 
                                            class="w-full px-3 py-1 bg-green-500 text-white rounded text-sm hover:bg-green-600 transition-colors">
                                        <i class="fas fa-check mr-1"></i>Approve Vehicle
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('admin.driver-verification.reject', $driver) }}" class="inline">
                                    @csrf
                                    <input type="hidden" name="verification_type" value="vehicle">
                                    <input type="hidden" name="item_id" value="{{ $vehicle->id }}">
                                    <button type="submit" 
                                            class="w-full px-3 py-1 bg-red-500 text-white rounded text-sm hover:bg-red-600 transition-colors"
                                            onclick="return confirm('Are you sure you want to reject this vehicle?')">
                                        <i class="fas fa-times mr-1"></i>Reject Vehicle
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Documents Section -->
    @if($driver->documents->count() > 0)
        <div class="stat-card rounded-2xl p-6 card-hover slide-in-left mb-8" 
             style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%); backdrop-filter: blur(15px); border: 1px solid rgba(1, 28, 114, 0.15); box-shadow: 0 8px 32px rgba(1, 28, 114, 0.1);">
            
            <h3 class="text-xl font-bold text-gray-900 mb-6">
                <i class="fas fa-file-alt mr-2"></i>Driver Documents
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($driver->documents as $document)
                    <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between mb-3">
                            <h4 class="font-semibold text-gray-900">{{ ucfirst(str_replace('_', ' ', $document->document_type)) }}</h4>
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                @if($document->verification_status === 'approved') bg-green-100 text-green-800
                                @elseif($document->verification_status === 'rejected') bg-red-100 text-red-800
                                @else bg-yellow-100 text-yellow-800 @endif">
                                {{ ucfirst($document->verification_status) }}
                            </span>
                        </div>

                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Document Number:</span>
                                <span class="font-medium">{{ $document->document_number ?? 'N/A' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Expiry Date:</span>
                                <span class="font-medium">{{ $document->expiry_date ? \Carbon\Carbon::parse($document->expiry_date)->format('M d, Y') : 'N/A' }}</span>
                            </div>
                            @if($document->file_path)
                                <div class="mt-3">
                                    <a href="{{ Storage::url($document->file_path) }}" 
                                       target="_blank" 
                                       class="text-blue-600 hover:text-blue-800 text-sm">
                                        <i class="fas fa-download mr-1"></i>View Document
                                    </a>
                                </div>
                            @endif
                        </div>

                        @if($document->verification_status === 'pending')
                            <div class="mt-4 space-y-2">
                                <form method="POST" action="{{ route('admin.driver-verification.approve', $driver) }}" class="inline">
                                    @csrf
                                    <input type="hidden" name="verification_type" value="document">
                                    <input type="hidden" name="item_id" value="{{ $document->id }}">
                                    <button type="submit" 
                                            class="w-full px-3 py-1 bg-green-500 text-white rounded text-sm hover:bg-green-600 transition-colors">
                                        <i class="fas fa-check mr-1"></i>Approve
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('admin.driver-verification.reject', $driver) }}" class="inline">
                                    @csrf
                                    <input type="hidden" name="verification_type" value="document">
                                    <input type="hidden" name="item_id" value="{{ $document->id }}">
                                    <button type="submit" 
                                            class="w-full px-3 py-1 bg-red-500 text-white rounded text-sm hover:bg-red-600 transition-colors"
                                            onclick="return confirm('Are you sure you want to reject this document?')">
                                        <i class="fas fa-times mr-1"></i>Reject
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- No Data Messages -->
    @if($driver->vehicles->count() === 0 && $driver->documents->count() === 0)
        <div class="stat-card rounded-2xl p-8 card-hover text-center" 
             style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%); backdrop-filter: blur(15px); border: 1px solid rgba(1, 28, 114, 0.15); box-shadow: 0 8px 32px rgba(1, 28, 114, 0.1);">
            <i class="fas fa-info-circle text-4xl text-gray-400 mb-4"></i>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">No Additional Information</h3>
            <p class="text-gray-600">This driver has not uploaded any vehicles or documents yet.</p>
        </div>
    @endif
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Driver verification page loaded');
    
    const approveBtn = document.getElementById('approve-btn');
    const rejectBtn = document.getElementById('reject-btn');
    const approveForm = document.getElementById('approve-form');
    const rejectForm = document.getElementById('reject-form');
    
    if (approveBtn) {
        console.log('Approve button found');
        approveBtn.addEventListener('click', function(e) {
            console.log('Approve button clicked');
            e.preventDefault();
            
            Swal.fire({
                title: 'Approve Driver?',
                text: "Are you sure you want to approve this driver's verification? They will be able to start providing rides.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#10b981',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Yes, approve driver',
                cancelButtonText: 'Cancel',
                reverseButtons: true,
                focusCancel: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show loading state
                    this.disabled = true;
                    this.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Approving...';
                    
                    // Submit form
                    setTimeout(() => {
                        approveForm.submit();
                    }, 500);
                }
            });
        });
    }
    
    if (rejectBtn) {
        console.log('Reject button found');
        rejectBtn.addEventListener('click', function(e) {
            console.log('Reject button clicked');
            e.preventDefault();
            
            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to reject this driver's verification. This action cannot be undone!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Yes, reject driver',
                cancelButtonText: 'Cancel',
                reverseButtons: true,
                focusCancel: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show loading state
                    this.disabled = true;
                    this.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Rejecting...';
                    
                    // Submit form
                    setTimeout(() => {
                        rejectForm.submit();
                    }, 500);
                }
            });
        });
    }
    
    // Also add form submit listeners
    if (approveForm) {
        approveForm.addEventListener('submit', function(e) {
            console.log('Approve form submitting');
        });
    }
    
    if (rejectForm) {
        rejectForm.addEventListener('submit', function(e) {
            console.log('Reject form submitting');
        });
    }
});
</script>
@endsection
