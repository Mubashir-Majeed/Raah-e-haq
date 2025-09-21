<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SupportTicket;
use App\Models\TicketReply;
use App\Models\User;
use Carbon\Carbon;

class SupportTicketsSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::whereHas('roles', function($query) {
            $query->whereIn('name', ['passenger', 'driver']);
        })->where('status', 'active')->get();

        $admins = User::whereHas('roles', function($query) {
            $query->where('name', 'admin');
        })->get();

        $categories = ['technical', 'billing', 'account', 'ride_issue', 'driver_issue', 'general', 'complaint', 'suggestion'];
        $priorities = ['low', 'medium', 'high', 'urgent'];
        $statuses = ['open', 'in_progress', 'pending_customer', 'resolved', 'closed'];
        $sources = ['web', 'mobile_app', 'email', 'phone', 'chat'];

        $ticketSubjects = [
            'technical' => [
                'App not working properly',
                'Unable to login to account',
                'Payment gateway issues',
                'GPS not tracking correctly',
                'App crashes frequently',
                'Unable to book rides',
                'Notification issues',
                'Profile update problems'
            ],
            'billing' => [
                'Incorrect fare calculation',
                'Payment not processed',
                'Refund request',
                'Charged twice for same ride',
                'Wallet balance issues',
                'Payment method not working',
                'Receipt not received',
                'Subscription billing problem'
            ],
            'account' => [
                'Account verification pending',
                'Unable to update profile',
                'Password reset issues',
                'Account suspended',
                'Email verification problems',
                'Phone number update',
                'Account security concerns',
                'Profile picture upload issues'
            ],
            'ride_issue' => [
                'Driver not arriving',
                'Ride cancelled without reason',
                'Wrong pickup location',
                'Driver behavior issues',
                'Vehicle condition problems',
                'Route not followed',
                'Fare dispute',
                'Safety concerns'
            ],
            'driver_issue' => [
                'Unable to go online',
                'Earnings not credited',
                'Passenger no-show',
                'Rating system issues',
                'Document verification pending',
                'Vehicle registration problems',
                'App performance issues',
                'Support team response needed'
            ],
            'general' => [
                'General inquiry',
                'Feature request',
                'How to use app',
                'Account information',
                'Service availability',
                'Partnership inquiry',
                'Feedback submission',
                'Contact information needed'
            ],
            'complaint' => [
                'Poor service quality',
                'Unprofessional driver',
                'Overcharging complaint',
                'App malfunction',
                'Customer service issues',
                'Safety concerns',
                'Discrimination complaint',
                'Service not as advertised'
            ],
            'suggestion' => [
                'New feature suggestion',
                'App improvement ideas',
                'Service enhancement',
                'User experience feedback',
                'Interface improvements',
                'Additional services',
                'Pricing suggestions',
                'Accessibility improvements'
            ]
        ];

        $ticketDescriptions = [
            'I am experiencing issues with the app where it keeps crashing whenever I try to book a ride. This has been happening for the past 2 days and I have tried restarting the app multiple times.',
            'The driver assigned to my ride was very unprofessional and the vehicle was in poor condition. I had to cancel the ride and book another one.',
            'I was charged twice for the same ride. The payment was deducted from my account but the ride was not completed. Please help me get a refund.',
            'I am unable to update my profile information. Every time I try to save changes, it shows an error message.',
            'The GPS tracking is not working correctly. The driver\'s location is not showing accurately on the map.',
            'I have been waiting for my account verification for over a week. When will it be processed?',
            'The fare calculation seems incorrect for my last ride. The distance was much shorter than what was charged.',
            'I want to suggest adding a feature to schedule rides in advance. This would be very helpful for daily commuters.',
            'The app is very slow and takes a long time to load. This affects the user experience significantly.',
            'I had a great experience with one of your drivers. Please pass on my appreciation to the team.',
            'The customer service response time is very slow. I submitted a ticket 3 days ago and still no response.',
            'I am unable to add my payment method. The app keeps showing an error when I try to add my credit card.',
            'The driver cancelled my ride at the last moment without any reason. This caused me to be late for my important meeting.',
            'I want to report a safety concern. The driver was using his phone while driving which is dangerous.',
            'The app interface is confusing and not user-friendly. Please improve the design for better usability.'
        ];

        $replyMessages = [
            'Thank you for contacting us. We have received your request and our team is looking into it.',
            'We apologize for the inconvenience caused. We are working to resolve this issue as soon as possible.',
            'Your account has been verified successfully. You can now use all the features of the app.',
            'We have processed your refund request. The amount will be credited to your account within 3-5 business days.',
            'We have escalated your concern to our technical team. They will investigate and provide a solution.',
            'Thank you for your feedback. We appreciate your suggestions and will consider them for future updates.',
            'We have updated your profile information as requested. Please check and confirm if everything is correct.',
            'We have assigned a senior support agent to handle your case. They will contact you within 24 hours.',
            'The issue has been resolved. Please try using the app again and let us know if you face any problems.',
            'We have forwarded your complaint to the relevant department. They will take appropriate action.',
            'Your payment method has been added successfully. You can now use it for future rides.',
            'We have updated our system to prevent this issue from happening again. Thank you for reporting it.',
            'We have credited the fare difference to your account. Please check your wallet balance.',
            'We have taken necessary action against the driver. Thank you for bringing this to our attention.',
            'We are continuously working to improve our services. Your feedback helps us serve you better.'
        ];

        // Create 150 support tickets
        for ($i = 0; $i < 150; $i++) {
            $user = $users->random();
            $category = $categories[array_rand($categories)];
            $priority = $priorities[array_rand($priorities)];
            $status = $statuses[array_rand($statuses)];
            $source = $sources[array_rand($sources)];
            $subject = $ticketSubjects[$category][array_rand($ticketSubjects[$category])];
            $description = $ticketDescriptions[array_rand($ticketDescriptions)];

            $createdAt = Carbon::now()->subDays(rand(0, 60))->subHours(rand(0, 23))->subMinutes(rand(0, 59));

            $ticket = SupportTicket::create([
                'ticket_number' => SupportTicket::generateTicketNumber(),
                'user_id' => $user->id,
                'assigned_to' => rand(0, 1) ? $admins->random()->id : null,
                'subject' => $subject,
                'description' => $description,
                'category' => $category,
                'priority' => $priority,
                'status' => $status,
                'source' => $source,
                'attachments' => rand(0, 1) ? ['attachment1.pdf', 'attachment2.jpg'] : null,
                'metadata' => [
                    'device_info' => 'iPhone 12, iOS 15.0',
                    'app_version' => '2.1.0',
                    'location' => 'Karachi, Pakistan',
                    'user_agent' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 15_0 like Mac OS X)'
                ],
                'resolved_at' => in_array($status, ['resolved', 'closed']) ? $createdAt->copy()->addDays(rand(1, 7)) : null,
                'closed_at' => $status === 'closed' ? $createdAt->copy()->addDays(rand(3, 10)) : null,
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ]);

            // Add replies to tickets
            $replyCount = rand(1, 5);
            for ($j = 0; $j < $replyCount; $j++) {
                $replyUser = rand(0, 1) ? $user : $admins->random();
                $isInternal = $replyUser->hasRole('admin') && rand(0, 1);
                $message = $replyMessages[array_rand($replyMessages)];
                
                $replyCreatedAt = $createdAt->copy()->addHours(rand(1, 48))->addMinutes(rand(0, 59));

                TicketReply::create([
                    'ticket_id' => $ticket->id,
                    'user_id' => $replyUser->id,
                    'message' => $message,
                    'type' => $isInternal ? 'note' : 'reply',
                    'is_internal' => $isInternal,
                    'attachments' => rand(0, 1) ? ['reply_attachment.pdf'] : null,
                    'created_at' => $replyCreatedAt,
                    'updated_at' => $replyCreatedAt,
                ]);
            }

            // Update ticket status based on replies
            if ($replyCount > 1) {
                $ticket->update(['status' => 'in_progress']);
            }
        }

        $this->command->info('Created 150 professional support tickets with realistic data');
    }
}
