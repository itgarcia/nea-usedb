<?php

namespace App\Filament\Widgets;

use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;
use App\Models\Database;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class StatusChart extends ApexChartWidget
{
    /**
     * Chart Id
     *
     * @var string
     */
    protected static string $chartId = 'statusChart';

    /**
     * Widget Title
     *
     * @var string|null
     */
    protected static ?string $heading = 'Status of Energization';

    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     *
     * @return array
     */
    protected function getOptions(): array
    {
        $energ = Database::all()->where('status', '==', 'E')->count();
        $unenerg = Database::all()->where('status', '==', 'UE')->count();
        $complete = Database::all()->where('status', '==', 'C')->count();

        return [
            'chart' => [
                'type' => 'donut',
                'height' => 300,
                
            ],
            'series' => [$energ, $unenerg, $complete],
            'colors' => ['#00fa9a', '#ff4f61', '#2acaea'],
            'labels' => ['Energized', 'Unergized', 'Completed'],
            'legend' => [
                'labels' => [
                    'colors' => '#9ca3af',
                    'fontWeight' => 600,
                ],
            ],
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
