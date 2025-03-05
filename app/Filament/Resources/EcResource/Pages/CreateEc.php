<?php

namespace App\Filament\Resources\EcResource\Pages;

use App\Filament\Resources\EcResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEc extends CreateRecord
{
    protected static string $resource = EcResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'EC Successfully Registered!';
    }
}
