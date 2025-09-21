<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Wallet;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Ride;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create wallets for all users
        $users = User::all();
        foreach ($users as $user) {
            Wallet::create([
                'user_id' => $user->id,
                'balance' => rand(0, 5000),
                'pending_balance' => rand(0, 500),
                'total_earnings' => rand(1000, 10000),
                'total_spent' => rand(500, 5000),
                'status' => 'active',
                'currency' => 'PKR',
            ]);
        }

        $rides = Ride::where('status', 'completed')->get();
        $paymentMethods = ['cash', 'card', 'wallet', 'jazzcash', 'easypaisa', 'sadapay'];
        $transactionTypes = ['ride_payment', 'wallet_topup', 'driver_earning', 'refund', 'commission'];
        $statuses = ['completed', 'pending', 'failed'];

        // Create transactions for completed rides
        foreach ($rides as $ride) {
            // Ride payment transaction
            Transaction::create([
                'transaction_id' => Transaction::generateTransactionId(),
                'user_id' => $ride->passenger_id,
                'ride_id' => $ride->id,
                'wallet_id' => $ride->passenger->wallet->id,
                'type' => 'ride_payment',
                'status' => 'completed',
                'amount' => $ride->total_fare,
                'fee' => $ride->total_fare * 0.05, // 5% fee
                'net_amount' => $ride->total_fare * 0.95,
                'currency' => 'PKR',
                'payment_method' => $paymentMethods[array_rand($paymentMethods)],
                'payment_reference' => 'REF-' . rand(100000, 999999),
                'description' => 'Payment for ride ' . $ride->ride_id,
                'processed_at' => $ride->completed_at,
            ]);

            // Driver earning transaction
            Transaction::create([
                'transaction_id' => Transaction::generateTransactionId(),
                'user_id' => $ride->driver_id,
                'ride_id' => $ride->id,
                'wallet_id' => $ride->driver->wallet->id,
                'type' => 'driver_earning',
                'status' => 'completed',
                'amount' => $ride->driver_earnings,
                'fee' => 0,
                'net_amount' => $ride->driver_earnings,
                'currency' => 'PKR',
                'payment_method' => 'wallet',
                'description' => 'Earning from ride ' . $ride->ride_id,
                'processed_at' => $ride->completed_at,
            ]);

            // Platform commission transaction
            Transaction::create([
                'transaction_id' => Transaction::generateTransactionId(),
                'user_id' => 1, // Admin user
                'ride_id' => $ride->id,
                'type' => 'commission',
                'status' => 'completed',
                'amount' => $ride->platform_commission,
                'fee' => 0,
                'net_amount' => $ride->platform_commission,
                'currency' => 'PKR',
                'payment_method' => 'wallet',
                'description' => 'Platform commission from ride ' . $ride->ride_id,
                'processed_at' => $ride->completed_at,
            ]);
        }

        // Create additional wallet top-up transactions
        $users = User::whereHas('roles', function($query) {
            $query->where('name', 'passenger');
        })->get();

        foreach ($users as $user) {
            $topupCount = rand(2, 5);
            for ($i = 0; $i < $topupCount; $i++) {
                $amount = rand(500, 2000);
                Transaction::create([
                    'transaction_id' => Transaction::generateTransactionId(),
                    'user_id' => $user->id,
                    'wallet_id' => $user->wallet->id,
                    'type' => 'wallet_topup',
                    'status' => $statuses[array_rand($statuses)],
                    'amount' => $amount,
                    'fee' => $amount * 0.02, // 2% fee
                    'net_amount' => $amount * 0.98,
                    'currency' => 'PKR',
                    'payment_method' => $paymentMethods[array_rand($paymentMethods)],
                    'payment_reference' => 'TOPUP-' . rand(100000, 999999),
                    'gateway_transaction_id' => 'GW-' . rand(100000000, 999999999),
                    'description' => 'Wallet top-up',
                    'processed_at' => now()->subDays(rand(1, 30))->subHours(rand(0, 23)),
                ]);
            }
        }
    }
}
