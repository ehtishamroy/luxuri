<?php

namespace App\Filament\Resources\MagazinePosts\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class MagazinePostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Post Details')
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),

                        TextInput::make('category')
                            ->maxLength(255)
                            ->nullable(),

                        TextInput::make('author')
                            ->maxLength(255)
                            ->nullable(),

                        DatePicker::make('published_at')
                            ->nullable(),

                        Toggle::make('active')
                            ->default(true),
                    ])
                    ->columns(2),

                Section::make('Content')
                    ->schema([
                        Textarea::make('excerpt')
                            ->rows(3)
                            ->nullable()
                            ->columnSpanFull(),

                        RichEditor::make('content')
                            ->nullable()
                            ->columnSpanFull(),
                    ]),

                Section::make('Media')
                    ->schema([
                        FileUpload::make('featured_image')
                            ->label('Featured Image')
                            ->image()
                            ->disk('public')
                            ->directory('magazine-images')
                            ->nullable()
                            ->columnSpanFull(),
                    ]),

                Section::make('SEO')
                    ->schema([
                        TextInput::make('meta_title')
                            ->maxLength(255)
                            ->nullable(),

                        Textarea::make('meta_description')
                            ->rows(2)
                            ->nullable()
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }
}
