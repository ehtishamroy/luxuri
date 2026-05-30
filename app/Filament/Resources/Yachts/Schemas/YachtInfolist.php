<?php

namespace App\Filament\Resources\Yachts\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class YachtInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Gallery')
                    ->collapsible()
                    ->schema([
                        ImageEntry::make('image_urls')
                            ->label('Images')
                            ->size(120)
                            ->columnSpanFull(),
                    ]),

                Section::make('Basic Information')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('title'),
                        TextEntry::make('slug'),
                        TextEntry::make('make')
                            ->placeholder('—'),
                        TextEntry::make('style')
                            ->placeholder('—'),
                        TextEntry::make('description')
                            ->placeholder('—')
                            ->columnSpanFull(),
                    ]),

                Section::make('Specifications & Pricing')
                    ->columns(4)
                    ->schema([
                        TextEntry::make('length_ft')
                            ->label('Length (ft)')
                            ->placeholder('—'),
                        TextEntry::make('cabins'),
                        TextEntry::make('max_guests'),
                        TextEntry::make('price_per_day')
                            ->money('USD')
                            ->placeholder('Contact Us'),
                        TextEntry::make('price_per_hour')
                            ->money('USD')
                            ->placeholder('—'),
                        TextEntry::make('charter_4h_price')
                            ->money('USD')
                            ->label('4 Hour Charter')
                            ->placeholder('—'),
                        TextEntry::make('charter_6h_price')
                            ->money('USD')
                            ->label('6 Hour Charter')
                            ->placeholder('—'),
                        TextEntry::make('charter_8h_price')
                            ->money('USD')
                            ->label('8 Hour Charter')
                            ->placeholder('—'),
                    ]),

                Section::make('Includes & Services')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('includes')
                            ->placeholder('—')
                            ->columnSpanFull(),
                        TextEntry::make('crew_included')
                            ->icon(fn (string $state): string => $state === '1' ? 'heroicon-o-check-circle' : 'heroicon-o-x-circle')
                            ->color(fn (string $state): string => $state === '1' ? 'success' : 'danger'),
                        TextEntry::make('catering_available')
                            ->icon(fn (string $state): string => $state === '1' ? 'heroicon-o-check-circle' : 'heroicon-o-x-circle')
                            ->color(fn (string $state): string => $state === '1' ? 'success' : 'danger'),
                    ]),

                Section::make('Location')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('location')
                            ->placeholder('—'),
                    ]),

                Section::make('Tags')
                    ->collapsible()
                    ->visible(fn ($record) => !empty($record->tags))
                    ->schema([
                        TextEntry::make('tags')
                            ->label('Tags')
                            ->badge()
                            ->columnSpanFull(),
                    ]),

                Section::make('Settings & SEO')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('featured')
                            ->icon(fn (string $state): string => $state === '1' ? 'heroicon-o-check-circle' : 'heroicon-o-x-circle')
                            ->color(fn (string $state): string => $state === '1' ? 'success' : 'danger'),
                        TextEntry::make('active')
                            ->icon(fn (string $state): string => $state === '1' ? 'heroicon-o-check-circle' : 'heroicon-o-x-circle')
                            ->color(fn (string $state): string => $state === '1' ? 'success' : 'danger'),
                        TextEntry::make('meta_title')
                            ->placeholder('—'),
                        TextEntry::make('meta_description')
                            ->placeholder('—'),
                    ]),
            ]);
    }
}
