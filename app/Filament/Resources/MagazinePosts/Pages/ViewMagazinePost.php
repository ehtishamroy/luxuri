<?php

namespace App\Filament\Resources\MagazinePosts\Pages;

use App\Filament\Resources\MagazinePosts\MagazinePostResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewMagazinePost extends ViewRecord
{
    protected static string $resource = MagazinePostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
