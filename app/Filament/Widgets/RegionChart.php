<?php

namespace App\Filament\Widgets;

use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;
use App\Models\Database;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Columns\TextColumn;


class RegionChart extends ApexChartWidget
{
    protected int | string | array $columnSpan = 'full';
 
  

    protected static ?int $sort = 1;
    /**
     * Chart Id
     *
     * @var string
     */
    protected static string $chartId = 'regionChart';

    /**
     * Widget Title
     *
     * @var string|null
     */
    protected static ?string $heading = 'Per Region Chart';

    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     *
     * @return array
     */
    protected function getOptions(): array
    {
        $r1 = Database::all()->where('region', '==', 'I')->count();
        $r2 = Database::all()->where('region', '==', 'II')->count();
        $r3 = Database::all()->where('region', '==', 'III')->count();
        $r4 = Database::all()->where('region', '==', 'IV')->count();
        $r5 = Database::all()->where('region', '==', 'V')->count();
        $r6 = Database::all()->where('region', '==', 'VI')->count();
        $r7 = Database::all()->where('region', '==', 'VII')->count();
        $r8 = Database::all()->where('region', '==', 'VIII')->count();
        $r9 = Database::all()->where('region', '==', 'IX')->count();
        $r10 = Database::all()->where('region', '==', 'X')->count();
        $r11 = Database::all()->where('region', '==', 'XI')->count();
        $r12 = Database::all()->where('region', '==', 'XII')->count();
        $rcar = Database::all()->where('region', '==', 'CAR')->count();
        $rbarmm = Database::all()->where('region', '==', 'BARMM')->count();
        $rcaraga = Database::all()->where('region', '==', 'CARAGA')->count();

        return [
            'chart' => [
                'type' => 'area',
                'height' => 300,
                
            ],
            'series' => [
                [
                    'name' => 'Count',
                    'data' => [$r1,$r2,$rcar,$r3,$r4,$r5,$r6,$r7,$r8,$r9,$r10,$r11,$r12,$rbarmm,$rcaraga],
                ],
            ],
            'xaxis' => [
                'categories' => ['I', 'II', 'CAR','III', 'IV', 'V', 'VI', 'VII', 'VII', 'IX', 'X', 'XI', 'XII','BARMM','CARAGA'],
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
            'colors' => ['#fcba03'],
            'stroke' => [
                'curve' => 'smooth',
            ],
            'dataLabels' => [
                'enabled' => false,
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
