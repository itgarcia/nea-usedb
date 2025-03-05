<?php

namespace App\Filament\Resources\EcResource\Pages;

use App\Filament\Resources\EcResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEcs extends ListRecords
{
    protected static string $resource = EcResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Create'),
        ];
    }
}
