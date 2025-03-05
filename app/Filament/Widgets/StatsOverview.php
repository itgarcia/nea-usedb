<?php

namespace App\Filament\Widgets;

use App\Models\Database;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 2;
    protected function getCards(): array
    {
        $year = date('Y');

        return [
            Card::make('Luzon - All', Database::all()->where('island', '==', 'Luzon')->count())
            ->description('as of this year ' .$year)
            ->descriptionIcon('heroicon-s-trending-up')
            ->chart([7, 2, 10, 3, 15, 4, 7])
            ->color('success'),
            Card::make('Visayas - All', Database::all()->where('island', '==', 'Visayas')->count())
            ->description('as of this year ' .$year)
            ->descriptionIcon('heroicon-s-trending-up')
            ->chart([7, 2, 10, 3, 15, 4, 7])
            ->color('warning'),
            Card::make('Mindanao - All', Database::all()->where('island', 'Mindanao')->count())
            ->description('as of this year ' .$year)
            ->descriptionIcon('heroicon-s-trending-up')
            ->chart([7, 2, 10, 3, 15, 4, 7])
            ->color('primary'),
            Card::make('Luzon - Energized', Database::all()->where('island', '==', 'Luzon')->where('status', 'E')->count())
            ->description('as of this year ' .$year)
            ->descriptionIcon('heroicon-s-trending-up')
            ->chart([7, 2, 10, 3, 15, 4, 7])
            ->color('success'),
            Card::make('Visayas - Energized', Database::all()->where('island', '==', 'Visayas')->where('status', 'E')->count())
            ->description('as of this year ' .$year)
            ->descriptionIcon('heroicon-s-trending-up')
            ->chart([7, 2, 10, 3, 15, 4, 7])
            ->color('success'),
            Card::make('Mindanao - Energized', Database::all()->where('island', 'Mindanao')->where('status', 'E')->count())
            ->description('as of this year ' .$year)
            ->descriptionIcon('heroicon-s-trending-up')
            ->chart([7, 2, 10, 3, 15, 4, 7])
            ->color('success'),
            Card::make('Luzon - Unenergized', Database::all()->where('island', '==', 'Luzon')->where('status', 'UE')->count())
            ->description('as of this year ' .$year)
            ->descriptionIcon('heroicon-s-trending-up')
            ->chart([7, 2, 10, 3, 15, 4, 7])
            ->color('danger'),
            Card::make('Visayas - Unenergized', Database::all()->where('island', '==', 'Visayas')->where('status', 'UE')->count())
            ->description('as of this year ' .$year)
            ->descriptionIcon('heroicon-s-trending-up')
            ->chart([7, 2, 10, 3, 15, 4, 7])
            ->color('danger'),
            Card::make('Mindanao - Unenergized', Database::all()->where('island', 'Mindanao')->where('status', 'UE')->count())
            ->description('as of this year ' .$year)
            ->descriptionIcon('heroicon-s-trending-up')
            ->chart([7, 2, 10, 3, 15, 4, 7])
            ->color('danger'),
      
         
        // ...
        ];
    }

    public static function canView(): bool
    {
        $user = Auth::user();
        $office = $user->office;

        if ($office == 'NEA'){
            return true;
        } else {
            return false;
        }
    }
   
}
