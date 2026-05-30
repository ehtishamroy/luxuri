<?php

namespace App\Filament\Resources\Villas\Tables;

use App\Models\Destination;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;

class VillasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('first_image')
                    ->label('Image')
                    ->circular()
                    ->defaultImageUrl(fn () => 'https://via.placeholder.com/40?text=No+Image')
                    ->size(40),

                TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->wrap(),

                TextColumn::make('destination.name')
                    ->label('Destination')
                    ->placeholder('—')
                    ->sortable(),

                TextColumn::make('price_per_night')
                    ->label('Price/Night')
                    ->money('USD')
                    ->placeholder('Contact Us')
                    ->sortable()
                    ->alignEnd(),

                TextColumn::make('bedrooms')
                    ->label('Beds / Baths / Guests')
                    ->formatStateUsing(fn ($record) => "{$record->bedrooms} / {$record->bathrooms} / {$record->max_guests}")
                    ->alignCenter(),

                ToggleColumn::make('featured')
                    ->label('Featured')
                    ->alignCenter(),

                ToggleColumn::make('active')
                    ->label('Active')
                    ->alignCenter(),

                TextColumn::make('updated_at')
                    ->label('Updated')
                    ->since()
                    ->sortable(),
            ])
            ->filters([
                TernaryFilter::make('active')
                    ->label('Status')
                    ->placeholder('All')
                    ->trueLabel('Active')
                    ->falseLabel('Inactive'),

                TernaryFilter::make('featured')
                    ->label('Featured')
                    ->placeholder('All')
                    ->trueLabel('Featured')
                    ->falseLabel('Not Featured'),

                SelectFilter::make('destination_id')
                    ->label('Destination')
                    ->options(Destination::pluck('name', 'id'))
                    ->searchable(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('updated_at', 'desc');
    }
}
