<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EntriesResource\Pages;
use App\Filament\Resources\EntriesResource\RelationManagers;
use App\Models\Entries;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Select;
use BladeUI\Icons\Components\Icon;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use App\Http\Controllers\downloadController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class EntriesResource extends Resource
{
    protected static ?string $model = Entries::class;

    protected static ?string $title = 'Data Entry';

    protected static ?string $navigationGroup = 'Database';
    protected static ?string $navigationLabel = 'Data Entry';
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?int $navigationSort = 1;


    public static function form(Form $form): Form
    {
        $user = Auth::user();
        $office = $user->office;
        return $form
        ->schema([
            Card::make()->schema([
                TextInput::make('ec_name')
                ->label('EC Name')->default($user->office)->extraInputAttributes(['readonly' => true]),
                TextInput::make('created_by')
                ->label('User Account')->default($user->name)->extraInputAttributes(['readonly' => true]),
                TextInput::make('reporting_month')
                ->type('date')
                ->default(now()->toDateString())
                ->label('Date Submitted')
                ->required()->extraInputAttributes(['readonly' => true]),
                Select::make('status')
                ->options([
                    'Pending' => 'Pending',
                    'Approved' => 'Approved',
                ])->label('Status')->default('Pending')
                ->disabled($office <> 'NEA'),
                FileUpload::make('upload')
                ->disabled($office == 'NEA')
                ->preserveFilenames()
                ->minSize(1)
                ->maxSize(5024)
                ->required(),
            ])->columns(2)
       
        ]);
    }

    public static function table(Table $table): Table
    {

        return $table
        ->columns([
            Tables\Columns\TextColumn::make('ec_name')->sortable()->label('EC Name'),
            Tables\Columns\TextColumn::make('created_by')->sortable()->label('Created_By'),
            Tables\Columns\TextColumn::make('reporting_month')->sortable()->date('m-d-Y')->size('sm')->label('Reporting Month'),
            Tables\Columns\TextColumn::make('status')->sortable()->searchable()->label('Submission Status'),
            Tables\Columns\BadgeColumn::make('status')
            ->colors([
                'success' => 'Approved',
                'warning' => 'Pending',
            ]),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                ->color('warning')
                ->icon('heroicon-s-pencil')
                ->button(),
                Action::make('download')
                ->color('success')
                ->icon('heroicon-s-download')
                ->button()
                ->url(fn (Entries $record): string => route('download', ['id' => $record]), shouldOpenInNewTab: true),
            ])
            ->bulkActions([
               
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
            'index' => Pages\ListEntries::route('/'),
            'create' => Pages\CreateEntries::route('/create'),
            'edit' => Pages\EditEntries::route('/{record}/edit'),
        ];
    }    

    public static function getEloquentQuery(): Builder
    {
        $user = Auth::user();
        $office = $user->office;

        if ($office == 'NEA'){
            return parent::getEloquentQuery()->where('ec_name','!=', 'Admin');
        }
        else{
            return parent::getEloquentQuery()->where('ec_name','=', $office);
        }
        
    }
}
