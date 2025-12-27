<?php

namespace App\Filament\Resources\Galleries\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class GalleryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                Select::make('type')
                    ->options(['photo' => 'Photo', 'video' => 'Video'])
                    ->required(),
                TextInput::make('file_path')
                    ->required(),
                TextInput::make('category'),
            ]);
    }
}
