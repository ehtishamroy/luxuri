<?php

namespace App\Filament\Resources\MagazinePosts\Pages;

use App\Filament\Resources\MagazinePosts\MagazinePostResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMagazinePosts extends ListRecords
{
    protected static string $resource = MagazinePostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
