<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReferralResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'referral_code' => $this->referral_code,
            'status' => $this->status,
            'level' => $this->level,
            'reward_amount' => $this->reward_amount,
            'bonus_amount' => $this->bonus_amount,
            'referrer' => new UserResource($this->whenLoaded('referrer')),
            'referred' => new UserResource($this->whenLoaded('referred')),
            'rewards' => ReferralRewardResource::collection($this->whenLoaded('rewards')),
            'completed_at' => $this->completed_at,
            'created_at' => $this->created_at,
        ];
    }
}
