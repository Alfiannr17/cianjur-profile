<?php

namespace App\Filament\Resources\Galleries; // Disesuaikan dengan path error Anda

use App\Filament\Resources\Galleries\Pages; // Sesuaikan namespace Pages
use App\Models\Gallery;
use Filament\Resources\Resource;
use Filament\Schemas\Schema; // <--- PERBAIKAN UTAMA: Gunakan Schema, bukan Form
use Filament\Forms\Components\FileUpload; 
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Support\Icons\Heroicon; 
use BackedEnum;

class GalleryResource extends Resource
{
    protected static ?string $model = Gallery::class;

    public static function canGloballySearch(): bool
    {
        return false;
    }

    // Pastikan tipe data icon sesuai dengan standar resource Anda
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-photo';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([ // Method schema() digunakan untuk mendefinisikan komponen
                
                // 1. Title
                TextInput::make('title')
                    ->label('Judul Galeri')
                    ->required()
                    ->maxLength(255),

                // 2. Type
                Select::make('type')
                    ->label('Tipe Media')
                    ->options([
                        'image' => 'Image',
                        'video' => 'Video',
                    ])
                    ->default('image')
                    ->required(),

                // 3. Upload File
                FileUpload::make('file_path')
                    ->label('File Gambar')
                    ->image()
                    ->directory('galleries')
                    ->disk('public')
                    ->columnSpan('full') // Ubah columnSpanFull() jadi columnSpan('full') untuk kompatibilitas
                    ->required(),

                // 4. Category
                TextInput::make('category')
                    ->label('Kategori')
                    ->placeholder('Contoh: Alam, Budaya')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->sortable()
                    ->searchable(),
                
                Tables\Columns\TextColumn::make('type'),

                // Menampilkan gambar di tabel
                Tables\Columns\ImageColumn::make('file_path')
                    ->label('Preview')
                    ->disk('public'), 

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                //
            ])
            ->bulkActions([
                //
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
        // Pastikan namespace Pages di atas sudah benar
        return [
            'index' => Pages\ListGalleries::route('/'),
            'create' => Pages\CreateGallery::route('/create'),
            'edit' => Pages\EditGallery::route('/{record}/edit'),
        ];
    }
}