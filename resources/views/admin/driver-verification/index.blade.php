@extends('layouts.admin')

@section('title', 'Driver Verification')

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
            <h1 class="text-3xl font-bold text-gray-900">Driver Verification</h1>
            <p class="text-gray-600 mt-2">Review and verify driver applications with documents and vehicles</p>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="stat-card rounded-2xl p-6 card-hover scale-in" style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%); backdrop-filter: blur(15px); border: 1px solid rgba(1, 28, 114, 0.15); box-shadow: 0 8px 32px rgba(1, 28, 114, 0.1);">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-2xl font-bold text-primary" style="color: #011c72ff;">{{ $drivers->total() }}</p>
                    <p class="text-sm text-secondary font-medium" style="color: orange;">Total Drivers</p>
                </div>
                <div class="w-12 h-12 gradient-primary rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg, #011c72ff 0%, #1a237e 100%);">
                    <i class="fas fa-users text-white"></i>
                </div>
            </div>
        </div>

        <div class="stat-card rounded-2xl p-6 card-hover scale-in" style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%); backdrop-filter: blur(15px); border: 1px solid rgba(1, 28, 114, 0.15); box-shadow: 0 8px 32px rgba(1, 28, 114, 0.1);">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-2xl font-bold text-warning" style="color: #ce0a0aff;">{{ $drivers->where('status', 'pending')->count() }}</p>
                    <p class="text-sm text-secondary font-medium" style="color: orange;">Pending Verification</p>
                </div>
                <div class="w-12 h-12 bg-yellow-500 rounded-xl flex items-center justify-center">
                    <i class="fas fa-clock text-white"></i>
                </div>
            </div>
        </div>

        <div class="stat-card rounded-2xl p-6 card-hover scale-in" style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%); backdrop-filter: blur(15px); border: 1px solid rgba(1, 28, 114, 0.15); box-shadow: 0 8px 32px rgba(1, 28, 114, 0.1);">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-2xl font-bold text-success" style="color: #058a0bee;">{{ $drivers->where('status', 'active')->count() }}</p>
                    <p class="text-sm text-secondary font-medium" style="color: orange;">Verified Drivers</p>
                </div>
                <div class="w-12 h-12 bg-green-500 rounded-xl flex items-center justify-center">
                    <i class="fas fa-check-circle text-white"></i>
                </div>
            </div>
        </div>

        <div class="stat-card rounded-2xl p-6 card-hover scale-in" style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%); backdrop-filter: blur(15px); border: 1px solid rgba(1, 28, 114, 0.15); box-shadow: 0 8px 32px rgba(1, 28, 114, 0.1);">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-2xl font-bold text-warning" style="color: #ce0a0aff;">{{ $drivers->where('status', 'inactive')->count() }}</p>
                    <p class="text-sm text-secondary font-medium" style="color: orange;">Rejected</p>
                </div>
                <div class="w-12 h-12 bg-red-500 rounded-xl flex items-center justify-center">
                    <i class="fas fa-times-circle text-white"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Drivers Table -->
    <div class="stat-card rounded-2xl p-6 card-hover slide-in-left" style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%); backdrop-filter: blur(15px); border: 1px solid rgba(1, 28, 114, 0.15); box-shadow: 0 8px 32px rgba(1, 28, 114, 0.1);">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-bold text-primary" style="color: #011c72ff;">Driver Applications</h2>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Driver</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Contact</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Vehicle</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Documents</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Status</th>
                        <th class="text-left py-3 px-4 font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($drivers as $driver)
                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                            <td class="py-4 px-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                                        <span class="text-white font-semibold text-sm">{{ substr($driver->name, 0, 1) }}</span>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-900">{{ $driver->name }}</p>
                                        <p class="text-sm text-gray-500">{{ $driver->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <p class="text-sm text-gray-900">{{ $driver->phone ?? 'N/A' }}</p>
                                <p class="text-sm text-gray-500">{{ $driver->cnic ?? 'N/A' }}</p>
                            </td>
                            <td class="py-4 px-4">
                                @if($driver->vehicles->count() > 0)
                                    @php $vehicle = $driver->vehicles->first(); @endphp
                                    <p class="text-sm font-medium text-gray-900">{{ $vehicle->make }} {{ $vehicle->model }}</p>
                                    <p class="text-sm text-gray-500">{{ $vehicle->license_plate }}</p>
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                        @if($vehicle->verification_status === 'approved') bg-green-100 text-green-800
                                        @elseif($vehicle->verification_status === 'rejected') bg-red-100 text-red-800
                                        @else bg-yellow-100 text-yellow-800 @endif">
                                        {{ ucfirst($vehicle->verification_status) }}
                                    </span>
                                @else
                                    <span class="text-sm text-gray-500">No vehicle</span>
                                @endif
                            </td>
                            <td class="py-4 px-4">
                                <p class="text-sm text-gray-900">{{ $driver->documents->count() }} documents</p>
                                @if($driver->documents->count() > 0)
                                    @php
                                        $approvedDocs = $driver->documents->where('verification_status', 'approved')->count();
                                        $totalDocs = $driver->documents->count();
                                    @endphp
                                    <p class="text-sm text-gray-500">{{ $approvedDocs }}/{{ $totalDocs }} approved</p>
                                @endif
                            </td>
                            <td class="py-4 px-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                    @if($driver->status === 'active') bg-green-100 text-green-800
                                    @elseif($driver->status === 'inactive') bg-red-100 text-red-800
                                    @else bg-yellow-100 text-yellow-800 @endif">
                                    {{ ucfirst($driver->status) }}
                                </span>
                            </td>
                            <td class="py-4 px-4">
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('admin.driver-verification.show', $driver) }}" 
                                       class="px-3 py-1 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors text-sm">
                                        <i class="fas fa-eye mr-1"></i>Review
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-8 px-4 text-center text-gray-500">
                                <i class="fas fa-users text-4xl mb-4"></i>
                                <p>No driver applications found</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($drivers->hasPages())
            <div class="mt-6">
                {{ $drivers->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
