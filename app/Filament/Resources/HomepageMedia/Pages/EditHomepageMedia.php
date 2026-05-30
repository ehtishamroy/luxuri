<?php

namespace App\Filament\Resources\HomepageMedia\Pages;

use App\Filament\Resources\HomepageMediaResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditHomepageMedia extends EditRecord
{
    protected static string $resource = HomepageMediaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
