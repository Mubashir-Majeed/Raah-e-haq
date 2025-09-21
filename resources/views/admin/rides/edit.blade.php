@extends('layouts.admin')

@section('title', 'Edit Ride')

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
            <h1 class="text-3xl font-bold text-gray-900">Edit Ride</h1>
            <p class="text-gray-600 mt-2">Update ride information</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('admin.rides.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200">
                <i class="fas fa-arrow-left mr-2"></i>Back to Rides
            </a>
        </div>
    </div>

    <!-- Edit Ride Form -->
    <div class="bg-white rounded-xl shadow-sm p-8">
        <form method="POST" action="{{ route('admin.rides.update', $ride) }}" class="space-y-6" id="edit-ride-form">
            @csrf
            @method('PUT')
            
            <!-- Ride ID (Read-only) -->
            <div class="bg-gray-50 p-4 rounded-lg">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-hashtag mr-2"></i>Ride ID
                </label>
                <input type="text" value="{{ $ride->ride_id }}" readonly
                       class="w-full px-4 py-3 bg-gray-100 border border-gray-300 rounded-lg text-gray-600">
            </div>

            <!-- Passenger and Driver Info (Read-only) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-gray-50 p-4 rounded-lg">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-user mr-2"></i>Passenger
                    </label>
                    <input type="text" value="{{ $ride->passenger->name }} ({{ $ride->passenger->email }})" readonly
                           class="w-full px-4 py-3 bg-gray-100 border border-gray-300 rounded-lg text-gray-600">
                </div>

                <div>
                    <label for="driver_id" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-car mr-2"></i>Driver
                    </label>
                    <select id="driver_id" name="driver_id"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('driver_id') border-red-500 @enderror">
                        <option value="">No Driver Assigned</option>
                        @foreach($drivers as $driver)
                            <option value="{{ $driver->id }}" {{ old('driver_id', $ride->driver_id) == $driver->id ? 'selected' : '' }}>
                                {{ $driver->name }} ({{ $driver->email }})
                            </option>
                        @endforeach
                    </select>
                    @error('driver_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Address Information (Read-only) -->
            <div class="space-y-6">
                <h3 class="text-lg font-semibold text-gray-900 border-b pb-2">
                    <i class="fas fa-map-marker-alt mr-2"></i>Location Details
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Pickup Address
                        </label>
                        <textarea rows="3" readonly
                                  class="w-full px-4 py-3 bg-gray-100 border border-gray-300 rounded-lg text-gray-600">{{ $ride->pickup_address }}</textarea>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Dropoff Address
                        </label>
                        <textarea rows="3" readonly
                                  class="w-full px-4 py-3 bg-gray-100 border border-gray-300 rounded-lg text-gray-600">{{ $ride->dropoff_address }}</textarea>
                    </div>
                </div>

                <!-- Coordinates (Read-only) -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Pickup Latitude
                        </label>
                        <input type="text" value="{{ $ride->pickup_latitude }}" readonly
                               class="w-full px-4 py-3 bg-gray-100 border border-gray-300 rounded-lg text-gray-600">
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Pickup Longitude
                        </label>
                        <input type="text" value="{{ $ride->pickup_longitude }}" readonly
                               class="w-full px-4 py-3 bg-gray-100 border border-gray-300 rounded-lg text-gray-600">
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Dropoff Latitude
                        </label>
                        <input type="text" value="{{ $ride->dropoff_latitude }}" readonly
                               class="w-full px-4 py-3 bg-gray-100 border border-gray-300 rounded-lg text-gray-600">
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Dropoff Longitude
                        </label>
                        <input type="text" value="{{ $ride->dropoff_longitude }}" readonly
                               class="w-full px-4 py-3 bg-gray-100 border border-gray-300 rounded-lg text-gray-600">
                    </div>
                </div>
            </div>

            <!-- Ride Details -->
            <div class="space-y-6">
                <h3 class="text-lg font-semibold text-gray-900 border-b pb-2">
                    <i class="fas fa-info-circle mr-2"></i>Ride Details
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Vehicle Type
                        </label>
                        <input type="text" value="{{ ucfirst($ride->vehicle_type) }}" readonly
                               class="w-full px-4 py-3 bg-gray-100 border border-gray-300 rounded-lg text-gray-600">
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                            Status
                        </label>
                        <select id="status" name="status" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('status') border-red-500 @enderror">
                            <option value="pending" {{ old('status', $ride->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="searching" {{ old('status', $ride->status) == 'searching' ? 'selected' : '' }}>Searching</option>
                            <option value="accepted" {{ old('status', $ride->status) == 'accepted' ? 'selected' : '' }}>Accepted</option>
                            <option value="arrived" {{ old('status', $ride->status) == 'arrived' ? 'selected' : '' }}>Arrived</option>
                            <option value="started" {{ old('status', $ride->status) == 'started' ? 'selected' : '' }}>Started</option>
                            <option value="completed" {{ old('status', $ride->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ old('status', $ride->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="vehicle_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Vehicle
                        </label>
                        <select id="vehicle_id" name="vehicle_id"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('vehicle_id') border-red-500 @enderror">
                            <option value="">No Vehicle Assigned</option>
                            @foreach($vehicles as $vehicle)
                                <option value="{{ $vehicle->id }}" {{ old('vehicle_id', $ride->vehicle_id) == $vehicle->id ? 'selected' : '' }}>
                                    {{ $vehicle->make }} {{ $vehicle->model }} ({{ $vehicle->license_plate }})
                                </option>
                            @endforeach
                        </select>
                        @error('vehicle_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Pricing -->
            <div class="space-y-6">
                <h3 class="text-lg font-semibold text-gray-900 border-b pb-2">
                    <i class="fas fa-dollar-sign mr-2"></i>Pricing Details
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="total_fare" class="block text-sm font-medium text-gray-700 mb-2">
                            Total Fare (PKR)
                        </label>
                        <input type="number" step="0.01" id="total_fare" name="total_fare" required
                               value="{{ old('total_fare', $ride->total_fare) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('total_fare') border-red-500 @enderror"
                               placeholder="0.00">
                        @error('total_fare')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="driver_earnings" class="block text-sm font-medium text-gray-700 mb-2">
                            Driver Earnings (PKR)
                        </label>
                        <input type="number" step="0.01" id="driver_earnings" name="driver_earnings" required
                               value="{{ old('driver_earnings', $ride->driver_earnings) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('driver_earnings') border-red-500 @enderror"
                               placeholder="0.00">
                        @error('driver_earnings')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="platform_commission" class="block text-sm font-medium text-gray-700 mb-2">
                            Platform Commission (PKR)
                        </label>
                        <input type="number" step="0.01" id="platform_commission" name="platform_commission" required
                               value="{{ old('platform_commission', $ride->platform_commission) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('platform_commission') border-red-500 @enderror"
                               placeholder="0.00">
                        @error('platform_commission')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Cancellation Details (only show if status is cancelled) -->
            @if($ride->status === 'cancelled' || old('status') === 'cancelled')
            <div class="space-y-6">
                <h3 class="text-lg font-semibold text-gray-900 border-b pb-2">
                    <i class="fas fa-times-circle mr-2"></i>Cancellation Details
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="cancellation_reason" class="block text-sm font-medium text-gray-700 mb-2">
                            Cancellation Reason
                        </label>
                        <select id="cancellation_reason" name="cancellation_reason"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('cancellation_reason') border-red-500 @enderror">
                            <option value="">Select Reason</option>
                            <option value="passenger" {{ old('cancellation_reason', $ride->cancellation_reason) == 'passenger' ? 'selected' : '' }}>Passenger</option>
                            <option value="driver" {{ old('cancellation_reason', $ride->cancellation_reason) == 'driver' ? 'selected' : '' }}>Driver</option>
                            <option value="system" {{ old('cancellation_reason', $ride->cancellation_reason) == 'system' ? 'selected' : '' }}>System</option>
                            <option value="weather" {{ old('cancellation_reason', $ride->cancellation_reason) == 'weather' ? 'selected' : '' }}>Weather</option>
                            <option value="other" {{ old('cancellation_reason', $ride->cancellation_reason) == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('cancellation_reason')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="cancellation_note" class="block text-sm font-medium text-gray-700 mb-2">
                            Cancellation Note
                        </label>
                        <textarea id="cancellation_note" name="cancellation_note" rows="3"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('cancellation_note') border-red-500 @enderror"
                                  placeholder="Enter cancellation details">{{ old('cancellation_note', $ride->cancellation_note) }}</textarea>
                        @error('cancellation_note')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            @endif

            <!-- Form Actions -->
            <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.rides.index') }}" 
                   class="px-6 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200">
                    Cancel
                </a>
                <button type="submit" 
                        id="update-ride-btn"
                        class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 font-semibold"
                        onclick="this.disabled=true; this.innerHTML='<i class=\'fas fa-spinner fa-spin mr-2\'></i>Updating...'; this.form.submit(); return false;">
                    <i class="fas fa-save mr-2"></i>Update Ride
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-calculate platform commission when total fare or driver earnings change
    const totalFareInput = document.getElementById('total_fare');
    const driverEarningsInput = document.getElementById('driver_earnings');
    const platformCommissionInput = document.getElementById('platform_commission');

    function calculateCommission() {
        const totalFare = parseFloat(totalFareInput.value) || 0;
        const driverEarnings = parseFloat(driverEarningsInput.value) || 0;
        const commission = totalFare - driverEarnings;
        
        if (commission >= 0) {
            platformCommissionInput.value = commission.toFixed(2);
        }
    }

    totalFareInput.addEventListener('input', calculateCommission);
    driverEarningsInput.addEventListener('input', calculateCommission);

    // Show/hide cancellation fields based on status
    const statusSelect = document.getElementById('status');
    const cancellationSection = document.querySelector('.space-y-6:last-of-type');
    
    function toggleCancellationFields() {
        if (statusSelect.value === 'cancelled') {
            if (!cancellationSection) {
                // Create cancellation section if it doesn't exist
                const pricingSection = document.querySelector('.space-y-6:last-of-type');
                const cancellationDiv = document.createElement('div');
                cancellationDiv.className = 'space-y-6';
                cancellationDiv.innerHTML = `
                    <h3 class="text-lg font-semibold text-gray-900 border-b pb-2">
                        <i class="fas fa-times-circle mr-2"></i>Cancellation Details
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="cancellation_reason" class="block text-sm font-medium text-gray-700 mb-2">
                                Cancellation Reason
                            </label>
                            <select id="cancellation_reason" name="cancellation_reason"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">Select Reason</option>
                                <option value="passenger">Passenger</option>
                                <option value="driver">Driver</option>
                                <option value="system">System</option>
                                <option value="weather">Weather</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div>
                            <label for="cancellation_note" class="block text-sm font-medium text-gray-700 mb-2">
                                Cancellation Note
                            </label>
                            <textarea id="cancellation_note" name="cancellation_note" rows="3"
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                      placeholder="Enter cancellation details"></textarea>
                        </div>
                    </div>
                `;
                pricingSection.parentNode.insertBefore(cancellationDiv, pricingSection.nextSibling);
            }
        }
    }

    statusSelect.addEventListener('change', toggleCancellationFields);
});
</script>
@endsection
