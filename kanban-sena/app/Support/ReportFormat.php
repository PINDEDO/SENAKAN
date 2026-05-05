<?php

namespace App\Support;

class ReportFormat
{
    public static function taskStatusLabel(string $status): string
    {
        return match ($status) {
            'done' => 'Completada',
            'progress' => 'En proceso',
            'pending' => 'Pendiente',
            default => $status,
        };
    }
}
