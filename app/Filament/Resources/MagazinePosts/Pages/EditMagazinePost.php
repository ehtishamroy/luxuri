<?php

namespace App\Filament\Resources\MagazinePosts\Pages;

use App\Filament\Resources\MagazinePosts\MagazinePostResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditMagazinePost extends EditRecord
{
    protected static string $resource = MagazinePostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
