<?php

namespace App\Filament\Resources\MenuItems\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class MenuItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Menu Item Details')
                    ->schema([
                        TextInput::make('label')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('url')
                            ->required()
                            ->url()
                            ->maxLength(255),

                        Select::make('target')
                            ->options([
                                '_self' => 'Same window (_self)',
                                '_blank' => 'New tab (_blank)',
                            ])
                            ->default('_self')
                            ->required(),

                        TextInput::make('sort_order')
                            ->numeric()
                            ->default(0)
                            ->required(),

                        Toggle::make('active')
                            ->default(true),
                    ])
                    ->columns(2),
            ]);
    }
}
