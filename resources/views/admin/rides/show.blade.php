@extends('layouts.admin')

@section('title', 'Ride Details')

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
            <h1 class="text-3xl font-bold text-gray-900">Ride Details</h1>
            <p class="text-gray-600 mt-2">View ride information and status</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('admin.rides.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200">
                <i class="fas fa-arrow-left mr-2"></i>Back to Rides
            </a>
            <a href="{{ route('admin.rides.edit', $ride) }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                <i class="fas fa-edit mr-2"></i>Edit Ride
            </a>
        </div>
    </div>

    <!-- Ride Information -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Information -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Basic Information -->
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">
                    <i class="fas fa-info-circle mr-2"></i>Basic Information
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Ride ID</label>
                        <div class="px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg">
                            <span class="font-mono text-lg font-bold text-blue-600">{{ $ride->ride_id }}</span>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <div class="px-4 py-3">
                            @php
                                $statusColors = [
                                    'pending' => 'bg-yellow-100 text-yellow-800',
                                    'searching' => 'bg-blue-100 text-blue-800',
                                    'accepted' => 'bg-green-100 text-green-800',
                                    'arrived' => 'bg-indigo-100 text-indigo-800',
                                    'started' => 'bg-purple-100 text-purple-800',
                                    'completed' => 'bg-emerald-100 text-emerald-800',
                                    'cancelled' => 'bg-red-100 text-red-800',
                                ];
                                $statusColor = $statusColors[$ride->status] ?? 'bg-gray-100 text-gray-800';
                            @endphp
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $statusColor }}">
                                <i class="fas fa-circle mr-2 text-xs"></i>
                                {{ ucfirst($ride->status) }}
                            </span>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Vehicle Type</label>
                        <div class="px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg">
                            <i class="fas fa-{{ $ride->vehicle_type === 'car' ? 'car' : ($ride->vehicle_type === 'motorcycle' ? 'motorcycle' : 'taxi') }} mr-2"></i>
                            {{ ucfirst($ride->vehicle_type) }}
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Created At</label>
                        <div class="px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg">
                            {{ $ride->created_at->format('M d, Y H:i A') }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Location Information -->
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">
                    <i class="fas fa-map-marker-alt mr-2"></i>Location Details
                </h3>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Pickup Address</label>
                        <div class="px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg">
                            <i class="fas fa-map-pin mr-2 text-green-600"></i>
                            {{ $ride->pickup_address }}
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Dropoff Address</label>
                        <div class="px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg">
                            <i class="fas fa-map-pin mr-2 text-red-600"></i>
                            {{ $ride->dropoff_address }}
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Pickup Latitude</label>
                            <div class="px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg font-mono">
                                {{ $ride->pickup_latitude }}
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Pickup Longitude</label>
                            <div class="px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg font-mono">
                                {{ $ride->pickup_longitude }}
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Dropoff Latitude</label>
                            <div class="px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg font-mono">
                                {{ $ride->dropoff_latitude }}
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Dropoff Longitude</label>
                            <div class="px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg font-mono">
                                {{ $ride->dropoff_longitude }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pricing Information -->
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">
                    <i class="fas fa-dollar-sign mr-2"></i>Pricing Details
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="text-center p-4 bg-green-50 rounded-lg border border-green-200">
                        <div class="text-2xl font-bold text-green-600">PKR {{ number_format($ride->total_fare, 2) }}</div>
                        <div class="text-sm text-green-700 font-medium">Total Fare</div>
                    </div>
                    
                    <div class="text-center p-4 bg-blue-50 rounded-lg border border-blue-200">
                        <div class="text-2xl font-bold text-blue-600">PKR {{ number_format($ride->driver_earnings, 2) }}</div>
                        <div class="text-sm text-blue-700 font-medium">Driver Earnings</div>
                    </div>
                    
                    <div class="text-center p-4 bg-purple-50 rounded-lg border border-purple-200">
                        <div class="text-2xl font-bold text-purple-600">PKR {{ number_format($ride->platform_commission, 2) }}</div>
                        <div class="text-sm text-purple-700 font-medium">Platform Commission</div>
                    </div>
                </div>
            </div>

            <!-- Cancellation Information -->
            @if($ride->status === 'cancelled')
            <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-red-500">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">
                    <i class="fas fa-times-circle mr-2 text-red-600"></i>Cancellation Details
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Cancellation Reason</label>
                        <div class="px-4 py-3 bg-red-50 border border-red-200 rounded-lg">
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                {{ ucfirst($ride->cancellation_reason ?? 'Not specified') }}
                            </span>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Cancelled At</label>
                        <div class="px-4 py-3 bg-red-50 border border-red-200 rounded-lg">
                            {{ $ride->cancelled_at ? $ride->cancelled_at->format('M d, Y H:i A') : 'N/A' }}
                        </div>
                    </div>
                    
                    @if($ride->cancellation_note)
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Cancellation Note</label>
                        <div class="px-4 py-3 bg-red-50 border border-red-200 rounded-lg">
                            {{ $ride->cancellation_note }}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar Information -->
        <div class="space-y-6">
            <!-- Passenger Information -->
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">
                    <i class="fas fa-user mr-2"></i>Passenger
                </h3>
                
                <div class="flex items-center space-x-4 mb-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-user text-blue-600 text-lg"></i>
                    </div>
                    <div>
                        <div class="font-semibold text-gray-900">{{ $ride->passenger->name }}</div>
                        <div class="text-sm text-gray-600">{{ $ride->passenger->email }}</div>
                    </div>
                </div>
                
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Phone:</span>
                        <span class="text-sm font-medium">{{ $ride->passenger->phone ?? 'N/A' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Status:</span>
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium 
                            {{ $ride->passenger->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ ucfirst($ride->passenger->status) }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Driver Information -->
            @if($ride->driver)
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">
                    <i class="fas fa-car mr-2"></i>Driver
                </h3>
                
                <div class="flex items-center space-x-4 mb-4">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-car text-green-600 text-lg"></i>
                    </div>
                    <div>
                        <div class="font-semibold text-gray-900">{{ $ride->driver->name }}</div>
                        <div class="text-sm text-gray-600">{{ $ride->driver->email }}</div>
                    </div>
                </div>
                
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Phone:</span>
                        <span class="text-sm font-medium">{{ $ride->driver->phone ?? 'N/A' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">License:</span>
                        <span class="text-sm font-medium">{{ $ride->driver->license_number ?? 'N/A' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Status:</span>
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium 
                            {{ $ride->driver->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ ucfirst($ride->driver->status) }}
                        </span>
                    </div>
                </div>
            </div>
            @endif

            <!-- Vehicle Information -->
            @if($ride->vehicle)
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">
                    <i class="fas fa-car mr-2"></i>Vehicle
                </h3>
                
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Make/Model:</span>
                        <span class="text-sm font-medium">{{ $ride->vehicle->make }} {{ $ride->vehicle->model }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Year:</span>
                        <span class="text-sm font-medium">{{ $ride->vehicle->year }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Color:</span>
                        <span class="text-sm font-medium">{{ ucfirst($ride->vehicle->color) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">License Plate:</span>
                        <span class="text-sm font-medium font-mono">{{ $ride->vehicle->license_plate }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Verification:</span>
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium 
                            {{ $ride->vehicle->verification_status === 'approved' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ ucfirst($ride->vehicle->verification_status) }}
                        </span>
                    </div>
                </div>
            </div>
            @endif

            <!-- Timeline -->
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">
                    <i class="fas fa-clock mr-2"></i>Timeline
                </h3>
                
                <div class="space-y-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                        <div>
                            <div class="text-sm font-medium text-gray-900">Ride Requested</div>
                            <div class="text-xs text-gray-600">{{ $ride->created_at->format('M d, Y H:i A') }}</div>
                        </div>
                    </div>
                    
                    @if($ride->accepted_at)
                    <div class="flex items-center space-x-3">
                        <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                        <div>
                            <div class="text-sm font-medium text-gray-900">Ride Accepted</div>
                            <div class="text-xs text-gray-600">{{ $ride->accepted_at->format('M d, Y H:i A') }}</div>
                        </div>
                    </div>
                    @endif
                    
                    @if($ride->arrived_at)
                    <div class="flex items-center space-x-3">
                        <div class="w-2 h-2 bg-indigo-500 rounded-full"></div>
                        <div>
                            <div class="text-sm font-medium text-gray-900">Driver Arrived</div>
                            <div class="text-xs text-gray-600">{{ $ride->arrived_at->format('M d, Y H:i A') }}</div>
                        </div>
                    </div>
                    @endif
                    
                    @if($ride->started_at)
                    <div class="flex items-center space-x-3">
                        <div class="w-2 h-2 bg-purple-500 rounded-full"></div>
                        <div>
                            <div class="text-sm font-medium text-gray-900">Ride Started</div>
                            <div class="text-xs text-gray-600">{{ $ride->started_at->format('M d, Y H:i A') }}</div>
                        </div>
                    </div>
                    @endif
                    
                    @if($ride->completed_at)
                    <div class="flex items-center space-x-3">
                        <div class="w-2 h-2 bg-emerald-500 rounded-full"></div>
                        <div>
                            <div class="text-sm font-medium text-gray-900">Ride Completed</div>
                            <div class="text-xs text-gray-600">{{ $ride->completed_at->format('M d, Y H:i A') }}</div>
                        </div>
                    </div>
                    @endif
                    
                    @if($ride->cancelled_at)
                    <div class="flex items-center space-x-3">
                        <div class="w-2 h-2 bg-red-500 rounded-full"></div>
                        <div>
                            <div class="text-sm font-medium text-gray-900">Ride Cancelled</div>
                            <div class="text-xs text-gray-600">{{ $ride->cancelled_at->format('M d, Y H:i A') }}</div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
