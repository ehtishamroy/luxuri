<?php

namespace App\Filament\Resources\Yachts;

use App\Filament\Resources\Yachts\Pages\CreateYacht;
use App\Filament\Resources\Yachts\Pages\EditYacht;
use App\Filament\Resources\Yachts\Pages\ListYachts;
use App\Filament\Resources\Yachts\Pages\ViewYacht;
use App\Filament\Resources\Yachts\Schemas\YachtForm;
use App\Filament\Resources\Yachts\Schemas\YachtInfolist;
use App\Filament\Resources\Yachts\Tables\YachtsTable;
use App\Models\Yacht;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class YachtResource extends Resource
{
    protected static ?string $model = Yacht::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBolt;

    protected static ?string $recordTitleAttribute = 'VillaResource';

    public static function form(Schema $schema): Schema
    {
        return YachtForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return YachtInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return YachtsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListYachts::route('/'),
            'create' => CreateYacht::route('/create'),
            'view' => ViewYacht::route('/{record}'),
            'edit' => EditYacht::route('/{record}/edit'),
        ];
    }
}


