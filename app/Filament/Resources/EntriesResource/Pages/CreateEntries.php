<?php

namespace App\Filament\Resources\EntriesResource\Pages;

use App\Filament\Resources\EntriesResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEntries extends CreateRecord
{
    protected static string $resource = EntriesResource::class;
}
