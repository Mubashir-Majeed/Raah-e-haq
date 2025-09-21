<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SupportTicket;
use App\Models\TicketReply;
use App\Models\TicketCategory;
use App\Models\User;

class SupportTicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create ticket categories
        $categories = [
            [
                'name' => 'Technical Support',
                'slug' => 'technical',
                'description' => 'Technical issues and app problems',
                'color' => '#3B82F6',
                'icon' => 'fas fa-cog',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Billing & Payments',
                'slug' => 'billing',
                'description' => 'Payment and billing related issues',
                'color' => '#10B981',
                'icon' => 'fas fa-credit-card',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Account Issues',
                'slug' => 'account',
                'description' => 'Account management and profile issues',
                'color' => '#8B5CF6',
                'icon' => 'fas fa-user',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Ride Issues',
                'slug' => 'ride_issue',
                'description' => 'Problems with rides and bookings',
                'color' => '#F59E0B',
                'icon' => 'fas fa-car',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Driver Issues',
                'slug' => 'driver_issue',
                'description' => 'Driver-related problems and concerns',
                'color' => '#EF4444',
                'icon' => 'fas fa-id-card',
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'General Inquiry',
                'slug' => 'general',
                'description' => 'General questions and information',
                'color' => '#6B7280',
                'icon' => 'fas fa-question-circle',
                'sort_order' => 6,
                'is_active' => true,
            ],
            [
                'name' => 'Complaints',
                'slug' => 'complaint',
                'description' => 'Service complaints and feedback',
                'color' => '#DC2626',
                'icon' => 'fas fa-exclamation-triangle',
                'sort_order' => 7,
                'is_active' => true,
            ],
            [
                'name' => 'Suggestions',
                'slug' => 'suggestion',
                'description' => 'Feature suggestions and improvements',
                'color' => '#059669',
                'icon' => 'fas fa-lightbulb',
                'sort_order' => 8,
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            TicketCategory::firstOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }

        // Get users for creating tickets
        $users = User::whereHas('roles', function($q) {
            $q->whereIn('name', ['driver', 'passenger']);
        })->get();

        $admins = User::whereHas('roles', function($q) {
            $q->where('name', 'admin');
        })->get();

        if ($users->isEmpty() || $admins->isEmpty()) {
            return;
        }

        // Create sample support tickets
        $ticketData = [
            [
                'subject' => 'App keeps crashing on Android',
                'description' => 'The app crashes every time I try to book a ride. It happens right after I select my destination. I\'ve tried restarting the app and my phone but the issue persists.',
                'category' => 'technical',
                'priority' => 'high',
                'source' => 'mobile_app',
                'status' => 'open',
            ],
            [
                'subject' => 'Payment not processed for ride',
                'description' => 'I was charged for a ride but the payment didn\'t go through. The driver said the payment failed but I can see the charge on my bank statement.',
                'category' => 'billing',
                'priority' => 'urgent',
                'source' => 'web',
                'status' => 'in_progress',
            ],
            [
                'subject' => 'Cannot update profile information',
                'description' => 'I\'m trying to update my phone number in my profile but the changes are not saving. The form shows success but when I refresh, the old number is still there.',
                'category' => 'account',
                'priority' => 'medium',
                'source' => 'web',
                'status' => 'pending_customer',
            ],
            [
                'subject' => 'Driver took wrong route',
                'description' => 'The driver took a much longer route than necessary, which increased the fare significantly. I asked him to take the shorter route but he refused.',
                'category' => 'ride_issue',
                'priority' => 'medium',
                'source' => 'mobile_app',
                'status' => 'resolved',
            ],
            [
                'subject' => 'Driver was rude and unprofessional',
                'description' => 'The driver was very rude during the ride. He was talking on the phone loudly and made inappropriate comments. This is not acceptable behavior.',
                'category' => 'driver_issue',
                'priority' => 'high',
                'source' => 'mobile_app',
                'status' => 'in_progress',
            ],
            [
                'subject' => 'How to cancel a ride?',
                'description' => 'I need to know how to cancel a ride that I\'ve already booked. I can\'t find the cancel option in the app.',
                'category' => 'general',
                'priority' => 'low',
                'source' => 'chat',
                'status' => 'closed',
            ],
            [
                'subject' => 'Poor customer service experience',
                'description' => 'I had a terrible experience with your customer service. The representative was not helpful and didn\'t resolve my issue. Very disappointed.',
                'category' => 'complaint',
                'priority' => 'high',
                'source' => 'email',
                'status' => 'open',
            ],
            [
                'subject' => 'Add option to tip driver in cash',
                'description' => 'It would be great if you could add an option to tip the driver in cash instead of only through the app. Sometimes I prefer to give cash tips.',
                'category' => 'suggestion',
                'priority' => 'low',
                'source' => 'web',
                'status' => 'open',
            ],
            [
                'subject' => 'App not working on iOS 17',
                'description' => 'The app is not working properly on iOS 17. It keeps freezing and the map doesn\'t load correctly. Please fix this compatibility issue.',
                'category' => 'technical',
                'priority' => 'urgent',
                'source' => 'mobile_app',
                'status' => 'in_progress',
            ],
            [
                'subject' => 'Refund request for cancelled ride',
                'description' => 'I need a refund for a ride that was cancelled by the driver. The driver cancelled after I had already paid and waited for 15 minutes.',
                'category' => 'billing',
                'priority' => 'high',
                'source' => 'phone',
                'status' => 'pending_customer',
            ],
        ];

        foreach ($ticketData as $index => $data) {
            $user = $users->random();
            $admin = $admins->random();
            
            $ticket = SupportTicket::create([
                'ticket_number' => SupportTicket::generateTicketNumber(),
                'user_id' => $user->id,
                'assigned_to' => $admin->id,
                'subject' => $data['subject'],
                'description' => $data['description'],
                'category' => $data['category'],
                'priority' => $data['priority'],
                'status' => $data['status'],
                'source' => $data['source'],
                'metadata' => [
                    'device_info' => 'Sample device information',
                    'app_version' => '1.2.3',
                    'os_version' => 'Android 13 / iOS 17',
                ],
                'created_at' => now()->subDays(rand(1, 30)),
            ]);

            // Add some replies to tickets
            if (in_array($data['status'], ['in_progress', 'resolved', 'closed'])) {
                // Admin reply
                $ticket->addReply(
                    $admin->id,
                    'Thank you for contacting us. We have received your request and are looking into this matter. We will get back to you with an update soon.',
                    'reply',
                    false
                );

                if (in_array($data['status'], ['resolved', 'closed'])) {
                    // Resolution reply
                    $ticket->addReply(
                        $admin->id,
                        'Your issue has been resolved. We have processed your refund and it should reflect in your account within 2-3 business days. Thank you for your patience.',
                        'reply',
                        false
                    );

                    if ($data['status'] === 'resolved') {
                        $ticket->update(['resolved_at' => now()->subDays(rand(1, 5))]);
                    } else {
                        $ticket->update(['closed_at' => now()->subDays(rand(1, 3))]);
                    }
                }
            }

            // Add internal notes for some tickets
            if (rand(0, 1)) {
                $ticket->addReply(
                    $admin->id,
                    'Internal note: Customer has been contacted via phone. Issue escalated to technical team.',
                    'note',
                    true
                );
            }
        }

        // Create some additional tickets with different statuses
        for ($i = 0; $i < 15; $i++) {
            $user = $users->random();
            $admin = rand(0, 1) ? $admins->random() : null;
            
            $categories = ['technical', 'billing', 'account', 'ride_issue', 'driver_issue', 'general', 'complaint', 'suggestion'];
            $priorities = ['low', 'medium', 'high', 'urgent'];
            $statuses = ['open', 'in_progress', 'pending_customer', 'resolved', 'closed'];
            $sources = ['web', 'mobile_app', 'email', 'phone', 'chat'];
            
            $ticket = SupportTicket::create([
                'ticket_number' => SupportTicket::generateTicketNumber(),
                'user_id' => $user->id,
                'assigned_to' => $admin?->id,
                'subject' => 'Sample Support Ticket ' . ($i + 1),
                'description' => 'This is a sample support ticket description for testing purposes. The customer is experiencing an issue that needs to be resolved.',
                'category' => $categories[array_rand($categories)],
                'priority' => $priorities[array_rand($priorities)],
                'status' => $statuses[array_rand($statuses)],
                'source' => $sources[array_rand($sources)],
                'metadata' => [
                    'device_info' => 'Sample device information',
                    'app_version' => '1.2.3',
                ],
                'created_at' => now()->subDays(rand(1, 60)),
            ]);

            // Add random replies
            if (rand(0, 1)) {
                $replyUser = rand(0, 1) ? $user : $admin;
                if ($replyUser) {
                    $ticket->addReply(
                        $replyUser->id,
                        'This is a sample reply to the support ticket.',
                        'reply',
                        false
                    );
                }
            }
        }
    }
}
