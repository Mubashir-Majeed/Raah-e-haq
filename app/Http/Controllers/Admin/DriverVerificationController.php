<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\DriverDocument;
use Illuminate\Http\Request;

class DriverVerificationController extends Controller
{
    public function index()
    {
        $drivers = User::whereHas('roles', function($query) {
            $query->where('name', 'driver');
        })->with(['vehicles', 'documents'])->paginate(15);

        return view('admin.driver-verification.index', compact('drivers'));
    }

    public function show(User $driver)
    {
        $driver->load(['vehicles', 'documents', 'roles']);
        return view('admin.driver-verification.show', compact('driver'));
    }

    public function approveDriver(Request $request, User $driver)
    {
        \Log::info('Approve driver request received', [
            'driver_id' => $driver->id,
            'request_data' => $request->all()
        ]);

        $request->validate([
            'verification_type' => 'required|in:driver,vehicle,document',
            'item_id' => 'required|integer',
        ]);

        if ($request->verification_type === 'driver') {
            $driver->update(['status' => 'active']);
            \Log::info('Driver status updated to active', ['driver_id' => $driver->id]);
            $message = 'Driver verification approved successfully!';
        } elseif ($request->verification_type === 'vehicle') {
            $vehicle = Vehicle::findOrFail($request->item_id);
            $vehicle->update([
                'verification_status' => 'approved',
                'verified_at' => now(),
                'verified_by' => auth()->id(),
            ]);
            \Log::info('Vehicle approved', ['vehicle_id' => $vehicle->id, 'driver_id' => $driver->id]);
            $message = 'Vehicle approved successfully!';
        } elseif ($request->verification_type === 'document') {
            $document = DriverDocument::findOrFail($request->item_id);
            $document->update([
                'verification_status' => 'approved',
                'verified_at' => now(),
                'verified_by' => auth()->id(),
            ]);
            \Log::info('Document approved', ['document_id' => $document->id, 'driver_id' => $driver->id]);
            $message = 'Document approved successfully!';
        }

        return redirect()->back()->with('success', $message);
    }

    public function rejectDriver(Request $request, User $driver)
    {
        \Log::info('Reject driver request received', [
            'driver_id' => $driver->id,
            'request_data' => $request->all()
        ]);

        $request->validate([
            'verification_type' => 'required|in:driver,vehicle,document',
            'item_id' => 'required|integer',
            'rejection_reason' => 'required|string|max:500',
        ]);

        if ($request->verification_type === 'driver') {
            $driver->update(['status' => 'inactive']);
            \Log::info('Driver status updated to inactive', ['driver_id' => $driver->id]);
            $message = 'Driver verification rejected successfully!';
        } elseif ($request->verification_type === 'vehicle') {
            $vehicle = Vehicle::findOrFail($request->item_id);
            $vehicle->update([
                'verification_status' => 'rejected',
                'rejection_reason' => $request->rejection_reason,
                'verified_at' => now(),
                'verified_by' => auth()->id(),
            ]);
            \Log::info('Vehicle rejected', ['vehicle_id' => $vehicle->id, 'driver_id' => $driver->id, 'reason' => $request->rejection_reason]);
            $message = 'Vehicle rejected successfully!';
        } elseif ($request->verification_type === 'document') {
            $document = DriverDocument::findOrFail($request->item_id);
            $document->update([
                'verification_status' => 'rejected',
                'rejection_reason' => $request->rejection_reason,
                'verified_at' => now(),
                'verified_by' => auth()->id(),
            ]);
            \Log::info('Document rejected', ['document_id' => $document->id, 'driver_id' => $driver->id, 'reason' => $request->rejection_reason]);
            $message = 'Document rejected successfully!';
        }

        return redirect()->back()->with('success', $message);
    }
}
