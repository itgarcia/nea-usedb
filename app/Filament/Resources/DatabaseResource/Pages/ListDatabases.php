<?php

namespace App\Filament\Resources\DatabaseResource\Pages;

use App\Filament\Resources\DatabaseResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Konnco\FilamentImport\Actions\ImportAction;
use Konnco\FilamentImport\Actions\ImportField;
use Illuminate\Support\Facades\Auth;
use Filament\Resources\Pages\ListRecords\Tab;
use Illuminate\Database\Eloquent\Builder;


class ListDatabases extends ListRecords
{
    
    protected static string $resource = DatabaseResource::class;
    protected static ?string $title = 'USE Database';
    
   
    protected function getTableQuery(): Builder
{
     return parent::getTableQuery()->withoutGlobalScopes();
}

     
    protected function getActions(): array
    {
        $user = Auth::user();
        $office = $user->office;

        if ($office == 'NEA'){
            return [
            Actions\CreateAction::make()->label('New Sitio'),
            ImportAction::make()
            ->fields([
                ImportField::make('ec')
                    ->label('EC Name')
                    ->required(),
                ImportField::make('island')
                    ->label('Major Island'),
                ImportField::make('region')
                    ->label('Region'),
                ImportField::make('province')
                    ->label('Province'),
                ImportField::make('district')
                    ->label('District'),
                ImportField::make('citymun')
                    ->label('City/Municipality'),
                ImportField::make('brgy')
                    ->label('Barangay'),
                ImportField::make('sitio')
                    ->label('Sitio'),
                ImportField::make('status')
                    ->label('Status'),
                ImportField::make('energdate')
                    ->label('Date of Energization'),
                ImportField::make('brgycert')
                    ->label('with Barangay Certification?'),
                ImportField::make('epelecsol')
                    ->label('Electrification Solution'),
                ImportField::make('epelecsolspecific')
                    ->label('Electrification Solution-Specific'),
                ImportField::make('eptargetyear')
                    ->label('Target Year'),
                ImportField::make('eptotalhouse')
                    ->label('Total Household'),
                ImportField::make('frprojcost')
                    ->label('Project Cost'),
                ImportField::make('frgenfundsource')
                    ->label('General Funding Source'),
                ImportField::make('frfundsource')
                    ->label('Specific Funding Source'),
                ImportField::make('frfundstatus')
                    ->label('Funding Status'),
                ImportField::make('icpeaceorder')
                    ->label('Issues - Peace&Order'),
                ImportField::make('icrightway')
                    ->label('Issues - Right of Way'),
                ImportField::make('icnoroad')
                    ->label('Issues - No Road Network/ Inaccessible'),
                ImportField::make('icscathouse')
                    ->label('Issues - Scattered Households'),
                ImportField::make('icislandbrgymun')
                    ->label('Issues - Island Barangay/ Municipalty'),
                ImportField::make('icremote')
                    ->label('Issues - Remote and Far Flung Areas'),
                ImportField::make('icothers')
                    ->label('Issues - Others'),
                ImportField::make('remarks')
                    ->label('remarks'),
            ], columns:3)
        ];
            }
            else{
                return [];
            }        
    }
}
