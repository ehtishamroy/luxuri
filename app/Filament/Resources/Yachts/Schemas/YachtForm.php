<?php

namespace App\Filament\Resources\Yachts\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class YachtForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(2)
                    ->schema([
                        Section::make('Details')
                            ->schema([
                                TextInput::make('title')
                                    ->label('Title')
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('slug')
                                    ->label('Slug')
                                    ->required()
                                    ->maxLength(255),
                                Textarea::make('description')
                                    ->label('Description')
                                    ->rows(4),
                                TextInput::make('make')
                                    ->label('Make')
                                    ->maxLength(255),
                                TextInput::make('style')
                                    ->label('Style')
                                    ->maxLength(255),
                                TextInput::make('length_ft')
                                    ->label('Length (ft)')
                                    ->numeric()
                                    ->minValue(0),
                                TextInput::make('cabins')
                                    ->numeric()
                                    ->minValue(0),
                                TextInput::make('max_guests')
                                    ->label('Max guests')
                                    ->numeric()
                                    ->minValue(1),
                                TextInput::make('price_per_day')
                                    ->label('Price per day')
                                    ->numeric()
                                    ->prefix('$')
                                    ->nullable(),
                                TextInput::make('location')
                                    ->maxLength(255),
                            ]),

                        Section::make('Media')
                            ->schema([
                                FileUpload::make('images')
                                    ->label('Images')
                                    ->image()
                                    ->multiple()
                                    ->reorderable()
                                    ->disk('public')
                                    ->directory('yachts')
                                    ->maxSize(4096),
                            ]),
                    ]),

                Section::make('SEO & Visibility')
                    ->schema([
                        Toggle::make('featured')
                            ->label('Featured')
                            ->default(false),
                        Toggle::make('active')
                            ->label('Active')
                            ->default(true),
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
