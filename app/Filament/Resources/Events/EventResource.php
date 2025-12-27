<?php

namespace App\Filament\Resources\Events;

use App\Filament\Resources\Events\Pages\CreateEvent;
use App\Filament\Resources\Events\Pages\EditEvent;
use App\Filament\Resources\Events\Pages\ListEvents;
use App\Models\Event;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;

// --- IMPORT SCHEMA (V4) ---
use Filament\Schemas\Schema;

// --- IMPORT KOMPONEN FORM ---
use Filament\Forms\Components\FileUpload; // <--- INI UTAMA (Untuk Upload Gambar)
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Utilities\Set; // Fix Slug V4
use Illuminate\Support\Str;

// --- IMPORT ACTION MANUAL ---
use Filament\Tables\Actions\Action;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-calendar';

    protected static ?string $navigationLabel = 'Event & Festival';

    protected static ?string $recordTitleAttribute = 'title';

    public static function canGloballySearch(): bool
    {
        return false;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                // 1. Title (Auto Slug)
                TextInput::make('title')
                    ->label('Judul Event')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),

                // 2. Slug
                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true),

                // 3. Poster (FILE UPLOAD - INI YANG KITA UBAH)
                FileUpload::make('poster')
                    ->label('Poster Event')
                    ->image() // Pastikan hanya gambar
                    ->directory('events') // Simpan di folder events
                    ->required()
                    ->columnSpanFull(),

                // 4. Deskripsi
                Textarea::make('description')
                    ->label('Deskripsi')
                    ->rows(4)
                    ->required()
                    ->columnSpanFull(),

                // 5. Tanggal Mulai & Selesai
                DateTimePicker::make('start_date')
                    ->label('Waktu Mulai')
                    ->required(),

                DateTimePicker::make('end_date')
                    ->label('Waktu Selesai')
                    ->required(),

                // 6. Lokasi
                TextInput::make('location')
                    ->label('Lokasi')
                    ->required()
                    ->columnSpanFull(),

                // 7. Status
                Select::make('status')
                    ->options([
                        'upcoming' => 'Akan Datang',
                        'ongoing' => 'Sedang Berlangsung',
                        'completed' => 'Selesai',
                        'cancelled' => 'Dibatalkan',
                    ])
                    ->default('upcoming')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->label('Nama Event'),

                Tables\Columns\ImageColumn::make('poster')
                    ->label('Poster'), // Menampilkan thumbnail poster di tabel

                Tables\Columns\TextColumn::make('start_date')
                    ->dateTime()
                    ->sortable()
                    ->label('Mulai'),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'upcoming' => 'info',
                        'ongoing' => 'success',
                        'completed' => 'gray',
                        'cancelled' => 'danger',
                        default => 'gray',
                    }),
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
        return [
            'index' => ListEvents::route('/'),
            'create' => CreateEvent::route('/create'),
            'edit' => EditEvent::route('/{record}/edit'),
        ];
    }
}