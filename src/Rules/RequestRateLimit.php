<?php

namespace GroceryStore\PreOrderManagement\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Cache;

class RequestRateLimit implements Rule
{
    protected $maxRequests = 10;
    protected $timePeriod = 1;
    protected $cacheKey;

    public function __construct()
    {
        $this->cacheKey = 'rate_limit_submit_form';
    }
    public function passes($attribute, $value): bool
    {
        $requestCount = Cache::get($this->cacheKey, 0);
        if ($requestCount >= $this->maxRequests) {
            return false;
        }
        Cache::put($this->cacheKey, $requestCount + 1, now()->addMinutes($this->timePeriod));
        return true;
    }

    public function message(): string
    {
        return 'Form submited limit expire. Please try again later.';
    }
}
