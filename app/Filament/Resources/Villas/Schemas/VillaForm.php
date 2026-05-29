<?php

namespace App\Filament\Resources\Villas\Schemas;

use App\Models\Destination;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class VillaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(2)
                    ->schema([
                        Section::make('Details')
                            ->schema([
                                Select::make('destination_id')
                                    ->label('Destination')
                                    ->options(Destination::query()->orderBy('name')->pluck('name', 'id'))
                                    ->searchable()
                                    ->nullable(),
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
                                TextInput::make('price_per_night')
                                    ->label('Price per night')
                                    ->numeric()
                                    ->prefix('$')
                                    ->nullable(),
                                TextInput::make('bedrooms')
                                    ->numeric()
                                    ->minValue(0),
                                TextInput::make('bathrooms')
                                    ->numeric()
                                    ->minValue(0),
                                TextInput::make('max_guests')
                                    ->label('Max guests')
                                    ->numeric()
                                    ->minValue(1),
                                TextInput::make('location')
                                    ->maxLength(255),
                                TextInput::make('address')
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
                                    ->directory('villas')
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
