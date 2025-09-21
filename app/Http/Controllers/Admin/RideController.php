<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ride;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class RideController extends Controller
{
    public function index(Request $request)
    {
        $query = Ride::with(['passenger', 'driver', 'vehicle']);

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('ride_id', 'like', "%{$search}%")
                  ->orWhere('pickup_address', 'like', "%{$search}%")
                  ->orWhere('dropoff_address', 'like', "%{$search}%")
                  ->orWhereHas('passenger', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                  })
                  ->orWhereHas('driver', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Filter by vehicle type
        if ($request->filled('vehicle_type')) {
            $query->where('vehicle_type', $request->vehicle_type);
        }

        $rides = $query->orderBy('created_at', 'desc')->paginate(15);

        // Get statistics
        $stats = [
            'total_rides' => Ride::count(),
            'pending_rides' => Ride::where('status', 'pending')->count(),
            'active_rides' => Ride::whereIn('status', ['searching', 'accepted', 'arrived', 'started'])->count(),
            'completed_rides' => Ride::where('status', 'completed')->count(),
            'cancelled_rides' => Ride::where('status', 'cancelled')->count(),
            'total_revenue' => Ride::where('status', 'completed')->sum('total_fare'),
            'driver_earnings' => Ride::where('status', 'completed')->sum('driver_earnings'),
            'platform_commission' => Ride::where('status', 'completed')->sum('platform_commission'),
        ];

        return view('admin.rides.index', compact('rides', 'stats'));
    }

    public function create()
    {
        $passengers = User::whereHas('roles', function($query) {
            $query->where('name', 'passenger');
        })->where('status', 'active')->get();

        $drivers = User::whereHas('roles', function($query) {
            $query->where('name', 'driver');
        })->where('status', 'active')->get();

        $vehicles = Vehicle::where('verification_status', 'approved')->get();

        return view('admin.rides.create', compact('passengers', 'drivers', 'vehicles'));
    }

    public function store(Request $request)
    {
        \Log::info('Admin create ride request received', [
            'request_data' => $request->all()
        ]);

        $validatedData = $request->validate([
            'passenger_id' => 'required|exists:users,id',
            'driver_id' => 'nullable|exists:users,id',
            'vehicle_id' => 'nullable|exists:vehicles,id',
            'pickup_address' => 'required|string|max:500',
            'dropoff_address' => 'required|string|max:500',
            'pickup_latitude' => 'required|numeric',
            'pickup_longitude' => 'required|numeric',
            'dropoff_latitude' => 'required|numeric',
            'dropoff_longitude' => 'required|numeric',
            'vehicle_type' => 'required|in:car,motorcycle,auto',
            'total_fare' => 'required|numeric|min:0',
            'driver_earnings' => 'required|numeric|min:0',
            'platform_commission' => 'required|numeric|min:0',
            'status' => 'required|in:pending,searching,accepted,arrived,started,completed,cancelled',
        ]);

        try {
            $ride = Ride::create([
                'ride_id' => 'RIDE-' . strtoupper(uniqid()),
                'passenger_id' => $validatedData['passenger_id'],
                'driver_id' => $validatedData['driver_id'],
                'vehicle_id' => $validatedData['vehicle_id'],
                'pickup_address' => $validatedData['pickup_address'],
                'dropoff_address' => $validatedData['dropoff_address'],
                'pickup_latitude' => $validatedData['pickup_latitude'],
                'pickup_longitude' => $validatedData['pickup_longitude'],
                'dropoff_latitude' => $validatedData['dropoff_latitude'],
                'dropoff_longitude' => $validatedData['dropoff_longitude'],
                'vehicle_type' => $validatedData['vehicle_type'],
                'total_fare' => $validatedData['total_fare'],
                'driver_earnings' => $validatedData['driver_earnings'],
                'platform_commission' => $validatedData['platform_commission'],
                'status' => $validatedData['status'],
            ]);

            \Log::info('Admin created ride successfully', ['ride_id' => $ride->id]);

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'message' => 'Ride created successfully!', 'redirect' => route('admin.rides.index')]);
            }
            return redirect()->route('admin.rides.index')->with('success', 'Ride created successfully!');
        } catch (\Throwable $e) {
            \Log::error('Failed to create ride', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->all()
            ]);
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Failed to create ride. Please try again.', 'error' => $e->getMessage()], 500);
            }
            return back()->withInput()->with('error', 'Failed to create ride. Please try again.');
        }
    }

    public function show(Ride $ride)
    {
        $ride->load(['passenger', 'driver', 'vehicle', 'cancelledBy']);
        return view('admin.rides.show', compact('ride'));
    }

    public function edit(Ride $ride)
    {
        $drivers = User::whereHas('roles', function($query) {
            $query->where('name', 'driver');
        })->where('status', 'active')->get();

        $vehicles = Vehicle::where('verification_status', 'approved')->get();

        return view('admin.rides.edit', compact('ride', 'drivers', 'vehicles'));
    }

    public function update(Request $request, Ride $ride)
    {
        \Log::info('Admin update ride request received', [
            'ride_id' => $ride->id,
            'request_data' => $request->all()
        ]);

        $validatedData = $request->validate([
            'status' => 'required|in:pending,searching,accepted,arrived,started,completed,cancelled',
            'driver_id' => 'nullable|exists:users,id',
            'vehicle_id' => 'nullable|exists:vehicles,id',
            'total_fare' => 'required|numeric|min:0',
            'driver_earnings' => 'required|numeric|min:0',
            'platform_commission' => 'required|numeric|min:0',
            'cancellation_reason' => 'nullable|in:passenger,driver,system,weather,other',
            'cancellation_note' => 'nullable|string|max:500',
        ]);

        try {
            $ride->update($validatedData);

            // Update timestamps based on status
            if ($request->status === 'accepted' && !$ride->accepted_at) {
                $ride->update(['accepted_at' => now()]);
            } elseif ($request->status === 'arrived' && !$ride->arrived_at) {
                $ride->update(['arrived_at' => now()]);
            } elseif ($request->status === 'started' && !$ride->started_at) {
                $ride->update(['started_at' => now()]);
            } elseif ($request->status === 'completed' && !$ride->completed_at) {
                $ride->update(['completed_at' => now()]);
            } elseif ($request->status === 'cancelled' && !$ride->cancelled_at) {
                $ride->update(['cancelled_at' => now(), 'cancelled_by' => auth()->id()]);
            }

            \Log::info('Admin updated ride successfully', ['ride_id' => $ride->id]);

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'message' => 'Ride updated successfully!', 'redirect' => route('admin.rides.index')]);
            }
            return redirect()->route('admin.rides.index')->with('success', 'Ride updated successfully!');
        } catch (\Throwable $e) {
            \Log::error('Failed to update ride', [
                'ride_id' => $ride->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->all()
            ]);
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Failed to update ride. Please try again.', 'error' => $e->getMessage()], 500);
            }
            return back()->withInput()->with('error', 'Failed to update ride. Please try again.');
        }
    }

    public function destroy(Ride $ride)
    {
        $ride->delete();
        return redirect()->route('admin.rides.index')->with('success', 'Ride deleted successfully!');
    }

    public function cancel(Request $request, Ride $ride)
    {
        $request->validate([
            'cancellation_reason' => 'required|in:passenger,driver,system,weather,other',
            'cancellation_note' => 'required|string|max:500',
        ]);

        $ride->update([
            'status' => 'cancelled',
            'cancellation_reason' => $request->cancellation_reason,
            'cancellation_note' => $request->cancellation_note,
            'cancelled_at' => now(),
            'cancelled_by' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Ride cancelled successfully!');
    }

    public function assignDriver(Request $request, Ride $ride)
    {
        $request->validate([
            'driver_id' => 'required|exists:users,id',
            'vehicle_id' => 'nullable|exists:vehicles,id',
        ]);

        $ride->update([
            'driver_id' => $request->driver_id,
            'vehicle_id' => $request->vehicle_id,
            'status' => 'accepted',
            'accepted_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Driver assigned successfully!');
    }
}
