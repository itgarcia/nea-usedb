<?php

namespace App\Filament\Resources\EntriesResource\Pages;

use App\Filament\Resources\EntriesResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;


class ListEntries extends ListRecords
{
    protected static string $resource = EntriesResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

  
}
