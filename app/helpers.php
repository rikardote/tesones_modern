<?php

use App\Services\FlashService;
use Carbon\Carbon;

if (!function_exists('fecha_ymd')) {
    function fecha_ymd(?string $date): ?string
    {
        if (!$date) {
            return null;
        }

        return date('Y-m-d', strtotime(str_replace('/', '-', $date)));
    }
}

if (!function_exists('fecha_dmy')) {
    function fecha_dmy(?string $date): ?string
    {
        if (!$date) {
            return null;
        }

        return date('d/m/Y', strtotime(str_replace('/', '-', $date)));
    }
}

if (!function_exists('getMonth')) {
    function getMonth(string|Carbon|\DateTime $date): string
    {
        if (empty($date)) return '';
        $dt = $date instanceof Carbon ? $date : Carbon::parse($date);
        $months = [
            1 => 'ENERO', 2 => 'FEBRERO', 3 => 'MARZO',
            4 => 'ABRIL', 5 => 'MAYO', 6 => 'JUNIO',
            7 => 'JULIO', 8 => 'AGOSTO', 9 => 'SEPTIEMBRE',
            10 => 'OCTUBRE', 11 => 'NOVIEMBRE', 12 => 'DICIEMBRE',
        ];

        return $months[$dt->month] ?? '';
    }
}

if (!function_exists('getDay')) {
    function getDay(string|Carbon|\DateTime $date): int
    {
        return $date instanceof Carbon ? $date->day : Carbon::parse($date)->day;
    }
}

if (!function_exists('getYear')) {
    function getYear(string|Carbon|\DateTime $date): int
    {
        return $date instanceof Carbon ? $date->year : Carbon::parse($date)->year;
    }
}

if (!function_exists('flash')) {
    function flash(?string $message = null): FlashService
    {
        $flash = app(FlashService::class);

        if ($message) {
            $flash->info($message);
        }

        return $flash;
    }
}
