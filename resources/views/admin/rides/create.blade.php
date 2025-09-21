@extends('layouts.admin')

@section('title', 'Create Ride')

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
            <h1 class="text-3xl font-bold text-gray-900">Create New Ride</h1>
            <p class="text-gray-600 mt-2">Add a new ride to the system</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('admin.rides.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200">
                <i class="fas fa-arrow-left mr-2"></i>Back to Rides
            </a>
        </div>
    </div>

    <!-- Create Ride Form -->
    <div class="bg-white rounded-xl shadow-sm p-8">
        <form method="POST" action="{{ route('admin.rides.store') }}" class="space-y-6" id="create-ride-form">
            @csrf
            
            <!-- Passenger Selection -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="passenger_id" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-user mr-2"></i>Passenger
                    </label>
                    <select id="passenger_id" name="passenger_id" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('passenger_id') border-red-500 @enderror">
                        <option value="">Select Passenger</option>
                        @foreach($passengers as $passenger)
                            <option value="{{ $passenger->id }}" {{ old('passenger_id') == $passenger->id ? 'selected' : '' }}>
                                {{ $passenger->name }} ({{ $passenger->email }})
                            </option>
                        @endforeach
                    </select>
                    @error('passenger_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="driver_id" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-car mr-2"></i>Driver (Optional)
                    </label>
                    <select id="driver_id" name="driver_id"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('driver_id') border-red-500 @enderror">
                        <option value="">Select Driver (Optional)</option>
                        @foreach($drivers as $driver)
                            <option value="{{ $driver->id }}" {{ old('driver_id') == $driver->id ? 'selected' : '' }}>
                                {{ $driver->name }} ({{ $driver->email }})
                            </option>
                        @endforeach
                    </select>
                    @error('driver_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Address Information -->
            <div class="space-y-6">
                <h3 class="text-lg font-semibold text-gray-900 border-b pb-2">
                    <i class="fas fa-map-marker-alt mr-2"></i>Location Details
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="pickup_address" class="block text-sm font-medium text-gray-700 mb-2">
                            Pickup Address
                        </label>
                        <textarea id="pickup_address" name="pickup_address" rows="3" required
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('pickup_address') border-red-500 @enderror"
                                  placeholder="Enter pickup address">{{ old('pickup_address') }}</textarea>
                        @error('pickup_address')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="dropoff_address" class="block text-sm font-medium text-gray-700 mb-2">
                            Dropoff Address
                        </label>
                        <textarea id="dropoff_address" name="dropoff_address" rows="3" required
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('dropoff_address') border-red-500 @enderror"
                                  placeholder="Enter dropoff address">{{ old('dropoff_address') }}</textarea>
                        @error('dropoff_address')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Coordinates -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label for="pickup_latitude" class="block text-sm font-medium text-gray-700 mb-2">
                            Pickup Latitude
                        </label>
                        <input type="number" step="any" id="pickup_latitude" name="pickup_latitude" required
                               value="{{ old('pickup_latitude') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('pickup_latitude') border-red-500 @enderror"
                               placeholder="24.8607">
                        @error('pickup_latitude')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="pickup_longitude" class="block text-sm font-medium text-gray-700 mb-2">
                            Pickup Longitude
                        </label>
                        <input type="number" step="any" id="pickup_longitude" name="pickup_longitude" required
                               value="{{ old('pickup_longitude') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('pickup_longitude') border-red-500 @enderror"
                               placeholder="67.0011">
                        @error('pickup_longitude')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="dropoff_latitude" class="block text-sm font-medium text-gray-700 mb-2">
                            Dropoff Latitude
                        </label>
                        <input type="number" step="any" id="dropoff_latitude" name="dropoff_latitude" required
                               value="{{ old('dropoff_latitude') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('dropoff_latitude') border-red-500 @enderror"
                               placeholder="24.8607">
                        @error('dropoff_latitude')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="dropoff_longitude" class="block text-sm font-medium text-gray-700 mb-2">
                            Dropoff Longitude
                        </label>
                        <input type="number" step="any" id="dropoff_longitude" name="dropoff_longitude" required
                               value="{{ old('dropoff_longitude') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('dropoff_longitude') border-red-500 @enderror"
                               placeholder="67.0011">
                        @error('dropoff_longitude')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Ride Details -->
            <div class="space-y-6">
                <h3 class="text-lg font-semibold text-gray-900 border-b pb-2">
                    <i class="fas fa-info-circle mr-2"></i>Ride Details
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="vehicle_type" class="block text-sm font-medium text-gray-700 mb-2">
                            Vehicle Type
                        </label>
                        <select id="vehicle_type" name="vehicle_type" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('vehicle_type') border-red-500 @enderror">
                            <option value="">Select Vehicle Type</option>
                            <option value="car" {{ old('vehicle_type') == 'car' ? 'selected' : '' }}>Car</option>
                            <option value="motorcycle" {{ old('vehicle_type') == 'motorcycle' ? 'selected' : '' }}>Motorcycle</option>
                            <option value="auto" {{ old('vehicle_type') == 'auto' ? 'selected' : '' }}>Auto Rickshaw</option>
                        </select>
                        @error('vehicle_type')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                            Status
                        </label>
                        <select id="status" name="status" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('status') border-red-500 @enderror">
                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="searching" {{ old('status') == 'searching' ? 'selected' : '' }}>Searching</option>
                            <option value="accepted" {{ old('status') == 'accepted' ? 'selected' : '' }}>Accepted</option>
                            <option value="arrived" {{ old('status') == 'arrived' ? 'selected' : '' }}>Arrived</option>
                            <option value="started" {{ old('status') == 'started' ? 'selected' : '' }}>Started</option>
                            <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="vehicle_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Vehicle (Optional)
                        </label>
                        <select id="vehicle_id" name="vehicle_id"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('vehicle_id') border-red-500 @enderror">
                            <option value="">Select Vehicle (Optional)</option>
                            @foreach($vehicles as $vehicle)
                                <option value="{{ $vehicle->id }}" {{ old('vehicle_id') == $vehicle->id ? 'selected' : '' }}>
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
                               value="{{ old('total_fare') }}"
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
                               value="{{ old('driver_earnings') }}"
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
                               value="{{ old('platform_commission') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('platform_commission') border-red-500 @enderror"
                               placeholder="0.00">
                        @error('platform_commission')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.rides.index') }}" 
                   class="px-6 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200">
                    Cancel
                </a>
                <button type="submit" 
                        id="create-ride-btn"
                        class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 font-semibold"
                        onclick="this.disabled=true; this.innerHTML='<i class=\'fas fa-spinner fa-spin mr-2\'></i>Creating Ride...'; this.form.submit(); return false;">
                    <i class="fas fa-plus mr-2"></i>Create Ride
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
});
</script>
@endsection
