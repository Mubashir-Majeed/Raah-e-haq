<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReferralRewardResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'reward_type' => $this->reward_type,
            'amount' => $this->amount,
            'level' => $this->level,
            'description' => $this->description,
            'credited_at' => $this->credited_at,
            'expires_at' => $this->expires_at,
            'referral_id' => $this->referral_id,
            'created_at' => $this->created_at,
        ];
    }
}
