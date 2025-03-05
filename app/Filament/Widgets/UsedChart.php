<?php

namespace App\Filament\Widgets;

use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;
use App\Models\Database;
use Illuminate\Support\Facades\Auth;

class UsedChart extends ApexChartWidget
{
    protected static ?int $sort = 1;
    /**
     * Chart Id
     *
     * @var string
     */
    protected static string $chartId = 'usedChart';

    /**
     * Widget Title
     *
     * @var string|null
     */
    
    protected static ?string $heading = 'No. of Sitios';

    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     *
     * @return array
     */
    protected function getOptions(): array
    {
        $luzon = Database::all()->where('island', '==', 'Luzon')->count();
        $visayas = Database::all()->where('island', '==', 'Visayas')->count();
        $mindanao = Database::all()->where('island', '==', 'Mindanao')->count();

        return [
            'chart' => [
                'type' => 'bar',
                'height' => 300,
            ],
            'series' => [
                [
                    'name' => 'Count',
                    'data' => [$luzon, $visayas, $mindanao],
              
                ],
            ],
            'xaxis' => [
                'categories' => ['Luzon', 'Visayas', 'Mindanao'],
                'labels' => [
                    'style' => [
                        'colors' => '#9ca3af',
                        'fontWeight' => 600,
                    ],
                ],
            ],
            'yaxis' => [
                'labels' => [
                    'style' => [
                        'colors' => '#9ca3af',
                        'fontWeight' => 600,
                    ],
                ],
            ],
            'colors' => ['#F44336', '#E91E63', '#9C27B0'],
            'plotOptions' => [
                'bar' => [
                    'borderRadius' => 3,
                    'horizontal' => false,
                    'distributed' => true,
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
