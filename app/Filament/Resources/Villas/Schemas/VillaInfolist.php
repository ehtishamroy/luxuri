<?php

namespace App\Filament\Resources\Villas\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class VillaInfolist
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
                        TextEntry::make('destination.name')
                            ->label('Destination')
                            ->placeholder('—'),
                        TextEntry::make('description')
                            ->placeholder('—')
                            ->columnSpanFull(),
                    ]),

                Section::make('Pricing & Capacity')
                    ->columns(4)
                    ->schema([
                        TextEntry::make('price_per_night')
                            ->money('USD')
                            ->placeholder('Contact Us'),
                        TextEntry::make('price_per_hour')
                            ->money('USD')
                            ->placeholder('—'),
                        TextEntry::make('bedrooms'),
                        TextEntry::make('bathrooms'),
                        TextEntry::make('max_guests'),
                    ]),

                Section::make('Fees')
                    ->collapsible()
                    ->visible(fn ($record) => !empty($record->fees))
                    ->schema([
                        TextEntry::make('fees')
                            ->label('Extra Fees')
                            ->formatStateUsing(function ($state) {
                                if (!is_array($state)) return '—';
                                return collect($state)->map(fn ($fee) => ($fee['name'] ?? 'Fee') . ': $' . number_format($fee['amount'] ?? 0, 2))->join(', ');
                            })
                            ->columnSpanFull(),
                    ]),

                Section::make('Location')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('location')
                            ->placeholder('—'),
                        TextEntry::make('address')
                            ->placeholder('—'),
                        TextEntry::make('latitude')
                            ->placeholder('—'),
                        TextEntry::make('longitude')
                            ->placeholder('—'),
                    ]),

                Section::make('Amenities')
                    ->collapsible()
                    ->visible(fn ($record) => $record->amenitiesList->isNotEmpty())
                    ->schema([
                        TextEntry::make('amenitiesList.name')
                            ->label('Amenities')
                            ->badge()
                            ->columnSpanFull(),
                    ]),

                Section::make('Policies & Contact')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('security_deposit_amount')
                            ->money('USD')
                            ->placeholder('—'),
                        TextEntry::make('policies_text')
                            ->placeholder('—')
                            ->columnSpanFull(),
                        TextEntry::make('contact_phone')
                            ->placeholder('—'),
                        TextEntry::make('contact_email')
                            ->placeholder('—'),
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
