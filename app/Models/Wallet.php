<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Wallet extends Model
{
    protected $fillable = [
        'user_id',
        'balance',
        'pending_balance',
        'total_earnings',
        'total_spent',
        'status',
        'currency',
    ];

    protected $casts = [
        'balance' => 'decimal:2',
        'pending_balance' => 'decimal:2',
        'total_earnings' => 'decimal:2',
        'total_spent' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    // Add money to wallet
    public function addMoney(float $amount, string $description = null): Transaction
    {
        $this->increment('balance', $amount);
        $this->increment('total_earnings', $amount);

        return Transaction::create([
            'transaction_id' => Transaction::generateTransactionId(),
            'user_id' => $this->user_id,
            'wallet_id' => $this->id,
            'type' => 'wallet_topup',
            'status' => 'completed',
            'amount' => $amount,
            'net_amount' => $amount,
            'description' => $description ?? 'Wallet top-up',
            'processed_at' => now(),
        ]);
    }

    // Deduct money from wallet
    public function deductMoney(float $amount, string $description = null): Transaction
    {
        if ($this->balance < $amount) {
            throw new \Exception('Insufficient wallet balance');
        }

        $this->decrement('balance', $amount);
        $this->increment('total_spent', $amount);

        return Transaction::create([
            'transaction_id' => Transaction::generateTransactionId(),
            'user_id' => $this->user_id,
            'wallet_id' => $this->id,
            'type' => 'wallet_withdrawal',
            'status' => 'completed',
            'amount' => $amount,
            'net_amount' => $amount,
            'description' => $description ?? 'Wallet deduction',
            'processed_at' => now(),
        ]);
    }

    // Check if wallet has sufficient balance
    public function hasSufficientBalance(float $amount): bool
    {
        return $this->balance >= $amount;
    }

    // Get available balance (balance - pending)
    public function getAvailableBalance(): float
    {
        return $this->balance - $this->pending_balance;
    }
}
