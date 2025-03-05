<?php

namespace App\Filament\Resources\EcResource\Pages;

use App\Filament\Resources\EcResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEc extends EditRecord
{
    protected static string $resource = EcResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    protected function getSavedNotificationTitle(): ?string
    {
        return 'Successfully Updated!';
    }
}
