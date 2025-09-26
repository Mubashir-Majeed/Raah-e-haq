<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class LandingController extends Controller
{
    /**
     * Display the landing page
     */
    public function index()
    {
        return view('landing');
    }

    /**
     * Handle contact form submission
     */
    public function contact(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Here you would typically send an email
            // For now, we'll just log the contact form submission
            \Log::info('Contact form submission', [
                'name' => $request->name,
                'email' => $request->email,
                'subject' => $request->subject,
                'message' => $request->message,
                'timestamp' => now()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Thank you for your message! We will get back to you soon.'
            ]);

        } catch (\Exception $e) {
            \Log::error('Contact form error', [
                'error' => $e->getMessage(),
                'request' => $request->all()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Sorry, there was an error sending your message. Please try again later.'
            ], 500);
        }
    }

    /**
     * Get statistics for the landing page
     */
    public function getStats()
    {
        // In a real application, you would get these from the database
        $stats = [
            'total_users' => \App\Models\User::count(),
            'total_rides' => 0, // You can add this when you have rides
            'total_drivers' => \App\Models\User::whereHas('roles', function($query) {
                $query->where('name', 'driver');
            })->count(),
            'average_rating' => 4.9
        ];

        return response()->json([
            'success' => true,
            'data' => $stats
        ]);
    }
}