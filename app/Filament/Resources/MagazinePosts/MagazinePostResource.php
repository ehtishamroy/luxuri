<?php

namespace App\Filament\Resources\MagazinePosts;

use App\Filament\Resources\MagazinePosts\Pages\CreateMagazinePost;
use App\Filament\Resources\MagazinePosts\Pages\EditMagazinePost;
use App\Filament\Resources\MagazinePosts\Pages\ListMagazinePosts;
use App\Filament\Resources\MagazinePosts\Pages\ViewMagazinePost;
use App\Filament\Resources\MagazinePosts\Schemas\MagazinePostForm;
use App\Filament\Resources\MagazinePosts\Schemas\MagazinePostInfolist;
use App\Filament\Resources\MagazinePosts\Tables\MagazinePostsTable;
use App\Models\MagazinePost;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class MagazinePostResource extends Resource
{
    protected static ?string $model = MagazinePost::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedNewspaper;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return MagazinePostForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return MagazinePostInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MagazinePostsTable::configure($table);
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
            'index' => ListMagazinePosts::route('/'),
            'create' => CreateMagazinePost::route('/create'),
            'view' => ViewMagazinePost::route('/{record}'),
            'edit' => EditMagazinePost::route('/{record}/edit'),
        ];
    }
}


