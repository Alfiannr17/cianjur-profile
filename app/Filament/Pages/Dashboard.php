<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    
    public function getColumns(): int | array
    {
        return 1; // 1 Kolom agar semua widget memanjang penuh (full width)
    }
}