<?php

namespace App\Filament\Resources\Yachts\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class YachtsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('first_image')
                    ->label('Image')
                    ->defaultImageUrl('/assets/media/placeholder-yacht.jpg')
                    ->size(60)
                    ->square(),

                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('make')
                    ->searchable()
                    ->sortable()
                    ->placeholder('—'),

                TextColumn::make('style')
                    ->searchable()
                    ->sortable()
                    ->placeholder('—'),

                TextColumn::make('length_ft')
                    ->label('Length')
                    ->suffix(' ft')
                    ->sortable()
                    ->placeholder('—'),

                TextColumn::make('cabins')
                    ->sortable(),

                TextColumn::make('max_guests')
                    ->label('Guests')
                    ->sortable(),

                TextColumn::make('price_per_day')
                    ->money('USD')
                    ->sortable()
                    ->placeholder('Contact Us'),

                TextColumn::make('price_per_hour')
                    ->money('USD')
                    ->sortable()
                    ->placeholder('—'),

                TextColumn::make('includes')
                    ->searchable()
                    ->placeholder('—')
                    ->limit(40)
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('location')
                    ->searchable()
                    ->sortable()
                    ->placeholder('—'),

                ToggleColumn::make('featured')
                    ->sortable(),

                ToggleColumn::make('active')
                    ->sortable(),

                TextColumn::make('updated_at')
                    ->dateTime('M j, Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Filter::make('active')
                    ->label('Active')
                    ->query(fn (Builder $query): Builder => $query->where('active', true)),

                Filter::make('featured')
                    ->label('Featured')
                    ->query(fn (Builder $query): Builder => $query->where('featured', true)),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
