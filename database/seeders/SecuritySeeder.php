<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AuditLog;
use App\Models\LoginAttempt;
use App\Models\SecurityEvent;
use App\Models\User;

class SecuritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        
        // Skip if no users exist
        if ($users->isEmpty()) {
            $this->command->info('No users found. Skipping SecuritySeeder.');
            return;
        }
        
        $actions = ['login', 'logout', 'create', 'update', 'delete', 'view', 'export'];
        $severities = ['low', 'medium', 'high', 'critical'];
        $eventTypes = ['suspicious_login', 'multiple_failed_attempts', 'unauthorized_access', 'suspicious_activity'];
        $statuses = ['success', 'failed', 'blocked'];
        $failureReasons = ['wrong_password', 'user_not_found', 'account_locked', 'too_many_attempts'];

        // Create audit logs
        for ($i = 0; $i < 100; $i++) {
            $user = $users->random();
            $action = $actions[array_rand($actions)];
            $severity = $severities[array_rand($severities)];
            
            AuditLog::create([
                'user_id' => $user->id,
                'action' => $action,
                'model_type' => $action === 'login' || $action === 'logout' ? null : 'User',
                'model_id' => $action === 'login' || $action === 'logout' ? null : $user->id,
                'description' => $this->getActionDescription($action, $user),
                'ip_address' => $this->generateRandomIP(),
                'user_agent' => $this->generateRandomUserAgent(),
                'session_id' => 'session_' . rand(100000, 999999),
                'severity' => $severity,
                'metadata' => ['browser' => 'Chrome', 'os' => 'Windows'],
                'created_at' => now()->subDays(rand(0, 30))->subHours(rand(0, 23)),
            ]);
        }

        // Create login attempts
        for ($i = 0; $i < 150; $i++) {
            $user = $users->random();
            $status = $statuses[array_rand($statuses)];
            $failureReason = $status === 'failed' ? $failureReasons[array_rand($failureReasons)] : null;
            
            LoginAttempt::create([
                'email' => $user->email,
                'ip_address' => $this->generateRandomIP(),
                'user_agent' => $this->generateRandomUserAgent(),
                'status' => $status,
                'failure_reason' => $failureReason,
                'user_id' => $status === 'success' ? $user->id : null,
                'attempted_at' => now()->subDays(rand(0, 30))->subHours(rand(0, 23)),
            ]);
        }

        // Create security events
        for ($i = 0; $i < 25; $i++) {
            $user = $users->random();
            $eventType = $eventTypes[array_rand($eventTypes)];
            $severity = $severities[array_rand($severities)];
            $status = ['new', 'investigating', 'resolved', 'false_positive'][array_rand(['new', 'investigating', 'resolved', 'false_positive'])];
            
            $event = SecurityEvent::create([
                'user_id' => $user->id,
                'event_type' => $eventType,
                'severity' => $severity,
                'description' => $this->getEventDescription($eventType, $user),
                'ip_address' => $this->generateRandomIP(),
                'user_agent' => $this->generateRandomUserAgent(),
                'event_data' => ['attempts' => rand(1, 10), 'location' => 'Pakistan'],
                'status' => $status,
                'resolution_notes' => $status === 'resolved' ? 'Issue resolved by security team' : null,
                'resolved_by' => $status === 'resolved' ? 1 : null,
                'resolved_at' => $status === 'resolved' ? now()->subDays(rand(0, 10)) : null,
                'created_at' => now()->subDays(rand(0, 30))->subHours(rand(0, 23)),
            ]);
        }
    }

    private function getActionDescription($action, $user)
    {
        return match($action) {
            'login' => "User {$user->name} logged in successfully",
            'logout' => "User {$user->name} logged out",
            'create' => "User {$user->name} created a new record",
            'update' => "User {$user->name} updated a record",
            'delete' => "User {$user->name} deleted a record",
            'view' => "User {$user->name} viewed records",
            'export' => "User {$user->name} exported data",
            default => "User {$user->name} performed {$action} action",
        };
    }

    private function getEventDescription($eventType, $user)
    {
        return match($eventType) {
            'suspicious_login' => "Suspicious login attempt detected for user {$user->name}",
            'multiple_failed_attempts' => "Multiple failed login attempts detected for user {$user->name}",
            'unauthorized_access' => "Unauthorized access attempt detected for user {$user->name}",
            'suspicious_activity' => "Suspicious activity detected for user {$user->name}",
            default => "Security event detected for user {$user->name}",
        };
    }

    private function generateRandomIP()
    {
        return rand(1, 255) . '.' . rand(1, 255) . '.' . rand(1, 255) . '.' . rand(1, 255);
    }

    private function generateRandomUserAgent()
    {
        $userAgents = [
            'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36',
            'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36',
            'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0',
            'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15',
        ];
        
        return $userAgents[array_rand($userAgents)];
    }
}
