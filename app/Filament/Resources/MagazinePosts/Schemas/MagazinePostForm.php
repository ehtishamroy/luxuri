<?php

namespace App\Filament\Resources\MagazinePosts\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class MagazinePostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(2)
                    ->schema([
                        Section::make('Content')
                            ->schema([
                                TextInput::make('title')
                                    ->label('Title')
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('slug')
                                    ->label('Slug')
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('category')
                                    ->label('Category')
                                    ->maxLength(255),
                                TextInput::make('author')
                                    ->label('Author')
                                    ->maxLength(255),
                                Textarea::make('excerpt')
                                    ->label('Excerpt')
                                    ->rows(3),
                                Textarea::make('content')
                                    ->label('Content')
                                    ->rows(8),
                            ]),

                        Section::make('Media & Publish')
                            ->schema([
                                FileUpload::make('featured_image')
                                    ->label('Featured image')
                                    ->image()
                                    ->disk('public')
                                    ->directory('magazine')
                                    ->maxSize(4096),
                                DateTimePicker::make('published_at')
                                    ->label('Published at')
                                    ->seconds(false)
                                    ->nullable(),
                                Toggle::make('active')
                                    ->label('Active')
                                    ->default(true),
                            ]),
                    ]),

                Section::make('SEO')
                    ->schema([
                        TextInput::make('meta_title')
                            ->label('Meta title')
                            ->maxLength(255)
                            ->columnSpanFull(),
                        Textarea::make('meta_description')
                            ->label('Meta description')
                            ->rows(3),
                    ]),
            ]);
    }
}
