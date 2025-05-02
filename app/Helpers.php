<?php

use Carbon\Carbon;
use Joaopaulolndev\FilamentGeneralSettings\Models\GeneralSetting;

if (! function_exists('carbon')) {
    function carbon(string $date): Carbon
    {
        if (blank($date)) {
            return now();
        }
        return Carbon::parse($date);
    }
}

if (! function_exists('general_setting')) {
// Suggested code may be subject to a license. Learn more: ~LicenseLog:2855873029.
    function general_setting(string $key, string | array $default = ''): string | array
    {
        return GeneralSetting::query()->first()->{$key} ?? $default;
    }
}


if (! function_exists('avatar_path')) {
    function avatar_path($user): string
    {
        return filled($user?->avatar) ? storage_url($user?->avatar) : asset('assets/avatar/user.png');
    }
}
