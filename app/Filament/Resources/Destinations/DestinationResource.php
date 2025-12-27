<?php

namespace App\Filament\Resources\Destinations;

use App\Filament\Resources\Destinations\Pages;
use App\Models\Destination;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Schemas\Schema; // v4 Schema

// Import Komponen Input
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Components\Utilities\Set; // Fix untuk slug
use Illuminate\Support\Str;
use BackedEnum;

class DestinationResource extends Resource
{
    protected static ?string $model = Destination::class;

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-map-pin';

    protected static ?string $navigationLabel = 'Destinasi Wisata';

    protected static ?string $recordTitleAttribute = 'name';

    public static function canGloballySearch(): bool
    {
        return false;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Destinasi')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),

                TextInput::make('slug')->required()->unique(ignoreRecord: true),

                Select::make('category')
                    ->options(['Alam' => 'Alam', 'Sejarah' => 'Sejarah', 'Kuliner' => 'Kuliner'])
                    ->required(),

                Select::make('status')
                    ->options(['active' => 'Active', 'inactive' => 'Inactive'])
                    ->default('active')
                    ->required(),

                TextInput::make('ticket_price')->numeric()->default(0),

                TimePicker::make('open_time'),
                TimePicker::make('close_time'),

                Textarea::make('address')->required(),
                TextInput::make('latitude')->numeric()->nullable(),
                TextInput::make('longitude')->numeric()->nullable(),
                TextInput::make('kode_desa')->label('Desa')->required(),
                TextInput::make('kode_kecamatan')->label('Kecamatan')->required(),
                Textarea::make('description')->required(),

                Repeater::make('images')
                    ->relationship()
                    ->schema([
                        FileUpload::make('image_path')
                            ->image()
                            ->directory('destinations')
                            ->required(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('category')->badge(),
                Tables\Columns\TextColumn::make('ticket_price')->money('IDR'),
                Tables\Columns\TextColumn::make('status')->badge(),
            ])
            ->filters([])
            ->actions([]) 
            ->bulkActions([]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDestinations::route('/'),
            'create' => Pages\CreateDestination::route('/create'),
            'edit' => Pages\EditDestination::route('/{record}/edit'),
        ];
    }
}