<?php

namespace App\Filament\Widgets;

use App\Models\Complaint;
use App\Models\Destination;
use App\Models\Gallery;
use App\Models\Post;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';
    protected ?string $pollingInterval = '15s'; 

    protected function getStats(): array
    {
        return [
         
            Stat::make('Total Berita', Post::count())
                ->description('Artikel yang telah diterbitkan')
                ->descriptionIcon('heroicon-m-newspaper')
                ->color('success')
                ->chart([7, 2, 10, 3, 15, 4, 17]),

            Stat::make('Destinasi Wisata', Destination::count())
                ->description('Lokasi wisata terdaftar')
                ->descriptionIcon('heroicon-m-map-pin')
                ->color('primary'),

            Stat::make('Total Foto', Gallery::count())
                ->description('Foto dalam galeri')
                ->descriptionIcon('heroicon-m-photo')
                ->color('warning'),

            Stat::make('Pengaduan Masuk', Complaint::where('status', 'pending')->count())
                ->description('Menunggu respon')
                ->descriptionIcon('heroicon-m-bell-alert')
                ->color('danger'),
        ];
    }
}