<?php

namespace App\Filament\Resources\MagazinePosts\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class MagazinePostsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('featured_image')
                    ->label('Image')
                    ->defaultImageUrl(fn ($record) => $record->featured_image ?? '')
                    ->size(40)
                    ->circular(),

                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('category')
                    ->searchable()
                    ->sortable()
                    ->badge(),

                TextColumn::make('author')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('published_at')
                    ->date('M j, Y')
                    ->sortable(),

                ToggleColumn::make('active')
                    ->label('Active')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->dateTime('M j, Y g:i A')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Filter::make('active')
                    ->label('Active')
                    ->query(fn (Builder $query): Builder => $query->where('active', true)),

                Filter::make('inactive')
                    ->label('Inactive')
                    ->query(fn (Builder $query): Builder => $query->where('active', false)),

                Filter::make('published')
                    ->label('Published')
                    ->query(fn (Builder $query): Builder => $query->whereNotNull('published_at')->where('published_at', '<=', now())),
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
