<?php

namespace App\Filament\Resources\Destinations\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class DestinationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(2)
                    ->schema([
                        Section::make('Details')
                            ->schema([
                                TextInput::make('name')
                                    ->label('Name')
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('slug')
                                    ->label('Slug')
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('country')
                                    ->label('Country')
                                    ->maxLength(255),
                                Textarea::make('description')
                                    ->label('Description')
                                    ->rows(4),
                            ]),

                        Section::make('Media')
                            ->schema([
                                FileUpload::make('hero_image')
                                    ->label('Hero image')
                                    ->image()
                                    ->disk('public')
                                    ->directory('destinations')
                                    ->maxSize(4096),
                                TextInput::make('hero_video')
                                    ->label('Hero video URL')
                                    ->url()
                                    ->nullable(),
                            ]),
                    ]),

                Section::make('SEO & Visibility')
                    ->schema([
                        Toggle::make('active')
                            ->label('Active')
                            ->default(true),
                        TextInput::make('sort_order')
                            ->label('Sort order')
                            ->numeric()
                            ->default(0),
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
