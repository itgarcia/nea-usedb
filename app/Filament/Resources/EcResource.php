<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EcResource\Pages;
use App\Filament\Resources\EcResource\RelationManagers;
use App\Models\Ec;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Card;

class EcResource extends Resource
{
    protected static ?string $model = Ec::class;

    protected static ?string $navigationGroup = 'Admin Management';
    protected static ?string $navigationLabel = 'Electric Cooperatives';
    protected static ?string $navigationIcon = 'heroicon-o-lightning-bolt';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Card::make()->schema([
            TextInput::make('name')
            ->label('Electric Cooperative')
            ->required()->autofocus(),

         
        ])->columns(2)
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
        ])
        ->filters([
            //
        ])
        ->actions([
            Tables\Actions\EditAction::make()
            ->color('warning')
            ->icon('heroicon-s-download')
            ->button(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ]);
    }
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEcs::route('/'),
            'create' => Pages\CreateEc::route('/create'),
            'edit' => Pages\EditEc::route('/{record}/edit'),
        ];
    }    
}
