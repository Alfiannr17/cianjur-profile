<?php

namespace App\Filament\Resources\Destinations\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Schema;

class DestinationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                TextInput::make('category')
                    ->required(),
                Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('address')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('latitude')
                    ->numeric(),
                TextInput::make('longitude')
                    ->numeric(),
                TextInput::make('kode_desa'),
                TextInput::make('kode_kecamatan'),
                TextInput::make('ticket_price')
                    ->required()
                    ->numeric()
                    ->default(0.0)
                    ->prefix('$'),
                TimePicker::make('open_time'),
                TimePicker::make('close_time'),
                Select::make('status')
                    ->options(['active' => 'Active', 'inactive' => 'Inactive', 'renovation' => 'Renovation'])
                    ->default('active')
                    ->required(),
            ]);
    }
}
