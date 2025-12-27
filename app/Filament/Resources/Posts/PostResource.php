<?php

namespace App\Filament\Resources\Posts;

use App\Filament\Resources\Posts\Pages\CreatePost;
use App\Filament\Resources\Posts\Pages\EditPost;
use App\Filament\Resources\Posts\Pages\ListPosts;
use App\Filament\Resources\Posts\Tables\PostsTable;
use App\Models\Post;
use BackedEnum; // <--- WAJIB IMPORT INI DI V3/V4
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;

use Filament\Resources\Resource;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Schemas\Schema; // v4 Schema
use Filament\Schemas\Components\Utilities\Set; // Fix untuk slug

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationLabel = 'Berita & Artikel';

    public static function canGloballySearch(): bool
    {
        return false;
    }

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                // 1. JUDUL
                TextInput::make('title')
                    ->label('Judul Artikel')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),

                // 2. SLUG
                TextInput::make('slug')
                    ->required()
                    ->maxLength(255),

                // 3. KONTEN
                RichEditor::make('content')
                    ->label('Isi Artikel')
                    ->columnSpanFull(), 
                
                // 4. UPLOAD GAMBAR (PENGGANTI TEXT INPUT)
                FileUpload::make('thumbnail')
                    ->label('Gambar Thumbnail')
                    ->image()
                    ->directory('posts-thumbnails')
                    ->disk('public') // Pastikan storage:link sudah dijalankan
                    ->columnSpanFull(),

                // 5. KATEGORI
                TextInput::make('category')
                    ->label('Kategori'),

                // 6. TANGGAL
                DateTimePicker::make('published_at')
                    ->label('Tanggal Publish'),

                // 7. STATUS
                Select::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                    ])
                    ->default('draft')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return PostsTable::configure($table);
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
            'index' => ListPosts::route('/'),
            'create' => CreatePost::route('/create'),
            'edit' => EditPost::route('/{record}/edit'),
        ];
    }
}