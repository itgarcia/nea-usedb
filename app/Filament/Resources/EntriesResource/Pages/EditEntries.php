<?php

namespace App\Filament\Resources\EntriesResource\Pages;

use App\Filament\Resources\EntriesResource;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Auth;

class EditEntries extends EditRecord
{
    protected static string $resource = EntriesResource::class;

    protected function getActions(): array
    {
        return [
           
            ];
        }
        protected function getRedirectUrl(): string
        {
            return $this->getResource()::getUrl('index');
        }
      
    }
