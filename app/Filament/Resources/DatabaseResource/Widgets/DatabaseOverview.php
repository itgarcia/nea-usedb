<?php

namespace App\Filament\Resources\DatabaseResource\Widgets;

use Filament\Widgets\Widget;
use App\Models\Database;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class DatabaseOverview extends Widget
{
    protected static string $view = 'filament.resources.database-resource.widgets.database-overview';
    protected function getCards(): array
    {
        $year = date('Y');

        return [
            Card::make('Luzon', Database::where('island', '==', 'Luzon')->get())
            ->description('as of this year ' .$year)
            ->descriptionIcon('heroicon-s-trending-up')
            ->chart([7, 2, 10, 3, 15, 4, 7])
            ->color('success'),
      
         
        // ...
        ];
    }
}
