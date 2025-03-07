<?php

namespace App\Filament\Resources\DatabaseResource\Pages;

use App\Filament\Resources\DatabaseResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDatabase extends EditRecord
{
    protected static string $resource = DatabaseResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    protected function getActions(): array
    {
        return [
            
        ];
    }
    
}
